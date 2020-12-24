<?php

class DatabaseQuery {
  protected $dbc;
  protected $tableName;

  function __construct($dbc, $tableName){
    $this->dbc = $dbc;
    $this->tableName = $tableName;
  }

  function addValue($pageTitle){
    $sql = "INSERT INTO " . $this->tableName . " (title, content) VALUES ('" . $pageTitle . "', '')";
    $stmt = $this->dbc->prepare($sql);
    $stmt->execute();

    return true;
  }

  function removeValue($pageId){
    $sql = "DELETE FROM " . $this->tableName . " WHERE id='" . $pageId . "'";
    $stmt = $this->dbc->prepare($sql);
    $stmt->execute();

    return true;
  }

  function replaceValue($pageData){
    $sql = "UPDATE " . $this->tableName . " SET content = " . $pageData . " WHERE id = 9";
    $stmt = $this->dbc->prepare($sql);
    $stmt->execute();
  }
}


?>
