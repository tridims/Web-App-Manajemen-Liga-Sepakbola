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

    public function __construct(TimRepository $timRepository)
    {
        $this->timRepository = $timRepository;
    }

    public function getTimRepository(): TimRepository
    {
        return $this->timRepository;
    }

    public function registerTim(createTimRequest $request): void
    {
        try {
            Database::beginTransaction();

            $tim = new TimSepakBola(
                null,
                $request->namaTim,
                $request->deskripsi,
                $request->asal,
                $request->logo,
                $request->stadium,
                $request->pelatih,
                $request->pemilik
            );

            $this->timRepository->saveTim($tim);

            Database::commitTransaction();
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            throw $e;
        }
    }

    public function updateTim(updateTimRequest $request): TimResponse
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

            $this->timRepository->updateTim($tim);

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

            $this->timRepository->deleteTim($tim->id);

            Database::commitTransaction();
            return new TimResponse($tim);
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            throw $e;
        }
    }
}
