<?php

namespace Tridi\ManajemenLiga\Repository;

use Tridi\ManajemenLiga\Domain\TimSepakBola;
use Tridi\ManajemenLiga\Service\Database;

class TimRepository
{
  public function getAll()
  {
    $sql = "SELECT * FROM tim";
    $stmt = Database::query($sql);
    $listTim = [];
    while ($row = $stmt->fetch()) {
      $tim = new TimSepakBola($row['id'], $row['nama_tim'], $row['deskripsi'], $row['asal'], $row['logo'], $row['stadium'], $row['pelatih'], $row['pemilik']);
      $listTim[] = $tim;
    }
    return $listTim;
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM tim WHERE id = :id";
    $stmt = Database::query($sql, ['id' => $id]);
    $data = $stmt->fetch();
    $tim = new TimSepakBola($data['id'], $data['nama_tim'], $data['deskripsi'], $data['asal'], $data['logo'], $data['stadium'], $data['pelatih'], $data['pemilik']);
    return $tim;
  }

  public function saveTim(TimSepakBola $tim)
  {
    $sql = "INSERT INTO tim (nama_tim, deskripsi, asal, logo, stadium, pelatih, pemilik) VALUES (:nama_tim, :deskripsi, :asal, :logo, :stadium, :pelatih, :pemilik)";
    $stmt = Database::exec($sql, [
      'nama_tim' => $tim->namaTim,
      'deskripsi' => $tim->deskripsi,
      'asal' => $tim->asal,
      'logo' => $tim->logo,
      'stadium' => $tim->stadium,
      'pelatih' => $tim->pelatih,
      'pemilik' => $tim->pemilik
    ]);
  }

  public function updateTim(TimSepakBola $tim)
  {
    $sql = "UPDATE tim SET nama_tim = :nama_tim, deskripsi = :deskripsi, asal = :asal, logo = :logo, stadium = :stadium, pelatih = :pelatih, pemilik = :pemilik WHERE id = :id";
    $stmt = Database::exec($sql, [
      'nama_tim' => $tim->namaTim,
      'deskripsi' => $tim->deskripsi,
      'asal' => $tim->asal,
      'logo' => $tim->logo,
      'stadium' => $tim->stadium,
      'pelatih' => $tim->pelatih,
      'pemilik' => $tim->pemilik,
      'id' => $tim->id
    ]);
  }

  public function deleteTim(TimSepakBola $tim)
  {
    $sql = "DELETE FROM tim WHERE id = :id";
    $stmt = Database::exec($sql, ['id' => $tim->id]);
  }
}
