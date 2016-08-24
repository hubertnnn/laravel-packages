<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Illuminate\Database\Eloquent\Model;
use Merix\LaraPanel\Backend\Laravel\Managers\ActionManager;
use Merix\LaraPanel\Core\Contracts\Modules\Edit as BaseEdit;
use Merix\LaraPanel\Core\Traits\AdminAwareTrait;
use Merix\LaraPanel\Core\Traits\LaraPanelAwareTrait;
use Merix\LaraPanel\Core\Traits\OwnerAwareTrait;
use Merix\LaraPanel\Core\Traits\PanelAwareTrait;

class Edit implements BaseEdit
{
    use OwnerAwareTrait;
    use LaraPanelAwareTrait;
    use PanelAwareTrait;
    use AdminAwareTrait;

    protected $object;
    protected $selectedId;

    protected $actions;

    protected $tabs;
    protected $sections;
    protected $fields;

    /**
     * @param $admin Admin
     */
    public function __construct($admin)
    {
        $this->owner = $admin;
        $this->admin = $admin;
        $this->panel = $admin->getPanel();
        $this->laraPanel = $admin->getLaraPanel();
    }


    //------------------------------------------------------------------------------------------------------------------
    // Initialization

    // TODO: Get correct actions from config
    protected function initActions()
    {
        $this->actions = new ActionManager($this->getAdmin(), $this->getConfig());
    }

    protected function initStructure()
    {
        $this->initTabs();
        $this->initSections();
        $this->initFields();
    }

    protected function initTabs()
    {
        // Init default tab
        $this->tabs = [];

        $tabConfig = $this->getConfig()->getNode('tabs');
        if($tabConfig != null)
        {
            foreach($tabConfig as $tab)
            {
                /** @var Config $tab */

                $tabName = $tab->getValue('name', $this->getOwner());
                if($tabName == null)
                {
                    // Tab must have a name
                    continue;
                }

                $this->tabs[$tabName] = [
                    'name'  => $tabName,
                    'label' => $tab->getValue('name',   $this->getOwner()),
                    'class' => $tab->getValue('class',  $this->getOwner()),
                ];
            }
        }
        else
        {
            $this->tabs['default'] = [
                'name'   => 'default',
                'label'  => 'default',
                'class'  => null,
            ];
        }
    }

    protected function initSections()
    {
        // Init default tab
        $this->sections = [];

        $sectionConfig = $this->getConfig()->getNode('sections');
        if($sectionConfig != null)
        {
            foreach($sectionConfig as $sectionName => $section)
            {
                /** @var Config $section */

                $this->sections[$sectionName] = [
                    'name'      => $sectionName,
                    'label'     => $section->getValue('label',  $this->getOwner()),
                    'class'     => $section->getValue('class',  $this->getOwner()),
                    'tab'       => $section->getValue('tab',    $this->getOwner()),
                    'parent'    => $section->getValue('parent', $this->getOwner()),
                ];
            }
        }
        else
        {
            $this->sections['default'] = [
                'name'   => 'default',
                'label'  => 'default',
                'class'  => null,
                'tab'    => 'default',
                'parent' => null,
            ];
        }
    }

    protected function initFields()
    {
        $fieldNum = 0;

        $factory = $this->getLaraPanel()->getFieldFactory();

        $fieldsConfig = $this->getConfig()->getNode('fields');
        if($fieldsConfig != null)
        {
            foreach($fieldsConfig as $fieldConfig)
            {
                $name = $fieldConfig->getValue('name', $this->getAdmin(), 'field_'.($fieldNum++));
                $type = $fieldConfig->getValue('type', $this->getAdmin());
                $field = $factory->createField($this, $type, $fieldConfig);
                if($field !== null)
                {
                    $this->fields[$name] = $field;
                }
            }
        }
    }



    //------------------------------------------------------------------------------------------------------------------
    // Setters

    public function select($id)
    {
        $this->selectedId = $id;

        if($id == 0)
        {
            // Create new Object
            $this->object = app()->make($this->getAdmin()->getEntityClass());
        }
        else
        {
            $this->object = $this->getAdmin()->getQuery()->whereId($id)->first();
        }

        if($this->object === null)
            return false;
        else
            return true;
    }



