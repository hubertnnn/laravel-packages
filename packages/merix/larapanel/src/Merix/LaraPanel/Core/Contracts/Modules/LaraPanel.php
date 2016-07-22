<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;
use Merix\LaraPanel\Core\Contracts\Factories\FieldFactory;
use Merix\LaraPanel\Core\Contracts\Interfaces\Module;
use Merix\LaraPanel\Core\Contracts\Utils;


/**
 * This is the main LaraPanel class used to load everything else
 *
 * @package Merix\LaraPanel\Core\Contracts
 */
interface LaraPanel extends Module
{

    /**
     * Selects current panel and admin
     * Use this in controller to load configs
     *
     * @param $panel string
     * @param $admin null|string
     */
    public function select($panel, $admin = null);

    /**
     * @return Admin
     */
    public function getAdmin();
    public function getAdminName();

    /**
     * @return Panel
     */
    public function getPanel();
    public function getPanelName();

    /**
     * @return Config
     */
    public function getConfig();

    /** @return Utils */
    public function getUtils();


    /** @return FieldFactory */
    public function getFieldFactory();

}