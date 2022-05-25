<?php

namespace Tridi\ManajemenLiga\Service;

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{

  public function testGetConnection()
  {
    $connection = Database::getConnection();
    self::assertNotNull($connection);
  }

  public function testGetconnectionSingleton()
  {
    $connection1 = Database::getConnection();
    $connection2 = Database::getConnection();
    self::assertSame($connection1, $connection2);
  }
}
