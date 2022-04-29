<?php

namespace Tridi\ManajemenLiga\Repository;

use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Service\Database;
use Tridi\ManajemenLiga\Repository\TimRepository;

class PertandinganRepository
{
  private TimRepository $timRepository;

  public function __construct()
  {
    $this->timRepository = new TimRepository();
  }

  public function getPertandinganByTimId(int $timId)
  {
    $tim = $this->timRepository->findById($timId);
    if ($tim == null) {
      throw new \Exception("Tim tidak ditemukan");
    }

    $pertandinganList = [];
    foreach ($this->pertandinganList as $pertandingan) {
      if ($pertandingan->getTim1()->getId() == $timId || $pertandingan->getTim2()->getId() == $timId) {
        $pertandinganList[] = $pertandingan;
      }
    }

    return $pertandinganList;
  }

  public function getAll()
  {
    $sql = "SELECT * FROM pertandingan";
    $stmt = Database::query($sql);
    $listPertandingan = [];
    while ($row = $stmt->fetch()) {
      $tim1 = $this->timRepository->findById($row['tim1']);
      $tim2 = $this->timRepository->findById($row['tim2']);
      $pertandingan = new Pertandingan($row['id'], $tim1, $tim2, $row['jadwal_main'], $row['jumlah_gol_tim1'], $row['jumlah_gol_tim2']);
      $listPertandingan[] = $pertandingan;
    }
    return $listPertandingan;
  }

  public function findById(int $id)
  {
    $sql = "SELECT * FROM pertandingan WHERE id = :id";
    $params = [
      'id' => $id
    ];
    $stmt = Database::query($sql, $params);
    $row = $stmt->fetch();
    $tim1 = $this->timRepository->findById($row['tim1']);
    $tim2 = $this->timRepository->findById($row['tim2']);
    $pertandingan = new Pertandingan($row['id'], $tim1, $tim2, $row['jadwal_main'], $row['jumlah_gol_tim1'], $row['jumlah_gol_tim2']);
    return $pertandingan;
  }

  public function savePertandingan(Pertandingan $pertandingan)
  {
    $sql = "INSERT INTO pertandingan (tim1, tim2, jadwal_main, jumlah_gol_tim1, jumlah_gol_tim2) VALUES (:tim1, :tim2, :jadwal_main, :jumlah_gol_tim1, :jumlah_gol_tim2)";
    $params = [
      'tim1' => $pertandingan->tim1->id,
      'tim2' => $pertandingan->tim2->id,
      'jadwal_main' => $pertandingan->jadwalMain,
      'jumlah_gol_tim1' => $pertandingan->jumlahGolTim1,
      'jumlah_gol_tim2' => $pertandingan->jumlahGolTim2
    ];
    $stmt = Database::exec($sql, $params);
  }

  public function updatePertandingan(Pertandingan $pertandingan)
  {
    $sql = "UPDATE pertandingan SET tim1 = :tim1, tim2 = :tim2, jadwal_main = :jadwal_main, jumlah_gol_tim1 = :jumlah_gol_tim1, jumlah_gol_tim2 = :jumlah_gol_tim2 WHERE id = :id";
    $params = [
      'tim1' => $pertandingan->tim1->id,
      'tim2' => $pertandingan->tim2->id,
      'jadwal_main' => $pertandingan->jadwalMain,
      'jumlah_gol_tim1' => $pertandingan->jumlahGolTim1,
      'jumlah_gol_tim2' => $pertandingan->jumlahGolTim2,
      'id' => $pertandingan->id
    ];
    $stmt = Database::exec($sql, $params);
  }

  public function deletePertandingan(Pertandingan $pertandingan)
  {
    $sql = "DELETE FROM pertandingan WHERE id = :id";
    $params = [
      'id' => $pertandingan->id
    ];
    $stmt = Database::exec($sql, $params);
  }
}
