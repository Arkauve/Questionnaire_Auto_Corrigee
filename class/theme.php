<?php
class Theme {
  var $_nom;
  var $_id;
  var $_questions;

  function Theme($leNom){
    $_nom = $leNom;
    global $bdd;
  }

  function save(){
    try {
      $bdd->query("INSERT INTO theme(t_theme) VALUES ('$leNom')");
    } catch (Exception $e) {
      die('Erreur : '.$e->getMessage());
    }
  }

  static function getAllThemes(){
    if ($result = $bdd->query("SELECT * FROM `theme`")){
         // Cycle through results
        while ($row = $result->fetch_object()){
            $group_arr[] = $row;
        }
         // Free result set
         $result->close();
    }
  }

  function addQuestion(){

  }

}



?>
