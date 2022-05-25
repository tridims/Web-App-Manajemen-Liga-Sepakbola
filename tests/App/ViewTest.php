<?php

namespace Tridi\ManajemenLiga\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
  public function testRender()
  {
    View::render('Home', []);

    $this->expectOutputRegex("[Daftar Tim]");
    $this->expectOutputRegex("[Daftar Pertandingan]");
    $this->expectOutputRegex("[Ranking Klasemen Terbaru]");
  }
}
