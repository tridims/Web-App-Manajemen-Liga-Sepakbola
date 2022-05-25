<?php

namespace Tridi\ManajemenLiga\Domain;

use Exception;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;

class PertandinganTest extends TestCase
{
    public function setUp(): void
    {
        // create new TimSepakBola dummy Object
        $this->tim1 = new TimSepakBola(1, "Persib", "Persib", "Indonesia", null, "Persib Bandung", "P. S. S. M. Haryadi", "Persib Bandung");
        $this->tim2 = new TimSepakBola(2, "Persija", "Persija", "Indonesia", null, "Persija", "P. S. S. M. Haryadi", "Persija");
        $this->tim3 = new TimSepakBola(3, "Persebaya", "Persebaya", "Indonesia", null, "Persebaya", "P. S. S. M. Haryadi", "Persebaya");

        // create new Pertandingan dummy object
        $this->pertandingan1 = new Pertandingan(1, $this->tim1, $this->tim2, "2020-01-01", 10, 0);
        $this->pertandingan2 = new Pertandingan(2, $this->tim1, $this->tim3, "2020-01-02", 5, 5);
        $this->pertandingan3 = new Pertandingan(3, $this->tim2, $this->tim3, "2020-01-03", 0, 10);
        $this->pertandingan4 = new Pertandingan(4, $this->tim3, $this->tim1, "2020-01-04", 2, 0);
    }

    /** @test */
    public function testGetArrayIdTeam()
    {
        Assert::assertContains($this->tim1->id, $this->pertandingan1->getArrayIdTeam());
        Assert::assertContains($this->tim2->id, $this->pertandingan1->getArrayIdTeam());
        Assert::assertContains($this->tim3->id, $this->pertandingan2->getArrayIdTeam());
        Assert::assertContains($this->tim3->id, $this->pertandingan3->getArrayIdTeam());
        Assert::assertContains($this->tim1->id, $this->pertandingan4->getArrayIdTeam());
    }

    /** @test */
    public function testGetSelisihGol()
    {
        Assert::assertEquals(10, $this->pertandingan1->getSelisihGol());
        Assert::assertEquals(0, $this->pertandingan2->getSelisihGol());
        Assert::assertEquals(10, $this->pertandingan3->getSelisihGol());
        Assert::assertEquals(2, $this->pertandingan4->getSelisihGol());
    }

    /** @test */
    public function testGetTotalGoalFromTeam()
    {
        Assert::assertEquals(10, $this->pertandingan1->getTotalGoalFromTeam($this->tim1->id));
        Assert::assertEquals(0, $this->pertandingan1->getTotalGoalFromTeam($this->tim2->id));

        Assert::assertEquals(5, $this->pertandingan2->getTotalGoalFromTeam($this->tim1->id));
        Assert::assertEquals(5, $this->pertandingan2->getTotalGoalFromTeam($this->tim3->id));

        Assert::assertEquals(0, $this->pertandingan3->getTotalGoalFromTeam($this->tim2->id));
        Assert::assertEquals(10, $this->pertandingan3->getTotalGoalFromTeam($this->tim3->id));

        Assert::assertEquals(2, $this->pertandingan4->getTotalGoalFromTeam($this->tim3->id));
        Assert::assertEquals(0, $this->pertandingan4->getTotalGoalFromTeam($this->tim1->id));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Tim tidak ditemukan");
        Assert::assertEquals(0, $this->pertandingan4->getTotalGoalFromTeam($this->tim2->id));
    }

    /** @test */
    public function testGetScoreForTim()
    {
        Assert::assertEquals(3, $this->pertandingan1->getScoreForTim($this->tim1->id));
        Assert::assertEquals(1, $this->pertandingan2->getScoreForTim($this->tim3->id));
        Assert::assertEquals(0, $this->pertandingan3->getScoreForTim($this->tim2->id));
    }

    /** @test */
    public function testGetScoreTim1()
    {
        Assert::assertEquals(3, $this->pertandingan1->getScoreTim1());
        Assert::assertEquals(1, $this->pertandingan2->getScoreTim1());
    }

    /** @test */
    public function TestGetScoreTim2()
    {
        Assert::assertEquals(0, $this->pertandingan1->getScoreTim2());
        Assert::assertEquals(1, $this->pertandingan2->getScoreTim2());
    }

    /** @test */
    public function TestGetWinner()
    {
        Assert::assertEquals($this->tim1, $this->pertandingan1->getWinner());
        Assert::assertEquals(null, $this->pertandingan2->getWinner());
        Assert::assertEquals($this->tim3, $this->pertandingan3->getWinner());
    }
}
