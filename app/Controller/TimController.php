<?php

namespace Tridi\ManajemenLiga\Controller;

use Tridi\ManajemenLiga\App\View;
use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
use Tridi\ManajemenLiga\Model\Tim\createTimRequest;
use Tridi\ManajemenLiga\Model\Tim\updateTimRequest;
use Tridi\ManajemenLiga\Model\Tim\deleteTimRequest;
use Tridi\ManajemenLiga\Repository\TimRepository;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;
use Tridi\ManajemenLiga\Service\TimService;

class TimController
{
  private TimRepository $timRepository;
  private TimService $timService;

  public function __construct()
  {
    $pertandinganRepository = new PertandinganRepository();
    $this->timRepository = new TimRepository();
    $this->timService = new TimService($this->timRepository, $pertandinganRepository);
  }

  public function daftarTim()
  {
    $tim = $this->timRepository->getAll();
    View::render('daftarTim', ['daftarTim' => $tim]);
  }

  public function editTim($id)
  {
    $tim = $this->timRepository->findById($id);
    View::render('editTim', ['tim' => $tim]);
  }

  public function postEditTim($id)
  {
    $updateRequest = new updateTimRequest(
      $id,
      $_POST['namaTim'],
      $_POST['deskripsi'],
      $_POST['asal'],
      $_POST['logo'],
      $_POST['stadium'],
      $_POST['pelatih'],
      $_POST['pemilik']
    );
    $tim = $this->timService->updateTim($updateRequest);
    // $this->daftarTim();
    header('Location: /tim');
  }

  // TODO : cek ini fungsi
  public function deleteTim($id)
  {
    $deleteRequest = new deleteTimRequest($id);
    $this->timService->deleteTim($deleteRequest);
    // $this->daftarTim();
    header('Location: /tim');
  }

  public function tambahTim()
  {
    View::render('inputDataTim', []);
  }

  public function postTambahTim()
  {
    $createRequest = new createTimRequest(
      $_POST['namaTim'],
      $_POST['deskripsi'],
      $_POST['asal'],
      $_POST['logo'],
      $_POST['stadium'],
      $_POST['pelatih'],
      $_POST['pemilik']
    );
    $tim = $this->timService->registerTim($createRequest);
    // $this->daftarTim();
    header('Location: /tim');
  }
}
