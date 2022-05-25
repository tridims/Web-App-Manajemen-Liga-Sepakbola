<?php

namespace Tridi\ManajemenLiga\Controller;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

class HomeControllerTest extends TestCase
{
    private HomeController $homeController;

    protected function setUp(): void
    {
        $this->homeController = new HomeController();
    }

    /** @test */
    public function  indexTest()
    {
        $this->homeController->index();

        $this->expectOutputRegex("[Daftar Tim]");
        $this->expectOutputRegex("[Daftar Pertandingan]");
        $this->expectOutputRegex("[Ranking Klasemen Terbaru]");
    }

}