<?php

namespace Tridi\ManajemenLiga\Service;

use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Model\Pertandingan\changeScorePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\createPertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\deletePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\PertandinganResponse;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
use Tridi\ManajemenLiga\Model\Tim\TimResponse;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;
use Tridi\ManajemenLiga\Repository\TimRepository;

class PertandinganService
{
  private PertandinganRepository $pertandinganRepository;
  private TimRepository $timRepository;

  public function __construct(PertandinganRepository $pertandinganRepository)
  {
    $this->pertandinganRepository = $pertandinganRepository;
    $this->timRepository = new TimRepository();
  }

  public function getRepository(): PertandinganRepository
  {
    return $this->pertandinganRepository;
  }

  public function registerPertandingan(createPertandinganRequest $request)
  {
    try {
      Database::beginTransaction();

      $this->pertandinganRepository->savePertandingan($request);
      Database::commitTransaction();
    } catch (\Exception $e) {
      Database::rollbackTransaction();
      throw $e;
    }
  }

  public function editPertandingan(updatePertandinganRequest $request)
  {
    try {
      Database::beginTransaction();

      $pertandingan = $this->pertandinganRepository->findById($request->id);
      if ($pertandingan == null) {
        throw new \Exception("Pertandingan tidak ditemukan");
      }

      // TODO : timnya harus berupa objek
      $tim1 = $this->timRepository->findById($request->idTim1);
      $tim2 = $this->timRepository->findById($request->idTim2);
      $pertandingan = new Pertandingan(
        $request->id,
        $tim1,
        $tim2,
        $request->jadwalMain,
        $request->jumlahGolTim1,
        $request->jumlahGolTim2
      );

      $this->pertandinganRepository->updatePertandingan($pertandingan);
      Database::commitTransaction();
      return new PertandinganResponse($pertandingan);
    } catch (\Exception $e) {
      Database::rollbackTransaction();
      throw $e;
    }
  }

  public function deletePertandingan(deletePertandinganRequest $request)
  {
    try {
      Database::beginTransaction();

      $pertandingan = $this->pertandinganRepository->findById($request->id);
      if ($pertandingan == null) {
        throw new \Exception("Pertandingan tidak ditemukan");
      }

      $this->pertandinganRepository->deletePertandingan($request->id);
      Database::commitTransaction();
      return new PertandinganResponse($pertandingan);
    } catch (\Exception $e) {
      Database::rollbackTransaction();
      throw $e;
    }
  }

  public function changeScore(changeScorePertandinganRequest $request)
  {
    try {
      Database::beginTransaction();

      $pertandingan = $this->pertandinganRepository->findById($request->id);
      if ($pertandingan == null) {
        throw new \Exception("Pertandingan tidak ditemukan");
      }

      $pertandingan->jumlahGolTim1 = $request->jumlahGolTim1;
      $pertandingan->jumlahGolTim2 = $request->jumlahGolTim2;

      $this->pertandinganRepository->updatePertandingan($pertandingan);
      Database::commitTransaction();
      return new PertandinganResponse($pertandingan);
    } catch (\Exception $e) {
      Database::rollbackTransaction();
      throw $e;
    }
  }
}
