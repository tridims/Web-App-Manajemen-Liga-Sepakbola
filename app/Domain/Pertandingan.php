<?php

namespace Tridi\ManajemenLiga\Domain;

use DateTime;

class Pertandingan
{
  public int $id;
  public TimSepakBola $tim1;
  public TimSepakBola $tim2;
  public string $jadwalMain;
  public int $jumlahGolTim1;
  public int $jumlahGolTim2;

  public function __construct(int $id, TimSepakBola $tim1, TimSepakBola $tim2, string $jadwalMain, int $jumlahGolTim1, int $jumlahGolTim2)
  {
    $this->tim1 = $tim1;
    $this->tim2 = $tim2;
    $this->jadwalMain = $jadwalMain;
    $this->jumlahGolTim1 = $jumlahGolTim1;
    $this->jumlahGolTim2 = $jumlahGolTim2;
  }

  public function getArrayIdTeam()
  {
    return [$this->tim1->id, $this->tim2->id];
  }

  public function getSelisihGol()
  {
    return abs($this->jumlahGolTim1 - $this->jumlahGolTim2);
  }

  public function getJumlahGolForTim(int $timId)
  {
    if ($this->tim1->id == $timId) {
      return $this->jumlahGolTim1;
    } else if ($this->tim2->id == $timId) {
      return $this->jumlahGolTim2;
    } else {
      throw new \Exception("Tim tidak ditemukan");
    }
  }

  public function getScoreForTim(int $timId)
  {
    if ($timId == $this->tim1->id) {
      return $this->getScoreTim1;
    } else if ($timId == $this->tim2->id) {
      return $this->getScoreTim2;
    } else {
      return 0;
    }
  }

  public function getScoreTim1()
  {
    if ($this->jumlahGolTim1 > $this->jumlahGolTim2) {
      return 3;
    } else if ($this->jumlahGolTim1 == $this->jumlahGolTim2) {
      return 1;
    } else {
      return 0;
    }
  }

  public function getScoreTim2()
  {
    if ($this->jumlahGolTim1 < $this->jumlahGolTim2) {
      return 3;
    } else if ($this->jumlahGolTim1 == $this->jumlahGolTim2) {
      return 1;
    } else {
      return 0;
    }
  }

  public function getWinner()
  {
    if ($this->jumlahGolTim1 > $this->jumlahGolTim2) {
      return $this->tim1;
    } else if ($this->jumlahGolTim1 < $this->jumlahGolTim2) {
      return $this->tim2;
    } else {
      return null;
    }
  }
}
