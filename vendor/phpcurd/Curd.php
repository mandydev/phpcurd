<?php

namespace Phpcurd;

use Phpcurd\Connection;
use PDO;

class CURD {

  protected $connection;

  protected $where;
  protected $select;

  public function __construct()
  {
      $this->connection  = (new Connection)->connect();
  }

  public function get(string $table, array $select = ['*']) : array
  {
      $query = "select ".implode(', ', $select)." from ".$table.$this->prepareQuery();

      try {
          return $this->execute($query)->fetchAll();
      } catch (PDOException $e) {
          throw new \Exception($e->getMessage, 1);
      }

  }

  public function select(string $table, string $select = '*') : object
  {
      $this->select = "select ".$select." from ".$table;
      return $this;
  }

  public function first()
  {
      $query = $this->select.$this->prepareQuery();
      try {
          return $this->execute($query)->fetch();
      } catch (PDOException $e) {
          throw new \Exception($e->getMessage, 1);
      }
  }


  public function where($column, string $valueOrOperator = null, string $value = null)
  {
      $operator = $value ? $valueOrOperator : '=';
      $value = $value ? $value : $valueOrOperator;

      if (is_array($column)) {
          foreach ($column as $key => $val) {
              $this->where .= " where ".$key." = '".$val."'";
          }

      } else {
          $this->where .= " where ".$column." ".$operator." '".$value."'";
      }

      return $this;
  }

  public function whereIn($column, array $values)
  {
      $this->where .= " where ".$column." in ('".implode("', '", $values)."')";

      return $this;
  }

  private function execute($query)
  {
      $query = $this->connection->prepare($query);
      $query->execute();
      $query->setFetchMode(PDO::FETCH_ASSOC);
      return $query;
  }

  private function prepareQuery()
  {
      return $this->where;
  }


}
