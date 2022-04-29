<?php

namespace Tridi\ManajemenLiga\Model\Tim;

class deleteTimRequest
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
