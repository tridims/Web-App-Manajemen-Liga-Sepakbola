<?php

namespace Tridi\ManajemenLiga\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;
use Tridi\ManajemenLiga\Repository\TimRepository;
use Tridi\ManajemenLiga\Service\PertandinganService;
use Tridi\ManajemenLiga\Model\Pertandingan\createPertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\deletePertandinganRequest;


class PertandinganServiceTest extends TestCase
{
    private PertandinganService $pertandinganService;

    protected function setUp(): void
    {
        $this->pertandinganService = new PertandinganService(
            new PertandinganRepository(),
            new TimRepository()
        );
    }

    public function testRegisterPertandingan(): Pertandingan
    {
        $req = new createPertandinganRequest("1", "2", "2022-07-10", rand(1, 100), rand(1, 100));
        $this->pertandinganService->registerPertandingan($req);

        $list_pertandingan = $this->pertandinganService->getRepository()->getPertandinganByTimId(1);
        $list_pertandingan = array_filter($list_pertandingan, function ($pertandingan) use ($req) {
            return $pertandingan->tim1->id == $req->idTim1 &&
                $pertandingan->tim2->id == $req->idTim2 &&
                $pertandingan->jadwalMain == $req->jadwalMain &&
                $pertandingan->jumlahGolTim1 == $req->jumlahGolTim1 &&
                $pertandingan->jumlahGolTim2 == $req->jumlahGolTim2;
        });
        Assert::assertEquals(1, count($list_pertandingan));
        return array_pop($list_pertandingan);
    }

    /**
     * @depends testRegisterPertandingan
     */
    public function testUpdatePertandingan(Pertandingan $pertandingan): Pertandingan
    {
        $req = new updatePertandinganRequest($pertandingan->id, $pertandingan->tim1->id,
            $pertandingan->tim2->id, "2022-11-21", rand(1, 100), rand(1, 100));

        $res = $this->pertandinganService->updatePertandingan($req);

        $list_pertandingan = $this->pertandinganService->getRepository()->getPertandinganByTimId(1);
        $list_pertandingan = array_filter($list_pertandingan, function ($pertandingan) use ($req) {
            return $pertandingan->tim1->id == $req->idTim1 &&
                $pertandingan->tim2->id == $req->idTim2 &&
                $pertandingan->jadwalMain == $req->jadwalMain &&
                $pertandingan->jumlahGolTim1 == $req->jumlahGolTim1 &&
                $pertandingan->jumlahGolTim2 == $req->jumlahGolTim2;
        });
        Assert::assertEquals(1, count($list_pertandingan));
        return array_pop($list_pertandingan);
    }

    /**
     * @depends testUpdatePertandingan
     */
    public function testDeletePertandingan(Pertandingan $pertandingan)
    {
        $req = new deletePertandinganRequest($pertandingan->id);
        $res = $this->pertandinganService->deletePertandingan($req);

        $list_pertandingan = $this->pertandinganService->getRepository()->getPertandinganByTimId(1);
        $list_pertandingan = array_filter($list_pertandingan, function ($pertandingan) use ($res) {
            return $pertandingan->tim1->id == $res->pertandingan->tim1->id &&
                $pertandingan->tim2->id == $res->pertandingan->tim2->id &&
                $pertandingan->jadwalMain == $res->pertandingan->jadwalMain &&
                $pertandingan->jumlahGolTim1 == $res->pertandingan->jumlahGolTim1 &&
                $pertandingan->jumlahGolTim2 == $res->pertandingan->jumlahGolTim2;
        });
        Assert::assertEquals(0, count($list_pertandingan));
    }
}

