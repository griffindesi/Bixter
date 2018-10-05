<?php


/**
 *
 */
 class DataBase {

  private static $_instance= null /* this will be the connection handler */;
  private $_pdo /* this will be the connection object handler */
  , $_query /* this will be the query handler */
  , $_error = false /* this will be the errors handler */
  , $_resault=0 /* this will be the the resault handler */
  , $_lastInsertID=null /* this will be the last insert id handler */;

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
    // this function will valditon on the database connection
    if (!isset(self::$_instance)) {
      self::$_instance = new DataBase();
          }
          return self::$_instance;
  }

  public function query($sql,$params=[])
  {
    // this function will make query and handler $sql query $params have params
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
  public function insert ($table , $fields = [])
  {

    $fieldString = '';
    $valueString = '';
    $values = [];


    foreach ($fields as $field => $value) {
      $fieldString .= '`' . $field . '`,';
      $valueString .= '?,';
      $values [] = $value;
    }

    $fieldString = rtrim($fieldString,',');
    $valueString = rtrim($valueString,',');
    $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

    if (!$this->query($sql , $values)->error()) {
      return true;
    }
     return false;

  }
  public function error() {
    return $this->_error;
  }
  public function SelectAll($table)
  {
    // this function will make query and handler $sql query $params have params
    $this->error=false;
    $sql="SELECT * FROM {$table}";
    if ($this->_query = $this->_pdo->prepare($sql)) {

    }
    if ($this->_query->execute()) {
    $this->_resault = $this->_query->fetchAll(PDO::FETCH_ASSOC);
    return $this->_resault;
     //$this->_count = $this->_query->rowCount();

   }else {
     $this->$_error=true;

   }
     return $this;

  }
  
  public function Update ( $table , $id , $fields = [])  {

        $fieldString = '';

        $valueString = '';

        $values = [];


        foreach ($fields as $field => $value) {
          $fieldString .= '`' . $field . '`,';

          $valueString .= '?,';

          $values [] = $value;

        }

        $fieldString = trim($fieldString,',');

        $valueString = rtrim($valueString,',');

        $sql = "UPDATE {$table} SET {$fieldString}={$valueString} WHERE id={$id}";

        // dnd($sql);

        if (!$this->query($sql , $values)->error()) {
          return true;
        }
         return False;


  }

  public function Delete () {


  }


}
