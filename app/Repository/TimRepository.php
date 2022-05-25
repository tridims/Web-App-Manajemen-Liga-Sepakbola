<?php

namespace Tridi\ManajemenLiga\Repository;

use Tridi\ManajemenLiga\Domain\TimSepakBola;
use Tridi\ManajemenLiga\Model\Tim\createTimRequest;
use Tridi\ManajemenLiga\Model\Tim\deleteTimRequest;
use Tridi\ManajemenLiga\Model\Tim\updateTimRequest;
use Tridi\ManajemenLiga\Service\Database;

class TimRepository
{
  public function getAll(): array
  {
    $sql = "SELECT * FROM tim";
    $stmt = Database::query($sql);
    $listTim = [];
    while ($row = $stmt->fetch()) {
      $tim = new TimSepakBola($row['id'], $row['nama'], $row['deskripsi'], $row['asal'], $row['logo'], $row['stadium'], $row['pelatih'], $row['pemilik']);
      $listTim[] = $tim;
    }
    return $listTim;
  }

  public function findById($id): TimSepakBola
  {
    $sql = "SELECT * FROM tim WHERE id = :id";
    $stmt = Database::query($sql, ['id' => $id]);
    $data = $stmt->fetch();

    if ($data) {
      $tim = new TimSepakBola($data['id'], $data['nama'], $data['deskripsi'], $data['asal'], $data['logo'], $data['stadium'], $data['pelatih'], $data['pemilik']);
      return $tim;
    } else {
      throw new \Exception("Tim tidak ditemukan");
    }
  }


  public function saveTim(TimSepakBola $tim): void
  {
    $params = [
      'nama' => $tim->namaTim,
      'deskripsi' => $tim->deskripsi,
      'asal' => $tim->asal,
      'logo' => $tim->logo,
      'stadium' => $tim->stadium,
      'pelatih' => $tim->pelatih,
      'pemilik' => $tim->pemilik
    ];

    if ($tim->logo != null) {
      $sql = "INSERT INTO tim (nama, deskripsi, asal, logo, stadium, pelatih, pemilik) VALUES (:nama, :deskripsi, :asal, :logo, :stadium, :pelatih, :pemilik)";
    } else {
      $sql = "INSERT INTO tim (nama, deskripsi, asal, stadium, pelatih, pemilik) VALUES (:nama, :deskripsi, :asal, :stadium, :pelatih, :pemilik)";

      unset($params['logo']);
    }

    Database::exec($sql, $params);
  }

  public function updateTim(TimSepakBola $tim): void
  {
    $params = [
      'nama' => $tim->namaTim,
      'deskripsi' => $tim->deskripsi,
      'asal' => $tim->asal,
      'logo' => $tim->logo,
      'stadium' => $tim->stadium,
      'pelatih' => $tim->pelatih,
      'pemilik' => $tim->pemilik,
      'id' => $tim->id
    ];

    // check if logo is null
    if ($tim->logo == null) {
      $sql = "UPDATE tim SET nama = :nama, deskripsi = :deskripsi, asal = :asal, stadium = :stadium, pelatih = :pelatih, pemilik = :pemilik WHERE id = :id";
      unset($params['logo']);
    } else {
      $sql = "UPDATE tim SET nama = :nama, deskripsi = :deskripsi, asal = :asal, logo = :logo, stadium = :stadium, pelatih = :pelatih, pemilik = :pemilik WHERE id = :id";
    }

    Database::exec($sql, $params);
  }

  public function deleteTim(int $id): void
  {
    $sql = "DELETE FROM tim WHERE id = :id";
    Database::exec($sql, ['id' => $id]);
  }
}
