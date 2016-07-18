<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



interface ConfigNode
{
    /** Check if node exists */
    public function exists($key = null);

    /** Check return the subnode */
    public function getNode($key = null, $nullIfEmpty = true);


    /** Return the node as closure */
    public function getClosure($key = null, $forceExists = false);
    /** Return the node as value */
    public function getValue($key = null, $owner = null, $default = null);
    /** Return the node as array */
    public function getArray($key = null, $owner = null, $default = null);

}
