<?php

namespace Tridi\ManajemenLiga\Repository;

use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Model\Pertandingan\createPertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\deletePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
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

    // $pertandinganList = $this->getAll();
    // foreach ($pertandinganList as $pertandingan) {
    //   if ($pertandingan->tim1->id == $timId || $pertandingan->tim2->id == $timId) {
    //     $pertandinganList[] = $pertandingan;
    //   }
    // }
    $sql = "select * from pertandingan where tim1 = :timId or tim2 = :timId";
    $params = [
      "timId" => $timId,
    ];
    $stmt = Database::query($sql, $params);

    $listPertandingan = [];
    while ($row = $stmt->fetch()) {
      $tim1 = $this->timRepository->findById($row['tim1']);
      $tim2 = $this->timRepository->findById($row['tim2']);
      $pertandingan = new Pertandingan($row['id_pertandingan'], $tim1, $tim2, $row['jadwalPertandingan'], $row['jumlahGolTim1'], $row['jumlahGolTim2']);
      $listPertandingan[] = $pertandingan;
    }
    return $listPertandingan;

    return $listPertandingan;
  }

  public function getAll()
  {
    $sql = "SELECT * FROM pertandingan";
    $stmt = Database::query($sql);
    $listPertandingan = [];
    while ($row = $stmt->fetch()) {
      $tim1 = $this->timRepository->findById($row['tim1']);
      $tim2 = $this->timRepository->findById($row['tim2']);
      $pertandingan = new Pertandingan($row['id_pertandingan'], $tim1, $tim2, $row['jadwalPertandingan'], $row['jumlahGolTim1'], $row['jumlahGolTim2']);
      $listPertandingan[] = $pertandingan;
    }
    return $listPertandingan;
  }

  public function findById(int $id)
  {
    if ($id <= 0) {
      throw new \Exception("Id tidak valid");
    }

    $sql = "SELECT * FROM pertandingan WHERE id_pertandingan = :id";
    $params = [
      'id' => $id
    ];
    $stmt = Database::query($sql, $params);

    $row = $stmt->fetch();
    if ($row == null) {
      throw new \Exception("Pertandingan tidak ditemukan");
    }
    $tim1 = $this->timRepository->findById($row['tim1']);
    $tim2 = $this->timRepository->findById($row['tim2']);
    $pertandingan = new Pertandingan($row['id_pertandingan'], $tim1, $tim2, $row['jadwalPertandingan'], $row['jumlahGolTim1'], $row['jumlahGolTim2']);
    return $pertandingan;
  }

  public function savePertandingan(createPertandinganRequest $pertandingan)
  {
    $sql = "INSERT INTO pertandingan (jumlahGolTim1, jumlahGolTim2, jadwalPertandingan, tim1, tim2) VALUES (:jumlahGolTim1, :jumlahGolTim2, :jadwalPertandingan, :tim1, :tim2)";
    $params = [
      'jumlahGolTim1' => $pertandingan->jumlahGolTim1,
      'jumlahGolTim2' => $pertandingan->jumlahGolTim2,
      'jadwalPertandingan' => $pertandingan->jadwalMain,
      'tim1' => $pertandingan->idTim1,
      'tim2' => $pertandingan->idTim2
    ];

    $stmt = Database::exec($sql, $params);
  }

  public function updatePertandingan(updatePertandinganRequest $updatePertandinganRequest)
  {
    $sql = "UPDATE pertandingan SET tim1 = :tim1, tim2 = :tim2, jadwalPertandingan = :jadwalPertandingan, jumlahGolTim1 = :jumlahGolTim1, jumlahGolTim2 = :jumlahGolTim2 WHERE id_pertandingan = :idPertandingan";
    // $params = [
    //   'tim1' => $pertandingan->tim1->id,
    //   'tim2' => $pertandingan->tim2->id,
    //   'jadwalPertandingan' => $pertandingan->jadwalMain,
    //   'jumlahGolTim1' => $pertandingan->jumlahGolTim1,
    //   'jumlahGolTim2' => $pertandingan->jumlahGolTim2,
    //   'idPertandingan' => $pertandingan->id
    // ];
    $params = [
      'tim1' => $updatePertandinganRequest->idTim1,
      'tim2' => $updatePertandinganRequest->idTim2,
      'jadwalPertandingan' => $updatePertandinganRequest->jadwalMain,
      'jumlahGolTim1' => $updatePertandinganRequest->jumlahGolTim1,
      'jumlahGolTim2' => $updatePertandinganRequest->jumlahGolTim2,
      'idPertandingan' => $updatePertandinganRequest->id
    ];
    $stmt = Database::exec($sql, $params);
  }

  public function deletePertandingan(deletePertandinganRequest $deletePertandinganRequest)
  {
    $sql = "DELETE FROM pertandingan WHERE id_pertandingan = :idPertandingan";
    $params = [
      'idPertandingan' => $deletePertandinganRequest->id
    ];
    $stmt = Database::exec($sql, $params);
  }
}
