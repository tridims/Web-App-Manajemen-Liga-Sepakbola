<?php

namespace Tridi\ManajemenLiga\Controller;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

class LigaControllerTest extends TestCase
{
    private LigaController $ligaController;

    protected function setUp(): void
    {
        $this->ligaController = new LigaController();
    }

    /** @test */
    public function  klasemenTest()
    {
        $this->ligaController->klasemen();

        $this->expectOutputRegex("[Rangking Klasemen]");
        $this->expectOutputRegex("[Rank]");
        $this->expectOutputRegex("[Tim]");
        $this->expectOutputRegex("[Skor]");
    }
}