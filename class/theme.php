<?php
class Theme {
  var $_nom;
  var $_id;
  var $_questions;

  function __construct($leNom){
    $this->_nom = $leNom;
    $this->_id=null;
  }

  // méthode de sauveagarde enrgistrant le thème courant dans la base de donnés
  function save(){
    global $bdd;
    try {
      $bdd->query("INSERT INTO theme(t_theme) VALUES ('$this->_nom')");
    } catch (Exception $e) {
      die('Erreur : '.$e->getMessage());
    }
    $this->_id = $bdd->insert_id;
  }

  // Méthode renvoyant une liste de tous les thèmes
  // Testé
  static function getAllThemes(){
    global $bdd;
    if ($result = $bdd->query("SELECT * FROM `theme`")){
         // Cycle through results
        while ($row = $result->fetch_object()){
            $group_arr[] = $row;
        }
         // Free result set
         $result->close();
         return $group_arr;
    }
  }

  function addQuestion($uneQuestion){

  }

}



?>
