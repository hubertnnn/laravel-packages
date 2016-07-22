<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



use Illuminate\Database\Query\Builder;
use Merix\LaraPanel\Core\Contracts\Interfaces\Module;
use Merix\LaraPanel\Core\Contracts\Managers\ActionManager;

interface Admin extends Module
{

    public function getType();

    public function getName();
    public function getView();

    /** @return ActionManager */
    public function getActions();


    // Edit window
    /** @return Edit */
    public function getEdit();
    public function getFields();

    // Entity
    public function getEntityClass();
    /** @return Builder */
    public function getQuery();

}
