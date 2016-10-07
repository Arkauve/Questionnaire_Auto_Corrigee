<?php
class Theme {
  var $_nom;
  var $_id;
  var $_questions;

  function Theme($leNom){
    $_nom = $leNom;
    global $bdd;
    $bdd->query("INSERT INTO theme(nom) VALUES ('$leNom')");
    print_r($bdd->error);
    print_r($bdd->info);
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
