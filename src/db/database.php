<?php

class Database
{
  /**
   * declare and initialize fields with the value of 
   * global variables written in config.php file
   */
  public $host    = DB_HOST;
  public $user    = DB_USER;
  public $pass    = DB_PASS;
  public $dbname  = DB_NAME;

  public $connection;
  public $error;

  //constructor
  public function __construct()
  {
    /** 
     * call connectDB method so that it is called each of this 
     *  object creation and creates connection with database
     */
    $this->connectDB();
  }

  /** 
   * this method is responsible to create connection with database
   * */
  private function connectDB()
  {
    /**
     * create a new instance/obj of mysqli class to access MYSQL database
     * and store it into connection property of $this class 
     */
    $this->connection = new mysqli(
      $this->host,
      $this->user,
      $this->pass,
      $this->dbname
    );

    /* 
     * if connection fails then show error msg and return false
     * if not then show success msg
     */
    if (!$this->connection) {
      $this->error = "Connection Fail...!!" . $this->connection->connect_error;
      return false;
    }
    // else
    //   echo "<h1 style='color:green'> DB connection successful..!! </h1>";
  }

  public function select($sqlQuery)
  {
    /** 
     * execute passed in select query using mysql query() method
     */
    $result = $this->connection->query($sqlQuery) or
      die($this->connection->error . __LINE__);
    /**
     * if query execution succeeded then return results/data as associative array
     * or if no data found then return false 
     */
    if ($result->num_rows > 0) {
      //echo $result['username'];
      return $result;
    } else
      return false;
    //return [];
    //return array();
  }

  public function create($sqlQuery)
  {
    /** 
     * execute passed in insert query using mysql query() method  
     */
    $insertedData = $this->connection->query($sqlQuery) or
      die($this->connection->error . __LINE__);
    /**
     * show success or error msg 
     */
    if ($insertedData) {
      return $insertedData;
      //echo "<h3 style='color:green'> Data Stored successful</h3>";
    } else
      die("Error...(" . $this->connection->errno . ")" . $this->connection->error);
  }

  public function update($sqlQuery)
  {
    /** 
     * execute passed in update query using mysql query() method  
     */
    $updatedData = $this->connection->query($sqlQuery) or
      die($this->connection->error . __LINE__);
    /**
     * show success or error msg 
     */
    if ($updatedData) {
      return $updatedData;
      //echo "<h3 style='color:green'> Data updated successful</h3>";
    } else
      die("<p style='color:red'>Error...(" . $this->connection->errno . ")</p>" . $this->connection->error);
  }


  public function delete($sqlQuery)
  {
    /** 
     * execute passed in update query using mysql query() method  
     */
    $deletedData = $this->connection->query($sqlQuery) or
      die($this->connection->error . __LINE__);
    /**
     * show success or error msg 
     */
    if ($deletedData)
      echo "<h3 style='color:green'> Data deleted successful</h3>";
    else
      die("<p style='color:red'>Error...(" . $this->connection->errno . ")</p>" . $this->connection->error);
  }
}
