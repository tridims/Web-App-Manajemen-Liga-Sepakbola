<?php

namespace Tridi\ManajemenLiga\Model\Pertandingan;

use Tridi\ManajemenLiga\Domain\Pertandingan;

class PertandinganResponse {
    public Pertandingan $pertandingan;

    public function __construct(Pertandingan $pertandingan)
    {
        $this->pertandingan = $pertandingan;
    }


}