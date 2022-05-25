<?php

namespace Tridi\ManajemenLiga\Repository;

use PHPUnit\Framework\TestCase;
use Tridi\ManajemenLiga\Domain\TimSepakBola;
use Tridi\ManajemenLiga\Model\Pertandingan\createPertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\deletePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Service\Database;

use function PHPUnit\Framework\assertEquals;

class PertandinganRepositoryTest extends TestCase
{
  private PertandinganRepository $pertandinganRepository;
  private Pertandingan $pertandingan;

  public function setUp(): void
  {
    $this->pertandinganRepository = new PertandinganRepository();

    $this->pertandingan = new Pertandingan(
        null,
        new TimSepakBola(1, "random", "random", "random", null, "random", "random", "random"),
        new TimSepakBola(2, "random", "random", "random", null, "random", "random", "random"),
        "2077-01-01",
        rand(0, 100),
        rand(0, 100)
    );
  }

  public function testGetPertandinganByTimId()
  {
    $timId = 1;
    $pertandinganList = $this->pertandinganRepository->getPertandinganByTimId($timId);

    foreach ($pertandinganList as $pertandingan) {
      $this->assertContains($timId, array($pertandingan->tim1->id, $pertandingan->tim2->id));
    }
  }

  public function testGetAll()
  {
    $pertandinganList = $this->pertandinganRepository->getAll();

    # check for every pertandingan in pertandinganList is unique
    foreach ($pertandinganList as $pertandingan) {
      $this->assertEquals(1, count(array_filter($pertandinganList, function ($pertandingan2) use ($pertandingan) {
        return $pertandingan->id == $pertandingan2->id;
      })));
    }
  }

  public function testFindById()
  {
    // Test apakah id dari pertandingan yang dikembalikan benar dengan yang dicari
    $list_pertandingan = $this->pertandinganRepository->getAll();
    foreach ($list_pertandingan as $pertandingan) {
      $id_pertandingan = $pertandingan->id;
      $pertandingan_dicari = $this->pertandinganRepository->findById($id_pertandingan);
      $this->assertEquals($id_pertandingan, $pertandingan_dicari->id);
    }
  }

  public function testFindById_NotFound()
  {
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Pertandingan tidak ditemukan");
    $this->pertandinganRepository->findById(10000);
  }

  public function testFindById_InvalidId()
  {
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Id tidak valid");
    $this->pertandinganRepository->findById(-10);
  }

  public function testSavePertandingan(): Pertandingan
  {
    $this->pertandinganRepository->savePertandingan($this->pertandingan);

    $stmt = Database::query("select * from pertandingan where id_pertandingan=(SELECT LAST_INSERT_ID());");

    # get the id from the result of those queries
    $id = $stmt->fetch()['id_pertandingan'];

    $insertedPertandingan = $this->pertandinganRepository->findById($id);
    $this->assertEquals($this->pertandingan->tim1->id, $insertedPertandingan->tim1->id);
    $this->assertEquals($this->pertandingan->tim2->id, $insertedPertandingan->tim2->id);
    $this->assertEquals($this->pertandingan->jadwalMain, $insertedPertandingan->jadwalMain);
    $this->assertEquals($this->pertandingan->jumlahGolTim1, $insertedPertandingan->jumlahGolTim1);
    $this->assertEquals($this->pertandingan->jumlahGolTim2, $insertedPertandingan->jumlahGolTim2);

    return $insertedPertandingan;
  }

  /**
   * @depends testSavePertandingan
   */
  public function testUpdatePertandingan(Pertandingan $insertedPertandingan)
  {
    $insertedPertandingan->jumlahGolTim1 = rand(0, 100);
    $insertedPertandingan->jumlahGolTim2 = rand(0, 100);

    $this->pertandinganRepository->updatePertandingan($insertedPertandingan);

    $updatedPertandingan = $this->pertandinganRepository->findById($insertedPertandingan->id);

    $this->assertEquals($updatedPertandingan->jumlahGolTim1, $insertedPertandingan->jumlahGolTim1);
    $this->assertEquals($updatedPertandingan->jumlahGolTim2, $insertedPertandingan->jumlahGolTim2);
    $this->assertEquals($updatedPertandingan->tim1->id, $insertedPertandingan->tim1->id);
    $this->assertEquals($updatedPertandingan->tim2->id, $insertedPertandingan->tim2->id);
    $this->assertEquals($updatedPertandingan->jadwalMain, $insertedPertandingan->jadwalMain);
    $this->assertEquals($updatedPertandingan->id, $insertedPertandingan->id);

    return $insertedPertandingan;
  }

  /**
   * @depends testUpdatePertandingan
   */
  public function testDeletePertandingan(Pertandingan $insertedPertandingan)
  {
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Pertandingan tidak ditemukan");

    $this->pertandinganRepository->deletePertandingan($insertedPertandingan);

    $this->pertandinganRepository->findById($insertedPertandingan->id);
  }
}
