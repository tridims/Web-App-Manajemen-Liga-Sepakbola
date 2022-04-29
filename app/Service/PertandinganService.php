<?php

namespace Tridi\ManajemenLiga\Service;

use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Model\Pertandingan\changeScorePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\createPertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\deletePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\PertandinganResponse;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;

class PertandinganService
{
  private PertandinganRepository $pertandinganRepository;

  public function __construct(PertandinganRepository $pertandinganRepository)
  {
    $this->pertandinganRepository = $pertandinganRepository;
  }

  public function registerPertandingan(createPertandinganRequest $request)
  {
    try {
      Database::beginTransaction();

      $pertandingan = new Pertandingan(
        $request->id,
        $request->tim1,
        $request->tim2,
        $request->jadwalMain,
        $request->jumlahGolTim1,
        $request->jumlahGolTim2
      );

      $this->pertandinganRepository->savePertandingan($pertandingan);
      Database::commitTransaction();
      return new PertandinganResponse($pertandingan);
    } catch (\Exception $e) {
      Database::rollbackTransaction();
      throw $e;
    }
  }

  public function updatePertandingan(updatePertandinganRequest $request)
  {
    try {
      Database::beginTransaction();

      $pertandingan = $this->pertandinganRepository->findById($request->id);
      if ($pertandingan != null) {
        throw new \Exception("Pertandingan tidak ditemukan");
      }

      $pertandingan = new Pertandingan(
        $request->id,
        $request->tim1,
        $request->tim2,
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

      $this->pertandinganRepository->deletePertandingan($pertandingan);
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
