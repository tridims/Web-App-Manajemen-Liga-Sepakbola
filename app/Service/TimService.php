<?php

namespace Tridi\ManajemenLiga\Service;

use Tridi\ManajemenLiga\Domain\TimSepakBola;
use Tridi\ManajemenLiga\Model\Tim\createTimRequest;
use Tridi\ManajemenLiga\Model\Tim\deleteTimRequest;
use Tridi\ManajemenLiga\Model\Tim\TimResponse;
use Tridi\ManajemenLiga\Model\Tim\updateTimRequest;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;
use Tridi\ManajemenLiga\Repository\TimRepository;

class TimService
{
  private TimRepository $timRepository;
  private PertandinganRepository $pertandinganRepository;

  public function __construct(TimRepository $timRepository, PertandinganRepository $pertandinganRepository)
  {
    $this->timRepository = $timRepository;
    $this->pertandinganRepository = $pertandinganRepository;
  }

  public function registerTim(createTimRequest $request)
  {
    try {
      Database::beginTransaction();

      // cek apakah tim sudah terdaftar
      // $tim = $this->timRepository->findById($request->id);
      // if ($tim != null) {
      //   throw new \Exception("Tim sudah terdaftar");
      // }

      // $tim = new TimSepakBola($request->id, $request->namaTim, $request->deskripsi, $request->asal, $request->logo, $request->stadium, $request->pelatih, $request->pemilik);
      $this->timRepository->saveTim($request);

      Database::commitTransaction();
      // return new TimResponse($tim);
    } catch (\Exception $e) {
      Database::rollbackTransaction();
      throw $e;
    }
  }

  public function updateTim(updateTimRequest $request)
  {
    try {
      Database::beginTransaction();

      // cek apakah tim sudah terdaftar
      $tim = $this->timRepository->findById($request->id);
      if ($tim == null) {
        throw new \Exception("Tim tidak terdaftar");
      }

      // buat objek tim baru dari request
      $tim = new TimSepakBola($request->id, $request->namaTim, $request->deskripsi, $request->asal, $request->logo, $request->stadium, $request->pelatih, $request->pemilik);
      $this->timRepository->updateTim($request);

      Database::commitTransaction();
      return new TimResponse($tim);
    } catch (\Exception $e) {
      Database::rollbackTransaction();
      throw $e;
    }
  }

  public function deleteTim(deleteTimRequest $request)
  {
    try {
      Database::beginTransaction();

      // cek apakah tim sudah terdaftar
      $tim = $this->timRepository->findById($request->id);
      if ($tim == null) {
        throw new \Exception("Tim tidak terdaftar");
      }

      $this->timRepository->deleteTim($request);

      Database::commitTransaction();
      return new TimResponse($tim);
    } catch (\Exception $e) {
      Database::rollbackTransaction();
      throw $e;
    }
  }
}
