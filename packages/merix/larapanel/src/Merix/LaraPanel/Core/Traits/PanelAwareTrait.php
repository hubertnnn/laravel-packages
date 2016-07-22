<?php

namespace Merix\LaraPanel\Core\Traits;



use Merix\LaraPanel\Core\Contracts\Modules\Panel;

trait PanelAwareTrait
{
    protected $panel;

    /**
     * @return Panel
     */
    public function getPanel()
    {
        return $this->panel;
    }

}