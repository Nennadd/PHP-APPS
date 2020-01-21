<?php

class DB {
  // Hold the class instance.
  private static $instance = null;
  private $conn;
  
  private $host = 'localhost';
  private $user = 'root';
  private $pass = '';
  private $name = 'voting';
  private $options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ];
   

  private function __construct()
  {
    try{
      $this->conn = new PDO("mysql:host={$this->host};
      dbname={$this->name}", $this->user, $this->pass, $this->options);
    }
    catch (PDOException $e) {
			die('Connection failed'. $e->getMessage());
		}
    
  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new DB();
    }
   
    return self::$instance;
  }
  
  public function connect()
  {
    return $this->conn;
  }
}