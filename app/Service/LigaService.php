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

    $this->daftarTim = $this::urutkanTim($this->daftarTim);
  }

  public static function urutkanTim(array $daftarTim): array
  {
      usort($daftarTim, function ($a, $b) {

          // berdasarkan jumlah total poin
          $poinA = $a->getTotalPoint();
          $poinB = $b->getTotalPoint();

          if ($poinA != $poinB) {
              return $poinB - $poinA;
          }

          // berdasarkan jumlah poin yang didapat klub terkait
          $poinA = $a->getPointWithOpponent($b);
          $poinB = $b->getPointWithOpponent($a);

          if ($poinA != $poinB) {
              return $poinB - $poinA;
          }

          // berdasarkan selisih gol tertinggi -> selisih gol ?
          $poinA = $a->getGoalDifferenceWithOpponent($b);
          $poinB = $b->getGoalDifferenceWithOpponent($a);

          if ($poinA != $poinB) {
              return $poinB - $poinA;
          }

          // berdasarkan jumlah gol
          $poinA = $a->getTotalGoalWithOpponent($b);
          $poinB = $b->getTotalGoalWithOpponent($a);

          return $poinB - $poinA;
      });

      return $daftarTim;
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
