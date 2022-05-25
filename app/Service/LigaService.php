<?php

namespace Tridi\ManajemenLiga\Service;

use Tridi\ManajemenLiga\Repository\TimRepository;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;

class LigaService
{
  private array $daftarTim = [];
  private TimRepository $timRepository;
  private PertandinganRepository $pertandinganRepository;

  public function __construct(TimRepository $timRepository, PertandinganRepository $pertandinganRepository)
  {
    // isi variable repository
    $this->timRepository = $timRepository;
    $this->pertandinganRepository = $pertandinganRepository;

    // cari semua daftar team beserta semua pertandingan mereka
    $this->daftarTim = $this->timRepository->getAll();
    foreach ($this->daftarTim as $team) {
      $team->daftarPertandingan = $this->pertandinganRepository->getPertandinganByTimId($team->id);
    }

    // Pengurutan
    usort($this->daftarTim, function ($a, $b) {

      // berdasarkan jumlah total poin
      $poinA = $a->getTotalPoin();
      $poinB = $b->getTotalPoin();

      if ($poinA != $poinB) {
        return $poinB - $poinA;
      }

      // berdasarkan jumlah poin yang didapat klub terkait
      $poinA = $a->getPoinWhenTandingWith($b);
      $poinB = $b->getPoinWhenTandingWith($a);

      if ($poinA != $poinB) {
        return $poinB - $poinA;
      }

      // berdasarkan selisih gol tertinggi -> selisih gol ?
      $poinA = $a->getTotalSelisihGolWhenTandingWith($b);
      $poinB = $b->getTotalSelisihGolWhenTandingWith($a);

      if ($poinA != $poinB) {
        return $poinB - $poinA;
      }

      // berdasarkan jumlah gol
      $poinA = $a->getTotalGolWhenTandingWith($b);
      $poinB = $b->getTotalGolWhenTandingWith($a);

      return $poinB - $poinA;
    });
  }

  public function getPeringkatKlasemen()
  {
    return $this->daftarTim;
  }

  public function getJuaraLiga()
  {
    return $this->daftarTim[0];
  }
}
