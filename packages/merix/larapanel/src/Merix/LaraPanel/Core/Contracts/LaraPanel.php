<?php

namespace Merix\LaraPanel\Core\Contracts;
use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Modules\Panel;
use Merix\LaraPanel\Core\Contracts\Modules\Admin;


/**
 * This is the main LaraPanel class used to load everything else
 *
 * @package Merix\LaraPanel\Core\Contracts
 */
interface LaraPanel
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

}