<?php

namespace Tridi\ManajemenLiga\Controller;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Tridi\ManajemenLiga\Repository\TimRepository;

class TimControllerTest extends TestCase
{
    private TimController $timController;
    private TimRepository $timRepository;

    protected function setUp(): void
    {
        $this->timController = new TimController();

        $this->timRepository = new TimRepository();

    }

     /** @test */
     public function daftarTimTest()
     {
         $this->timController->daftarTim();

         $this->expectOutputRegex("[Daftar Tim Sepak Bola]");
         $this->expectOutputRegex("[No]");
         $this->expectOutputRegex("[Nama Tim]");
         $this->expectOutputRegex("[Deskripsi]");
         $this->expectOutputRegex("[Asal]");
         $this->expectOutputRegex("[Stadium]");
         $this->expectOutputRegex("[Logo]");
         $this->expectOutputRegex("[Pelatih]");
         $this->expectOutputRegex("[Pemilik]");
     }

     /** @test */
     public function editTimTest()
     {

         $this->timController->editTim(1);

         $this->expectOutputRegex("[Edit Tim]");
         $this->expectOutputRegex("[Nama Tim:]");
         $this->expectOutputRegex("[Deskripsi Tim:]");
         $this->expectOutputRegex("[Asal Tim:]");
         $this->expectOutputRegex("[Stadium:]");
         $this->expectOutputRegex("[Logo:]");
         $this->expectOutputRegex("[Pelatih:]");
         $this->expectOutputRegex("[Pemilik:]");
     }

     /** @test */
     public function tambahTimTest()
     //yang kuubah
     {

         $this->timController->tambahTim();

         $this->expectOutputRegex("[Tambah Tim]");
         $this->expectOutputRegex("[Nama Tim]");
         $this->expectOutputRegex("[Asal Tim]");
         $this->expectOutputRegex("[Deskripsi Tim]");
         $this->expectOutputRegex("[Stadium]");
         $this->expectOutputRegex("[Logo]");
         $this->expectOutputRegex("[Pelatih]");
         $this->expectOutputRegex("[Pemilik]");
     }

    /** @test */
    public function editTimBerhasil()
    {
        $id = 1;
        $_POST['namaTim']= "PSMSTest";
        $_POST['deskripsi']= "Test";
        $_POST['asal'] = "Medan";
        $_POST['stadium'] = "StadiumTest";
        $_POST['pelatih'] = "Pelatih Test";
        $_POST['pemilik'] = "PemilikTest";
        $this->timController->postEditTim(1);

        $this->expectOutputString("");
    }

     /** @test */
     public function tambahTimBerhasil()
     {
         $_POST['namaTim']= "Klub Test";
         $_POST['deskripsi']= "Test Desc";
         $_POST['asal'] = "Asal Test";
         $_POST['stadium'] = "StadiumTest";
         $_POST['pelatih'] = "Pelatih Test";
         $_POST['pemilik'] = "PemilikTest";
         $this->timController->postTambahTim();
         $this->expectOutputString("");
     }

     /**@test */
     public function deleteTimBerhasil()
     {
         $this->timController->deleteTim(16);
         $this->expectOutputString("");
     }
}