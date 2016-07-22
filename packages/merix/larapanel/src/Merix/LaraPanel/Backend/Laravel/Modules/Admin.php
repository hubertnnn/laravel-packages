<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Illuminate\Support\Collection;
use Merix\LaraPanel\Backend\Laravel\Managers\ActionManager;
use Merix\LaraPanel\Core\Components\Action;
use Merix\LaraPanel\Core\Components\Menu;
use Merix\LaraPanel\Core\Contracts\Modules\Admin as BaseAdmin;
use Merix\LaraPanel\Core\Traits\LaraPanelAwareTrait;
use Merix\LaraPanel\Core\Traits\OwnerAwareTrait;
use Merix\LaraPanel\Core\Traits\PanelAwareTrait;

class Admin implements BaseAdmin
{
    use OwnerAwareTrait;
    use LaraPanelAwareTrait;
    use PanelAwareTrait;

    protected $config;

    protected $name;
    protected $type;
    protected $view;

    protected $actions;

    /**
     * @param $laraPanel LaraPanel
     * @param $panelName string
     */
    public function __construct($laraPanel, $panelName)
    {
        $this->panelName = $panelName;

        $this->owner = $laraPanel;
        $this->laraPanel = $laraPanel;
        $this->panel = $laraPanel->getPanel();
        $this->config = $laraPanel->getConfig()->getNode('panel');
    }



    //------------------------------------------------------------------------------------------------------------------
    // Initialization

    private function initPanel()
    {
        // If its already initiated
        if($this->name != null)
            return;

        $this->name = $this->getConfig()->getValue('name');
        $this->type = $this->getConfig()->getValue('type');
        $this->view = $this->getConfig()->getValue('view');
    }

    protected function initActions()
    {
        $this->actions = new ActionManager($this, $this->getConfig());
    }



    //------------------------------------------------------------------------------------------------------------------
    // Getters

    public function getConfig()
    {
        return $this->getLaraPanel()->getConfig()->getNode('admin');
    }

    public function getType()
    {
        $this->initPanel();
        return $this->type;
    }

    public function getName()
    {
        $this->initPanel();
        return $this->name;
    }

    public function getView()
    {
        $this->initPanel();
        return $this->view;
    }

    public function getActions()
    {
        if($this->actions == null)
        {
            $this->initActions();
        }

        return $this->actions;
    }





    public function getEdit()
    {
        // TODO: Implement getEdit() method.
    }

    public function getFields()
    {
        // TODO: Implement getFields() method.
    }


}