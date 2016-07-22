<?php

namespace Merix\LaraPanel\Core\Traits;



use Merix\LaraPanel\Core\Contracts\Modules\LaraPanel;

trait LaraPanelAwareTrait
{
    protected $laraPanel;

    /**
     * @return LaraPanel
     */
    public function getLaraPanel()
    {
        return $this->laraPanel;
    }

}