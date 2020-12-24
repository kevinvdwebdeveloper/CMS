<?php

abstract class Entity {

  protected $dbc;
  protected $tableName;
  public $fields;

  //Force extending class to define this method
  abstract protected function initFields();

  protected function __construct($dbc, $tableName){
    $this->dbc = $dbc;
    $this->tableName = $tableName;
    $this->initFields();
  }

  //find value by name
  public function findBy($fieldName, $fieldValue){
    $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $fieldName . " = :value";
    $stmt = $this->dbc->prepare($sql);
    $stmt->execute(['value' => $fieldValue]);
    $databaseData = $stmt->fetch();

    if($databaseData){
      $this->setValues($databaseData);
    }
  }

  public function findAll(){
    $sql = "SELECT * FROM " . $this->tableName;
    $stmt = $this->dbc->prepare($sql);
    $stmt->execute();
    $databaseData = $stmt->fetchAll();

    if($databaseData){
      $this->setAllValues($databaseData);
    }
  }

  public function setValues($values){
    foreach ($this->fields as $fieldName) {
       $this->$fieldName = $values[$fieldName];
    }
  }

  public function setAllValues($values){
    foreach($values as $key) {
      array_push($this->fields, $key);
    }
  }
}

?>
