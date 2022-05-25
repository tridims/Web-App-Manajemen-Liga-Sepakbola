<?php

namespace Tridi\ManajemenLiga\Service;

use Exception;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Tridi\ManajemenLiga\Domain\TimSepakBola;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;
use Tridi\ManajemenLiga\Repository\TimRepository;
use Tridi\ManajemenLiga\Service;
use Tridi\ManajemenLiga\Model\Tim\createTimRequest;
use Tridi\ManajemenLiga\Model\Tim\updateTimRequest;
use Tridi\ManajemenLiga\Model\Tim\deleteTimRequest;

class TimServiceTest extends TestCase
{
    private TimService $timService;

    protected function setUp(): void
    {
        $this->timService = new TimService(new TimRepository(), new PertandinganRepository());
    }

    public function testRegisterTim(): TimSepakBola
    {
        $req = new createTimRequest(
            uniqid(),
            uniqid(),
            uniqid(),
            null,
            uniqid(),
            uniqid(),
            uniqid()
        );

        $this->timService->registerTim($req);

        $daftar_tim = $this->timService->getTimRepository()->getAll();
        $daftar_tim = array_filter($daftar_tim, function ($tim) use ($req) {
            return $tim->namaTim == $req->namaTim;
        });
        $this->assertEquals(1, count($daftar_tim));
        return array_pop($daftar_tim);
    }

    /**
     * @depends testRegisterTim
     */
    public function testUpdateTim(TimSepakBola $tim) : TimSepakBola {
        $req = new updateTimRequest(
            $tim->id,
            uniqid(),
            uniqid(),
            uniqid(),
            null,
            uniqid(),
            uniqid(),
            uniqid()
        );

        $this->timService->updateTim($req);

        $tim = $this->timService->getTimRepository()->findById($tim->id);
        $this->assertEquals($req->namaTim, $tim->namaTim);

        return $tim;
    }

    /**
     * @depends testUpdateTim
     */
    public function testDeleteTim(TimSepakBola $tim) : void {
        $req = new deleteTimRequest($tim->id);

        $this->timService->deleteTim($req);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Tim tidak ditemukan");
        $this->timService->getTimRepository()->findById($tim->id);
    }
}