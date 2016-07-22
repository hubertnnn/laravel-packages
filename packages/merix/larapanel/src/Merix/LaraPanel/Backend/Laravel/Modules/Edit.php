<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

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
        $this->actions = new ActionManager($this, $this->getConfig());
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
        $factory = $this->getLaraPanel()->getFieldFactory();

        $fieldsConfig = $this->getConfig()->getNode('fields');
        if($fieldsConfig != null)
        {
            foreach($fieldsConfig as $fieldConfig)
            {
                $type = $fieldConfig->getValue('type');
                $this->fields[] = $factory->createField($type, $fieldConfig);
            }
        }
    }



    //------------------------------------------------------------------------------------------------------------------
    // Setters

    public function select($id)
    {
        if($id == 0)
        {
            dump($this->getAdmin()->getEntityClass());
            // Create new Object
            $this->object = app()->make($this->getAdmin()->getEntityClass());
        }
        else
        {
            $this->object = $this->getAdmin()->getQuery()->whereId($id)->first();
        }
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

    public function getActionStructure()
    {
        // TODO: Implement getActionStructure() method.
    }

    public function getObject()
    {
        return $this->object;
    }



}