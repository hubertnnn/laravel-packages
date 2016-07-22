<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



interface Config
{
    /**
     * Check if node exists
     * @param string $key
     * @return mixed
     */
    public function exists($key = null);

    /**
     * Check return the subnode
     * @param string $key
     * @param bool|true $nullIfEmpty
     * @return Config
     */
    public function getNode($key = null, $nullIfEmpty = true);


    /** Return the node as closure */
    public function getClosure($key = null, $forceExists = false);
    /** Return the node as value */
    public function getValue($key = null, $owner = null, $default = null);
    /** Return the node as array */
    public function getArray($key = null, $owner = null, $default = null);

}
