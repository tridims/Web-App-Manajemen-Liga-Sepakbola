<?php

namespace Tridi\ManajemenLiga\Service;

class Database
{
  private static $pdo = null;

  public static function getConnection()
  {
    if (self::$pdo == null) {
      require_once __DIR__ . '/../../config/database.php';
      $config = getDatabaseConfig();
      self::$pdo = new \PDO($config['url'], $config['username'], $config['password']);
    }
    return self::$pdo;
  }

  public static function query(string $sql, array $params = [])
  {
    $stmt = self::getConnection()->prepare($sql);
    $stmt->execute($params);
    return $stmt;
  }

  public static function exec(string $sql, array $params = [])
  {
    $stmt = self::getConnection()->prepare($sql);
    $stmt->execute($params);
    return $stmt;
  }

  public static function beginTransaction()
  {
    self::getConnection()->beginTransaction();
  }

  public static function commitTransaction()
  {
    self::getConnection()->commit();
  }

  public static function rollbackTransaction()
  {
    self::getConnection()->rollback();
  }
}
