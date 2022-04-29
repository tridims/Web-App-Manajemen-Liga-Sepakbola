<?php

namespace Tridi\ManajemenLiga\Model\Pertandingan;

class changeScorePertandinganRequest
{
    public $id_pertandingan;
    public $score_a;
    public $score_b;

    public function __construct(
        $id_pertandingan,
        $score_a,
        $score_b
    ) {
        $this->id_pertandingan = $id_pertandingan;
        $this->score_a = $score_a;
        $this->score_b = $score_b;
    }
}
