<?php

namespace Tridi\ManajemenLiga\Controller;

use Tridi\ManajemenLiga\App\View;
use Tridi\ManajemenLiga\Service\LigaService;
use Tridi\ManajemenLiga\Repository\TimRepository;
use Tridi\ManajemenLiga\Repository\PertandinganRepository;

class LigaController
{
  private LigaService $ligaService;

  public function __construct()
  {
    $timRepo = new TimRepository();
    $pertandinganRepo = new PertandinganRepository();
    $this->ligaService = new LigaService($timRepo, $pertandinganRepo);
  }

  function klasemen()
  {
    $klasemen = $this->ligaService->getPeringkatKlasemen();

    $juara = $this->ligaService->getJuaraLiga();

    View::render('daftarKlasemen', ['klasemen' => $klasemen, 'juara' => $juara]);
  }
}
