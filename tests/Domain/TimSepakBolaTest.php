<?php

namespace Tridi\ManajemenLiga\Domain;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Tridi\ManajemenLiga\Repository\TimRepository;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;

class TimSepakBolaTest extends TestCase
{
    private $timRepository;
    private $pertandinganRepository;

    public function setUp(): void
    {
        // create new TimSepakBola dummy Object
        $this->tim1 = new TimSepakBola(1, "Persib", "Persib", "Indonesia", null, "Persib Bandung", "P. S. S. M. Haryadi", "Persib Bandung");
        $this->tim2 = new TimSepakBola(2, "Persija", "Persija", "Indonesia", null, "Persija", "P. S. S. M. Haryadi", "Persija");
        $this->tim3 = new TimSepakBola(3, "Persebaya", "Persebaya", "Indonesia", null, "Persebaya", "P. S. S. M. Haryadi", "Persebaya");

        // create new Pertandingan dummy object
        $pertandingan1 = new Pertandingan(1, $this->tim1, $this->tim2, "2020-01-01", 10, 0);
        $pertandingan2 = new Pertandingan(2, $this->tim1, $this->tim3, "2020-01-02", 5, 5);
        $pertandingan3 = new Pertandingan(3, $this->tim2, $this->tim3, "2020-01-03", 0, 10);
        $pertandingan4 = new Pertandingan(4, $this->tim3, $this->tim1, "2020-01-04", 2, 0);

        $this->tim1->daftarPertandingan = array($pertandingan1, $pertandingan2, $pertandingan4);
        $this->tim2->daftarPertandingan = array($pertandingan1, $pertandingan3);
        $this->tim3->daftarPertandingan = array($pertandingan2, $pertandingan3, $pertandingan4);
    }

    /** @test */
    public function getTotalPoinTest()
    {
        Assert::assertEquals(4, $this->tim1->getTotalPoint());
        Assert::assertEquals(0, $this->tim2->getTotalPoint());
        Assert::assertEquals(7, $this->tim3->getTotalPoint());
    }

    /** @test */
    public function getPointWithOpponentTest()
    {
        Assert::assertEquals(3, $this->tim1->getPointWithOpponent($this->tim2));
        Assert::assertEquals(1, $this->tim1->getPointWithOpponent($this->tim3));
        Assert::assertEquals(0, $this->tim2->getPointWithOpponent($this->tim3));

        Assert::assertEquals(4, $this->tim3->getPointWithOpponent($this->tim1));
        Assert::assertEquals(3, $this->tim3->getPointWithOpponent($this->tim2));
        Assert::assertEquals(0, $this->tim2->getPointWithOpponent($this->tim1));
    }

    /** @test */
    public function getTotalSelisihGolWhenTandingWithTest()
    {
        Assert::assertEquals(10, $this->tim1->getGoalDifferenceWithOpponent($this->tim2));
        Assert::assertEquals(2, $this->tim1->getGoalDifferenceWithOpponent($this->tim3));
        Assert::assertEquals(10, $this->tim2->getGoalDifferenceWithOpponent($this->tim3));

        Assert::assertEquals(2, $this->tim3->getGoalDifferenceWithOpponent($this->tim1));
        Assert::assertEquals(10, $this->tim3->getGoalDifferenceWithOpponent($this->tim2));
        Assert::assertEquals(10, $this->tim2->getGoalDifferenceWithOpponent($this->tim1));
    }

    /** @test */
    public function getTotalGolWhenTandingWithTest()
    {
        Assert::assertEquals(10, $this->tim1->getTotalGoalWithOpponent($this->tim2));
        Assert::assertEquals(5, $this->tim1->getTotalGoalWithOpponent($this->tim3));

        Assert::assertEquals(0, $this->tim2->getTotalGoalWithOpponent($this->tim1));
        Assert::assertEquals(0, $this->tim2->getTotalGoalWithOpponent($this->tim3));

        Assert::assertEquals(7, $this->tim3->getTotalGoalWithOpponent($this->tim1));
        Assert::assertEquals(10, $this->tim3->getTotalGoalWithOpponent($this->tim2));
    }
}
