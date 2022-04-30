<?php

namespace Tridi\ManajemenLiga\Model\Tim;

class createTimRequest
{
    public String $namaTim;
    public String $deskripsi;
    public String $asal;
    public ?String $logo;
    public String $stadium;
    public String $pelatih;
    public String $pemilik;

    public function __construct(
        String $namaTim,
        String $deskripsi,
        String $asal,
        ?String $logo = null,
        String $stadium,
        String $pelatih,
        String $pemilik
    ) {
        $this->namaTim = $namaTim;
        $this->deskripsi = $deskripsi;
        $this->asal = $asal;
        $this->logo = $logo;
        $this->stadium = $stadium;
        $this->pelatih = $pelatih;
        $this->pemilik = $pemilik;
    }
}
