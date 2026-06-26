<?php

namespace Composite\TecDoc\Models;

abstract class Model
{    
    /**
     * Return model object as it is
     *
     * @return void
     */
    public function toArray()
    {
        return $this;
    }
        
    /**
     * Return model object as Json object
     *
     * @return false|string
     */
    public function toJson(): bool|string
    {
        return json_encode($this);
    }
}
