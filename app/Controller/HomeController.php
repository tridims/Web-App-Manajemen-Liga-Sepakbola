<?php

namespace Tridi\ManajemenLiga\Controller;

use Tridi\ManajemenLiga\App\View;

class HomeController
{
  function index()
  {
    View::render('Home', []);
  }

  function testing($nama)
  {
    View::render('Testing', ['nama' => $nama]);
  }
}
