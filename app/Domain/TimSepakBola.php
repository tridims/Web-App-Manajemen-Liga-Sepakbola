<?php

namespace Tridi\ManajemenLiga\Domain;

class TimSepakBola
{
  public int $id;
  public String $namaTim;
  public String $deskripsi;
  public String $asal;
  public $logo;
  public String $stadium;
  public String $pelatih;
  public String $pemilik;
  public array $daftarPertandingan;

  public function __construct(int $id, String $namaTim, String $deskripsi, String $asal, String $logo = null, String $stadium, String $pelatih, String $pemilik)
  {
    $this->id = $id;
    $this->namaTim = $namaTim;
    $this->deskripsi = $deskripsi;
    $this->asal = $asal;
    $this->logo = $logo;
    $this->stadium = $stadium;
    $this->pelatih = $pelatih;
    $this->pemilik = $pemilik;
  }

  public function getTotalPoin()
  {
    $totalPoin = 0;
    foreach ($this->daftarPertandingan as $pertandingan) {
      $totalPoin += $pertandingan->getScoreForTim($this->id);
    }
    return $totalPoin;
  }

  public function getPoinWhenTandingWith(TimSepakBola $tim)
  {
    $poin = 0;
    foreach ($this->daftarPertandingan as $pertandingan) {
      if (in_array($this->id, $pertandingan->getArrayIdTeam()) && in_array($tim->id, $pertandingan->getArrayIdTeam())) {
        $poin += $pertandingan->getScoreForTim($this->id);
      }
    }
    return $poin;
  }

  public function getTotalSelisihGolWhenTandingWith(TimSepakBola $tim)
  {
    $totalGol = 0;
    foreach ($this->daftarPertandingan as $pertandingan) {
      if (in_array($this->id, $pertandingan->getArrayIdTeam()) && in_array($tim->id, $pertandingan->getArrayIdTeam())) {
        $totalGol += $pertandingan->getSelisihGol();
      }
    }
    return $totalGol;
  }

  public function getTotalGolWhenTandingWith(TimSepakBola $tim)
  {
    $totalGol = 0;
    foreach ($this->daftarPertandingan as $pertandingan) {
      if (in_array($this->id, $pertandingan->getArrayIdTeam()) && in_array($tim->id, $pertandingan->getArrayIdTeam())) {
        $totalGol += $pertandingan->jumlahGolTim1;
      }
    }
    return $totalGol;
  }
}
