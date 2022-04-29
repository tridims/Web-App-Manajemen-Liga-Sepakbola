<?php

namespace Tridi\ManajemenLiga\Controller;

use Tridi\ManajemenLiga\App\View;

class HomeController
{
  function index()
  {
    View::render('Home', []);
  }

  function testing()
  {
    View::render('Testing', ['nama' => 'Tridi']);
  }
}
