<?php

namespace Tridi\ManajemenLiga\Model\Pertandingan;

use Tridi\ManajemenLiga\Domain\TimSepakBola;

class updatePertandinganRequest {
    public int $id;
    public string $idTim1;
    public string $idTim2;
    public string $jadwalMain;
    public int $jumlahGolTim1;
    public int $jumlahGolTim2;
}