<?php

class Choix{
  var $_id;
  var $_phrase;

  function __construct($unePhrase){
    $this->_phrase = $unePhrase;
  }

  function save($q_id){
    global $bdd;
    try{
      $bdd->query("INSERT INTO choix(c_phrase,c_q_id) VALUES ('$this->_phrase','$q_id')");
    }catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    $this->_id = $bdd->lastInsertId();
  }

  function setId($id){
    $this->_id=$id;
  }

  function getId(){
     return $this->_id;
  }

  function getPhrase(){
    return $this->_phrase;
  }


  function addChoix($unChoix){
    $this->_choixs[]=$unChoix;
  }

  // Converti un objet SQL en Choix
  // Testé
  static function getSQLObject($SQLObject){
    $choix = new Choix($SQLObject["c_phrase"]);
    $choix->setId($SQLObject["c_id"]);
    return $choix;
  }

  // Méthode renvoyant une liste de tous les thèmes
  // Testé
  static function getAllChoix(){
    global $bdd;
    if ($result = $bdd->query("SELECT * FROM `choix`")){
         // Cycle through results
         $group_arr=null;
        while ($row = $result->fetch()){
            $group_arr[] = Choix::getSQLObject($row);
        }
         // Free result set
         $result->closeCursor();
         return $group_arr;
    }
  }

  static function getChoix($id){
    global $bdd;
    if ($resultSQL = $bdd->query("SELECT * FROM `Choix` WHERE e_id=$id")){
      $result = Choix::getSQLObject($resultSQL->fetch());
      $resultSQL->closeCursor();
      return $result;
    }
  }

  static function getChoixById($id){
    global $bdd;
    if ($resultSQL = $bdd->query("SELECT * FROM `choix` WHERE c_id=$id")){
      $result = Choix::getSQLObject($resultSQL->fetch());
      $resultSQL->closeCursor();
      return $result;
    }
  }


}

?>
