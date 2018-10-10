<?php

/**
* Class and Function List:
* Function list:
* - __construct()
* - getInstance()
* - query()
* - insert()
* - error()
* - SelectAll()
* - Update()
* - Delete()
* - resaults()
* - first()
* - count()
* Classes list:
* - DataBase
*/
/**
 *
 */
class DataBase {

    private static $_instance     = null /* this will be the connection handler */;
    private $_pdo
    /* this will be the connection object handler */
    , $_query /* this will be the query handler */
    , $_error        = false /* this will be the errors handler */
    , $_resault      = 0 /* this will be the the resault handler */
    , $_lastInsertID = null /* this will be the last insert id handler */;

    private function __construct() {
        try {
            $this->_pdo    = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME . '', DBUSER, DBPASSWORD);
        }
        catch(PDOException $e) {
            die($e->getMessage());

        }

    }

    public static function getInstance() {
        // this function will valditon on the database connection
        if (!isset(self::$_instance)) {
            self::$_instance = new DataBase();
        }
        return self::$_instance;
    }

    public function query($sql, $params       = []) {
        // this function will make query and handler $sql query $params have params
        $this->error  = false;
        if ($this->_query = $this
            ->_pdo
            ->prepare($sql)) {
            $x            = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this
                        ->_query
                        ->bindValue($x, $param);
                    $x++;
                }
            }
        }
        if ($this
            ->_query
            ->execute()) {
            $this->_resault      = $this
                ->_query
                ->fetchALL(PDO::FETCH_OBJ);
            $this->_count        = $this
                ->_query
                ->rowCount();
            $this->_lastInsertID = $this
                ->_pdo
                ->lastInsertId();
        }
        else {
            $this->_error       = true;

        }
        return $this;
    }
    public function insert($table, $fields      = []) {

        $fieldString = '';
        $valueString = '';
        $values      = [];

        foreach ($fields as $field => $value) {
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[]             = $value;
        }

        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');
        $sql         = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;

    }
    public function error() {
        return $this->_error;
    }
    public function SelectAll($table) {
        // this function will make query and handler $sql query $params have params
        $this->error         = false;
        $sql                 = "SELECT * FROM {$table}";
        if ($this->_query        = $this
            ->_pdo
            ->prepare($sql)) {

        }
        if ($this
            ->_query
            ->execute()) {
            $this->_resault      = $this
                ->_query
                ->fetchAll(PDO::FETCH_OBJ);
            //return $this->_resault;
            //$this->_count = $this->_query->rowCount();
            $this->_count        = $this
                ->_query
                ->rowCount();
            $this->_lastInsertID = $this
                ->_pdo
                ->lastInsertId();
        }
        else {
            $this->_error        = true;

        }
        return $this;

    }

    public function Update($table, $id, $fields      = []) {

        $fieldString = '';

        $valueString = '';

        $values      = [];

        foreach ($fields as $field => $value) {
            $fieldString .= '`' . $field . '`,';

            $valueString .= '?,';

            $values[]             = $value;

        }

        $fieldString = trim($fieldString, ',');

        $valueString = rtrim($valueString, ',');

        $sql         = "UPDATE {$table} SET {$fieldString}={$valueString} WHERE id={$id}";

        // dnd($sql);
        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return False;

    }

    public function Delete($table, $id) {

        // this fucnction will have 2 paramater id & table
        $sql = "Delete From  {$table} WHERE id={$id}";

        // dnd($sql);
        if (!$this->query($sql)->error()) {
            return true;
        }
        return False;

    }
    public function resaults() {
        return $this->_resault;

    }

    public function first() {
        return $this->_resault[0];

    }
    protected function _read($table,$params=[])
    {
      $conditionString='';
      $bind=[];
      $order='';
      $limit='';
      //$conditionString
      if (isset($params['$conditions'])) {
        if (is_array($params['$conditions'])) {
          foreach ($params['$conditions'] as $condition) {
            $conditionString .=' ' . $condition . ' AND';
          }
          $conditionString = trim($conditionString);
          $conditionString = rtrim($conditionString, ' AND');

        }else{
          $conditionString = $params['conditions'];
        }
        if ($conditionString != '') {
          $conditionString = ' WHERE ' . $conditionString;
        }
      }
      //binde
      if (array_key_exists('bind',$params)) {
        $bind = $params['bind'];
      }
      //order
      if (array_key_exists('order',$params)) {
        $order = ' ORDER BY '. $params['order'];
      }
      //limits
      if (array_key_exists('limit',$params)) {
      $limit = ' LIMIT '. $params['limit'];
      }
      $sql="SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
      if ($this->query($sql,$bind)) {
        if (!count($this->_resault)) return false;
        return true;
      }
    }
    public function find($table,$params=[])
    {
      if ($this->_read($table,$params)) {
        return $this->resaults();
      }
      return false;
    }
    public function findFirst($table,$params=[])
    {
      if ($this->_read($table,$params)) {
        return $this->first();
      }
      return false;
    }
    public function count() {
        (!empty($this->_count)) ? $this->_count : [];

        //return $this->_count;

    }
    public function lastInsertId()
    {
      return $this->_lastInsertID;
    }
    public function get_colunms($table)
    {
      return $this->query("SHOW COLUMNS FROM {$table}")->resaults();
    }


}
