<?php

namespace Phpcurd;

use PDO;

class Connection {

  private $config;

  public function __construct ()
  {
      $this->config = require_once(__DIR__.'/../../config/database.php');
  }

  public function connect()
  {
      $credentials = $this->config;

      try {
        $servername = $credentials['DB_HOST'] ?? 'localhost';
        $username = $credentials['DB_USER'] ?? 'forge';
        $password = $credentials['DB_PASSWORD'] ?? 'forge';
        $database = $credentials['DB_DATABASE'] ?? 'forge';

        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;

      } catch (PDOException $e) {
          $this->throwError($e->getMessage());
      }
  }

  public function throwError($message)
  {
      throw new \Exception($message, 1);
  }


}
