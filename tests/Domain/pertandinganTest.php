<?php

namespace Tridi\ManajemenLiga\Domain;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;

class pertandinganTest extends TestCase
{
    /** @test */
    public function TestGetArrayIdTeam()
    {
        $pertandinganRepository = new PertandinganRepository();
        $pertandingan = $pertandinganRepository->findById(1);
        Assert::assertContains(1, $pertandingan->getArrayIdTeam());
    }

    /** @test */
    public function TestGetSelisihGol()
    {
        $pertandinganRepository = new PertandinganRepository();
        $pertandingan = $pertandinganRepository->findById(3);
        Assert::assertEquals(3, $pertandingan->getSelisihGol());
    }

    /** @test */
    public function TestGetJumlahGolForTim()
    {
        $pertandinganRepository = new PertandinganRepository();
        $pertandingan = $pertandinganRepository->findById(1);
        $tim = $pertandingan->tim1->id;
        Assert::assertEquals(3, $pertandingan->getJumlahGolForTim($tim));
    }

    /** @test */
    public function TestGetScoreForTim()
    {
        $pertandinganRepository = new PertandinganRepository();
        $pertandingan = $pertandinganRepository->findById(1);
        $tim = $pertandingan->tim1->id;
        Assert::assertEquals(3, $pertandingan->getScoreForTim($tim));
    }


    /** @test */
    public function TestGetScoreTim1()
    {
        $pertandinganRepository = new PertandinganRepository();
        $pertandingan = $pertandinganRepository->findById(1);
        $tim = $pertandingan->tim1->id;
        Assert::assertEquals(3, $pertandingan->getScoreTim1());
    }


    /** @test */
    public function TestGetScoreTim2()
    {
        $pertandinganRepository = new PertandinganRepository();
        $pertandingan = $pertandinganRepository->findById(1);
        $tim = $pertandingan->tim2->id;
        Assert::assertEquals(0, $pertandingan->getScoreTim2());
    }


    /** @test */
    public function TestGetWinner()
    {
        $pertandinganRepository = new PertandinganRepository();
        $pertandingan = $pertandinganRepository->findById(1);
        $tim = $pertandingan->tim1->id;
        Assert::assertEquals($pertandingan->tim1, $pertandingan->getWinner());
    }
}
