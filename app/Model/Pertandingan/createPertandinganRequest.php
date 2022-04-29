<?php

namespace Tridi\ManajemenLiga\Model\Pertandingan;

use Tridi\ManajemenLiga\Domain\TimSepakBola;

class createPertandinganRequest
{
    public string $idTim1;
    public string $idTim2;
    public string $jadwalMain;
    public int $jumlahGolTim1;
    public int $jumlahGolTim2;

    public function __construct(
        string $idTim1,
        string $idTim2,
        string $jadwalMain,
        int $jumlahGolTim1,
        int $jumlahGolTim2
    ) {
        $this->idTim1 = $idTim1;
        $this->idTim2 = $idTim2;
        $this->jadwalMain = $jadwalMain;
        $this->jumlahGolTim1 = $jumlahGolTim1;
        $this->jumlahGolTim2 = $jumlahGolTim2;
    }
}
