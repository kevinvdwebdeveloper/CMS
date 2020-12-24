<?php

final class DatabaseConnection {
  //set variable
  private static $instance = null;
  private static $connection;

  //get getInstance
  public static function getInstance(){
    //check if instance is already created. When it is created return it, if not created make a database connection
    if(is_null(self::$instance)){
      self::$instance = new DatabaseConnection();
    }

    return self::$instance;
  }

  private function __construct(){}

  private function __clone(){}

  private function __wakeup(){}

  //connect to database
  public static function connect($host, $dbName, $user, $password){
    self::$connection = new PDO("mysql:dbname=$dbName;host=$host", $user, $password);
  }

  public static function getConnection(){
    return self::$connection;
  }

}

?>
