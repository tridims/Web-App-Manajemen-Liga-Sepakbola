<?php

namespace Tridi\ManajemenLiga\Controller;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;

class PertandinganControllerTest extends TestCase
{
    private PertandinganController $pertandinganController;
    private PertandinganRepository $pertandinganRepository;

    protected function setUp(): void
    {
        $this->pertandinganController = new PertandinganController();
        $this->pertandinganRepository = new PertandinganRepository();
    }

    /** @test */
    public function daftarPertandinganTest()
    {
        $this->pertandinganController->daftarPertandingan();

        $this->expectOutputRegex("[Daftar Pertandingan Sepak Bola]");
        $this->expectOutputRegex("[timId]");
        $this->expectOutputRegex("[Tim Home]");
        $this->expectOutputRegex("[Tim Away]");
        $this->expectOutputRegex("[Jadwal Pertandingan]");
        $this->expectOutputRegex("[Jumlah Gol Tim Home]");
        $this->expectOutputRegex("[Jumlah Gol Tim Away]");
        $this->expectOutputRegex("[Action]");

        $daftarPertandingan = $this->pertandinganRepository->getAll();
        foreach ($daftarPertandingan as $pertandingan) {
            $this->expectOutputRegex("[{$pertandingan->tim1->namaTim}]");
        }
    }

    /** @test */
    public function editPertandinganTest()
    {

        $this->pertandinganController->editPertandingan(3);

        $this->expectOutputRegex("[Edit Pertandingan]");
        $this->expectOutputRegex("[Id Tim 1]");
        $this->expectOutputRegex("[Id Tim 2]");
        $this->expectOutputRegex("[Jadwal Pertandingan]");
        $this->expectOutputRegex("[Jumlah Gol Tim 1]");
        $this->expectOutputRegex("[Jumlah Gol Tim 2]");
    }


    /** @test */
    public function tambahPertandinganTest()
    {
        $this->pertandinganController->tambahPertandingan();

        $this->expectOutputRegex("[Input Jadwal Pertandingan]");
        $this->expectOutputRegex("[Id Tim 1]");
        $this->expectOutputRegex("[Id Tim 2]");
        $this->expectOutputRegex("[Jadwal Pertandingan]");
        $this->expectOutputRegex("[Jumlah Gol Tim 1]");
        $this->expectOutputRegex("[Jumlah Gol Tim 2]");
    }

    public function testEditPertandinganBerhasil()
    {
        $id = "3";
        $_POST['tim1'] = "11";
        $_POST['tim2'] = "1";
        $_POST['jadwalPertandingan'] = "2022-05-05";
        $_POST['jumlahGolTim1'] = "4";
        $_POST['jumlahGolTim2'] = "3";
        $this->pertandinganController->postEditPertandingan(3);

        $this->expectOutputString("");
    }

    public function testTambahPertandinganBerhasil()
    {
        $_POST['tim1'] = "1";
        $_POST['tim2'] = "2";
        $_POST['jadwalPertandingan'] = "2022-11-22";
        $_POST['jumlahGolTim1'] = "4";
        $_POST['jumlahGolTim2'] = "5";
        $this->pertandinganController->postTambahPertandingan();

        $this->expectOutputString("");
    }
//
}