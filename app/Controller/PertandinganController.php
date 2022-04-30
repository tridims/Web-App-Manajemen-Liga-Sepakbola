<?php

namespace Tridi\ManajemenLiga\Controller;

use Tridi\ManajemenLiga\App\View;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;
use Tridi\ManajemenLiga\Service\PertandinganService;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\deletePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\createPertandinganRequest;

class PertandinganController
{
  private PertandinganService $pertandinganService;

  public function __construct()
  {
    $repo = new PertandinganRepository();
    $this->pertandinganService = new PertandinganService($repo);
  }

  public function daftarPertandingan()
  {
    $pertandingan = $this->pertandinganService->getRepository()->getAll();
    View::render('daftarPertandingan', ['daftarPertandingan' => $pertandingan]);
  }

  public function editPertandingan($id)
  {
    $pertandingan = $this->pertandinganService->getRepository()->findById($id);
    View::render('editPertandingan', ['daftarPertandingan' => $pertandingan]);
  }

  public function postEditPertandingan($id)
  {
    $updateRequest = new updatePertandinganRequest(
      $id,
      $_POST['tim1'],
      $_POST['tim2'],
      $_POST['jadwalPertandingan'],
      $_POST['jumlahGolTim1'],
      $_POST['jumlahGolTim2'],
    );
    $tim = $this->pertandinganService->editPertandingan($updateRequest);
    // $this->daftarPertandingan();
    header('Location: /pertandingan');
  }

  public function deletePertandingan($id)
  {
    $deleteRequest = new deletePertandinganRequest($id);
    $this->pertandinganService->deletePertandingan($deleteRequest);
    // $this->daftarPertandingan();
    header('Location: /pertandingan');
  }

  public function tambahPertandingan()
  {
    View::render('inputJadwalPertandingan', []);
  }

  public function postTambahPertandingan()
  {
    $createRequest = new createPertandinganRequest(
      $_POST['tim1'],
      $_POST['tim2'],
      $_POST['jadwalPertandingan'],
      $_POST['jumlahGolTim1'],
      $_POST['jumlahGolTim2']
    );
    $tim = $this->pertandinganService->registerPertandingan($createRequest);
    // $this->daftarPertandingan();
    header('Location: /pertandingan');
  }
}
