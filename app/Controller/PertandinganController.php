<?php

namespace Tridi\ManajemenLiga\Controller;

use Tridi\ManajemenLiga\App\View;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;
use Tridi\ManajemenLiga\Repository\TimRepository;
use Tridi\ManajemenLiga\Service\PertandinganService;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\deletePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\createPertandinganRequest;

class PertandinganController
{
  private PertandinganService $pertandinganService;

  public function __construct()
  {
    $pertandinganRepository = new PertandinganRepository();
    $timRepository = new TimRepository();
    $this->pertandinganService = new PertandinganService($pertandinganRepository, $timRepository);
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
    $tim = $this->pertandinganService->updatePertandingan($updateRequest);
    try {
        View::redirect('Location: /pertandingan');
    } catch (\Exception $e) {}
  }

  public function deletePertandingan($id)
  {
    $deleteRequest = new deletePertandinganRequest($id);
    $this->pertandinganService->deletePertandingan($deleteRequest);
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
    $this->pertandinganService->registerPertandingan($createRequest);
    try {
        header('Location: /pertandingan');
    } catch (\Exception $e) {}
  }
}
