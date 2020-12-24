<?php

  class Pages extends Entity {

      public function __construct($dbc){
        parent::__construct($dbc, 'pages');
      }

      protected function initFields() {
          $this->fields = [

          ];
      }


    // protected $dbc;
    // protected $tableName;
    // public $databaseData = array();
    //
    // public function __construct($dbc){
    //   $this->dbc = $dbc;
    //   $this->tableName = 'pages';
    // }
    //
    // public function findAll(){
    //   $sql = "SELECT * FROM " . $this->tableName;
    //   $stmt = $this->dbc->prepare($sql);
    //   $stmt->execute();
    //   $results = $stmt->fetchAll();
    //
    //   var_dump($results);
    //
    //   if($results){
    //     foreach($results as $result){
    //       array_push($this->databaseData, $result);
    //       //var_dump($result);
    //     }
    //   }
    // }
  }

?>
