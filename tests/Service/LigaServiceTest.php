<?php

namespace Tridi\ManajemenLiga\Service;

use PHPUnit\Framework\TestCase;
use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Domain\TimSepakBola;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;
use Tridi\ManajemenLiga\Repository\TimRepository;

class LigaServiceTest extends TestCase {
    private LigaService $ligaService;

    public function setUp(): void {
        $this->ligaService = new LigaService(new TimRepository(), new PertandinganRepository());

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

        $this->daftarTim = array($this->tim1, $this->tim2, $this->tim3);
    }

    public function testUrutkanTim() {
        $daftarTimTerurut = LigaService::urutkanTim($this->daftarTim);

        $this->assertEquals($this->tim3, $daftarTimTerurut[0]);
        $this->assertEquals($this->tim1, $daftarTimTerurut[1]);
        $this->assertEquals($this->tim2, $daftarTimTerurut[2]);
    }
}