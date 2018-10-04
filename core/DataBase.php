<?php


/**
 *
 */
class DataBase {

  private static $_instance= null;
  private $_pdo , $_query , $_error = false , $_resault=0 , $_lastInsertID=null;

  private function __construct()
  {
    try {
      $this->_pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.'',DBUSER,DBPASSWORD);
    } catch (PDOException $e) {
      die($e->getMessage());
    }

  }

  public static function getInstance()
  {
    if (!isset(self::$_instance)) {
      self::$_instance = new DataBase();
          }
          return self::$_instance;
  }

  public function query($sql,$params=[])
  {
    $this->error=false;
    if ($this->_query = $this->_pdo->prepare($sql)) {
      $x=1;
      if (count($params)) {
        foreach ($params as $param) {
          $this->_query->bindValue($x,$param);
          $x++;
        }
      }
    }
    if ($this->_query->execute()) {
     $this->_resault = $this->_query->fetchALL(PDO::FETCH_OBJ);
     $this->_count = $this->_query->rowCount();
     $this->_lastInsertID = $this->_pdo->lastInsertId();
   }else {
     $this->$_error=true;

   }
     return $this;
  }

}
