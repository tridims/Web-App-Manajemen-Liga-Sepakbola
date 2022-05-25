<?php

namespace Tridi\ManajemenLiga\Service;

use Tridi\ManajemenLiga\Service\Database;

class Testing
{
  public function __construct()
  {
    $id = Database::query("select * from pertandingan where id=(SELECT LAST_INSERT_ID());");
    var_dump($id);
  }
}

new Testing();
