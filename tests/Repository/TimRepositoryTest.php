<?php

namespace Tridi\ManajemenLiga\Repository;

use PHPUnit\Framework\TestCase;
use Tridi\ManajemenLiga\Domain\TimSepakBola;

class TimRepositoryTest extends TestCase
{
  private TimRepository $timRepository;

  public function __construct()
  {
    parent::__construct();
    $this->timRepository = new TimRepository();
  }

  public function testGetAll()
  {
    $timList = $this->timRepository->getAll();

    # check for every tim in timList is unique
    foreach ($timList as $tim) {
      $this->assertEquals(1, count(array_filter($timList, function ($tim2) use ($tim) {
        return $tim->id == $tim2->id;
      })));
    }
  }

  /**
   * @depends testGetAll
   */
  public function testFindById()
  {
    // Test apakah id dari tim yang dikembalikan benar dengan yang dicari
    $list_tim = $this->timRepository->getAll();
    foreach ($list_tim as $tim) {
      $id_tim = $tim->id;
      $tim_dicari = $this->timRepository->findById($id_tim);
      $this->assertEquals($id_tim, $tim_dicari->id);
    }
  }

  public function testSaveTim()
  {
    $tim = new TimSepakBola(null, uniqid(), uniqid(), uniqid(), null, uniqid(), uniqid(), uniqid());
    $this->timRepository->saveTim($tim);

    $listInsertedTim = $this->timRepository->getAll();

    $insertedTeam = array_filter($listInsertedTim, function ($insertedTim) use ($tim) {
      return $tim->namaTim == $insertedTim->namaTim &&
        $tim->deskripsi == $insertedTim->deskripsi &&
        $tim->asal == $insertedTim->asal &&
        $tim->stadium == $insertedTim->stadium &&
        $tim->pelatih == $insertedTim->pelatih &&
        $tim->pemilik == $insertedTim->pemilik;
    });

    // var_dump($insertedTeam);

    // check if there is team with the same attributes
    $this->assertEquals(1, count($insertedTeam));

    # return first element of array
    return array_values($insertedTeam)[0];
  }

  /**
   * @depends testSaveTim
   */
  public function testUpdateTim(TimSepakBola $insertedTeam)
  {
    $insertedTeam->namaTim = "Testing Tim Updated";
    $insertedTeam->deskripsi = "Deskripsi Tim Updated";
    $insertedTeam->asal = "Asal Tim Updated";
    $insertedTeam->stadium = "Stadium Tim Updated";
    $insertedTeam->pelatih = "Pelatih Tim Updated";
    $insertedTeam->pemilik = "Pemilik Tim Updated";

    $this->timRepository->updateTim($insertedTeam);

    $updatedTeam = $this->timRepository->findById($insertedTeam->id);

    $this->assertEquals($insertedTeam->namaTim, $updatedTeam->namaTim);
    $this->assertEquals($insertedTeam->deskripsi, $updatedTeam->deskripsi);
    $this->assertEquals($insertedTeam->asal, $updatedTeam->asal);
    $this->assertEquals($insertedTeam->stadium, $updatedTeam->stadium);
    $this->assertEquals($insertedTeam->pelatih, $updatedTeam->pelatih);
    $this->assertEquals($insertedTeam->pemilik, $updatedTeam->pemilik);

    return $updatedTeam;
  }

  /**
   * @depends testUpdateTim
   */
  public function testDeleteTim(TimSepakBola $updatedTeam)
  {
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Tim tidak ditemukan');
    $this->timRepository->deleteTim($updatedTeam->id);

    $deletedTeam = $this->timRepository->findById($updatedTeam->id);
  }
}
