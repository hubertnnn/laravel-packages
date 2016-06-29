<?php

namespace Merix\LaraPanel\Contracts;


interface AdminContract
{
    public function getUri();
    public function getTitle();

    public function getModel();
    public function getQuery();

    public function getTable();
    public function getFilters();
    public function getEdit();

    public function getFormWidth();

    public function getGlobalActions();
    public function getPermissions();


}