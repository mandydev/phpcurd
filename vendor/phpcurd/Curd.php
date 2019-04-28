<?php

namespace Phpcurd;

use Phpcurd\Connection;
use PDO;

class CURD {

  protected $connection;

  protected $where;
  protected $whereIn;
  protected $like;
  protected $orWhere;

  public function __construct()
  {
      $this->connection  = (new Connection)->connect();
  }

  public function get(string $tablename, array $select = ['*']) : array
  {
      $query = "select ".implode(', ', $select)."from ".$tablename.$this->prepareQuery();

      try {
        $query = $this->connection->prepare($query);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query->fetchAll();
      } catch (PDOException $e) {
        throw new \Exception($e->getMessage, 1);
      }

  }

  private function prepareQuery()
  {
      return $this->where.$this->orWhere.$this->whereIn.$this->like;
  }


}
