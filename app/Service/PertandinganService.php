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

    public function __construct(PertandinganRepository $pertandinganRepository, TimRepository $timRepository)
    {
        $this->pertandinganRepository = $pertandinganRepository;
        $this->timRepository = $timRepository;
    }

    public function getRepository(): PertandinganRepository
    {
        return $this->pertandinganRepository;
    }

    public function registerPertandingan(createPertandinganRequest $request): void
    {
        try {
            Database::beginTransaction();

            $pertandingan = new Pertandingan(
                null,
                $this->timRepository->findById($request->idTim1),
                $this->timRepository->findById($request->idTim2),
                $request->jadwalMain,
                $request->jumlahGolTim1,
                $request->jumlahGolTim2
            );
            $this->pertandinganRepository->savePertandingan($pertandingan);
            Database::commitTransaction();
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            throw $e;
        }
    }

    public function updatePertandingan(updatePertandinganRequest $request): PertandinganResponse
    {
        try {
            Database::beginTransaction();

            $pertandingan = $this->pertandinganRepository->findById($request->id);
            if ($pertandingan == null) {
                throw new \Exception("Pertandingan tidak ditemukan");
            }

            $tim1 = $pertandingan->tim1;
            $tim2 = $pertandingan->tim2;
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

    public function deletePertandingan(deletePertandinganRequest $request): PertandinganResponse
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
}
