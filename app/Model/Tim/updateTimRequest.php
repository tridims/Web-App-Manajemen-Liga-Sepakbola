<?php

namespace Tridi\ManajemenLiga\Model\Tim;

class updateTimRequest
{
    public int $id;
    public String $namaTim;
    public String $deskripsi;
    public String $asal;
    public ?String $logo;
    public String $stadium;
    public String $pelatih;
    public String $pemilik;

    // add constructor
    public function __construct(
        int $id,
        String $namaTim,
        String $deskripsi,
        String $asal,
        ?String $logo = null,
        String $stadium,
        String $pelatih,
        String $pemilik
    ) {
        $this->id = $id;
        $this->namaTim = $namaTim;
        $this->deskripsi = $deskripsi;
        $this->asal = $asal;
        $this->logo = $logo;
        $this->stadium = $stadium;
        $this->pelatih = $pelatih;
        $this->pemilik = $pemilik;
    }
}
