<?php
//include "../class/question.php";

class Theme {
  var $_nom;
  var $_id;
  var $_questions;

  function __construct($leNom){
    $this->_nom = $leNom;
    $this->_id=null;
    $this->_questions=null;
  }

  // méthode de sauveagarde enrgistrant le thème courant dans la base de donnés
  // Testé
  function save(){
    global $bdd;
    try {
      $bdd->query("INSERT INTO theme(t_nom) VALUES ('$this->_nom')");
    } catch (Exception $e) {
      die('Erreur : '.$e->getMessage());
    }
    $this->_id = $bdd->lastInsertId();
  }

  function delete(){
    global $bdd;
    try {
      $bdd->exec("DELETE FROM theme WHERE t_id = '$this->_id'");
    } catch (Exception $e) {
      die('Erreur : '.$e->getMessage());
    }
  }

  function setId($id){
    $this->_id=$id;
  }

  function getId(){
    return $this->_id;
  }

  function getNom(){
    return $this->_nom;
  }


  function addQuestion($uneQuestion){
    $this->_questions[]=$uneQuestion;
  }

  function getQuestions(){
    global $bdd;
    if($this->_questions!=null)return $this->_questions;
    if($resultSQL = $bdd->query("SELECT * FROM `question` WHERE q_t_id = '$this->_id'")){
      while($result = $resultSQL->fetch()){
        $this->_questions[]=Question::getSQLObject($result);
      }
      $resultSQL->closeCursor();
      return $this->_questions;
    }
    return null;
  }

  // Converti un objet SQL en Theme
  // Testé
  static function getSQLObject($SQLObject){
    $theme = new Theme($SQLObject["t_nom"]);
    $theme->setId($SQLObject["t_id"]);
    return $theme;
  }

  // Méthode renvoyant une liste de tous les thèmes
  // Testé
  static function getAllThemes(){
    global $bdd;
    if ($result = $bdd->query("SELECT * FROM `theme`")){
         // Cycle through results
         $group_arr=null;
        while ($row = $result->fetch()){
            $group_arr[] = Theme::getSQLObject($row);
        }
         // Free result set
         $result->closeCursor();
         return $group_arr;
    }
  }

  static function getTheme($id){
    global $bdd;
    if ($resultSQL = $bdd->query("SELECT * FROM `theme` WHERE t_id=$id")){
      $result = Theme::getSQLObject($resultSQL->fetch());
      $resultSQL->closeCursor();
      return $result;
    }
  }

  // Méthode supprimant le thème d'id passé en parametre
  // Testé
  static function deleteTheme($id){
    global $bdd;
    try {
      $bdd->exec("DELETE FROM theme WHERE t_id = '$id'");
    } catch (Exception $e) {
      die('Erreur : '.$e->getMessage());
    }
  }


}



?>
