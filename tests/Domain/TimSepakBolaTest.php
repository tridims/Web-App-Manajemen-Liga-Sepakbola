<?php

namespace Tridi\ManajemenLiga\Domain;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Tridi\ManajemenLiga\Repository\TimRepository;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;

class TimSepakBolaTest extends TestCase
{
    /** @test */
    public function getTotalPoinTest()
    {
        $timRepository = new TimRepository();
        $pertandinganRepository = new PertandinganRepository();
        // $tim = new TimSepakBola(0, "PSMS", "-", "Medan", null, "Teladan", "Ansyari Lubis", "Edi Rahmayadi");
        $tim = $timRepository->findById(1);
        $tim->daftarPertandingan = $pertandinganRepository->getPertandinganByTimId($tim->id);
        Assert::assertEquals(3, $tim->getTotalPoin());
    }


    /** @test */
    public function getPoinTandingWithTest()
    {
        $timRepository = new TimRepository();
        $pertandinganRepository = new PertandinganRepository();
        $tim1 = $timRepository->findById(1);
        $tim1->daftarPertandingan = $pertandinganRepository->getPertandinganByTimId($tim1->id);
        $tim2 = $timRepository->findById(2);
        $tim2->daftarPertandingan = $pertandinganRepository->getPertandinganByTimId($tim2->id);
        // Assert::assertEquals(null, $tim1->daftarPertandingan);
        Assert::assertEquals(6, $tim1->getPoinWhenTandingWith($tim2));
    }

    /** @test */
    public function getTotalSelisihGolWhenTandingWithTest()
    {
        $timRepository = new TimRepository();
        $pertandinganRepository = new PertandinganRepository();
        $tim1 = $timRepository->findById(1);
        $tim1->daftarPertandingan = $pertandinganRepository->getPertandinganByTimId($tim1->id);
        $tim2 = $timRepository->findById(11);
        $tim2->daftarPertandingan = $pertandinganRepository->getPertandinganByTimId($tim2->id);
        Assert::assertEquals(3, $tim1->getTotalSelisihGolWhenTandingWith($tim2));
    }

    /** @test */
    public function getTotalGolWhenTandingWithTest()
    {
        $timRepository = new TimRepository();
        $pertandinganRepository = new PertandinganRepository();
        $tim1 = $timRepository->findById(1);
        $tim1->daftarPertandingan = $pertandinganRepository->getPertandinganByTimId($tim1->id);
        $tim2 = $timRepository->findById(2);
        $tim2->daftarPertandingan = $pertandinganRepository->getPertandinganByTimId($tim2->id);
        Assert::assertEquals(3, $tim1->getTotalGolWhenTandingWith($tim2));
    }
}