    //------------------------------------------------------------------------------------------------------------------
    // Getters

    /**@return Config */
    public function getConfig()
    {
        return $this->getOwner()->getConfig()->getNode('edit', false);
    }

    public function getWidth()
    {
        return $this->getConfig()->getValue('width', $this->getAdmin());
    }

    public function getTabs()
    {
        $this->initStructure();

        return $this->tabs;
    }

    public function getSections()
    {
        $this->initStructure();

        return $this->sections;
    }

    public function getFields()
    {
        if($this->fields == null)
        {
            $this->initFields();
        }

        return $this->fields;
    }

    public function getActions()
    {
        if($this->actions == null)
        {
            $this->initActions();
        }

        return $this->actions;
    }

    /** @return Model */
    public function getObject()
    {
        return $this->object;
    }


    public function getData()
    {
        $fieldData = [];

        foreach($this->getFields() as $field)
        {
            $fd = $field->serialize($field->get());
            if($fd !== null)
                $fieldData[] = $fd;
        }

        return $fieldData;
    }

    public function storeData($data)
    {
        // Check if data have correct format
        $values = $this->decodeFields($data);
        if($values == null)
        {
            return [
                'id' => -1, //TODO: Get current id
                'success' => false,
                'errors' => ['Incorrect format of input data'],
            ];
        }


        // Check if data is valid
        $rules = [];
        foreach($this->getFields() as $field)
        {
            $validator = $field->getValidator();

            if($validator !== null && $validator !=='')
            {
                $validator = $this->fixUniqueValidator($validator, $field->getField());
                $rules[$field->getName()] = $validator;
            }
        }

        //TODO: Add translation fields in config
        $validator = validator($values, $rules);
        if($validator->fails())
        {
            return [
                'id' => -1, //TODO: Get current id
                'success' => false,
                'errors' => $validator->getMessageBag()->all(),
            ];
        }



        try
        {
            // Everything is fine, update the object
            $fields = $this->getFields();
            foreach($values as $fieldName => $value)
            {
                $fields[$fieldName]->set($value);
            }

            $this->getObject()->save();
        }
        catch(\Exception $ex)
        {
            $this->getLaraPanel()->log($ex->getMessage(), 'ERROR');

            return [
                'id' => -1, //TODO: Get current id
                'success' => false,
                'errors' => [$ex->getMessage()],
            ];
        }


        return [
            'id' => $this->getObject()->id,
            'success' => true,
        ];
    }



    protected function decodeFields($data)
    {
        if(!is_array($data))
            return null;

        if(!isset($data['fields']) || !is_array($data['fields']))
            return null;

        $fields = $this->getFields();

        $decoded = [];
        foreach($data['fields'] as $field)
        {
            if(!isset($field['name']))
            {
                $this->getLaraPanel()->log('incorrect format, unknown field name', 'ERROR');
                return null;
            }

            $name = $field['name'];

            if(!isset($fields[$name]))
            {
                $this->getLaraPanel()->log('field does not exist: ' . $name, 'ERROR');
                return false;
            }


            if($fields[$name]->getReadOnly())
            {
                $this->getLaraPanel()->log('you do not have permission for editing: ' . $name, 'ERROR');
                return false;
            }

            $decoded[$name] = $fields[$name]->deserialize($field);
        }

        return $decoded;
    }

    protected function fixUniqueValidator($validator, $fieldName)
    {
        // Will add current id as exception in unique rule

        $rules = explode('|', $validator);

        foreach($rules as $pos => $rule)
        {
            if(strpos($rule, 'unique:') === 0)
            {
                // Fix this rule
                $segments = explode(',', substr($rule, 7));

                if(!isset($segments[1]))
                {
                    $segments[1] = $fieldName;
                }

                $segments[2] = $this->selectedId;

                $rules[$pos] = 'unique:' . implode(',', $segments);
            }
        }

        return implode('|', $rules);
    }


    public function getField($field)
    {
        $fields = $this->getFields();
        if(!isset($fields[$field]))
            return null;

        return $fields[$field];
    }

}