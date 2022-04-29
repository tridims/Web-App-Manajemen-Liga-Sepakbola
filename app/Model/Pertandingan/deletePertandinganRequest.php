<?php

namespace Tridi\ManajemenLiga\Model\Pertandingan;

class deletePertandinganRequest
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
