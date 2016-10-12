<?php

class Score{
  var $_id;
  var $_reponseId;
  var $_valeur;
  var $_consult;
  var $_questionId;

  function __construct($uneReponseId,$uneValeur,$laConsult,$unIdQuestion){
    $this->_reponseId = $uneReponseId;
    $this->_valeur = $uneValeur;
    $this->_consult = $laConsult;
    $this->_questionId = $unIdQuestion;
  }

  function save($e_id){
    global $bdd;
    try{
      $bdd->query("INSERT INTO score(s_reponse, s_consult, s_valeur, s_q_id, s_e_id) VALUES ('$this->_reponseId','$this->_consult','$this->_valeur','$this->_questionId','$e_id');");
    }catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    $this->_id = $bdd->lastInsertId();
  }

  function update(){
    try{
      $bdd->query("UPDATE score s_reponse='$this->_reponse', s_consult='$this->_consult', s_valeur='$this->_valeur',q_c_id='$this->_indice' WHERE s_id='$this->_id';");
    }catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }

  function setId($id){
    $this->_id=$id;
  }

  function getId(){
     return $this->_id;
  }

  function getValeur(){
    return $this->_valeur;
  }

  function getReponse(){
    return $this->_reponse;
  }

  function getConsult(){
    return $this->_consult;
  }

  function getQuestionId(){
    return $this->_questionId;
  }

  // Converti un objet SQL en Score
  // Testé
  static function getSQLObject($SQLObject){
    $score = new Score($SQLObject["s_reponse"],$SQLObject["s_valeur"],$SQLObject["s_consult"],$SQLObject["s_q_id"],$SQLObject["s_e_id"]);
    $score->setId($SQLObject["s_id"]);
    return $score;
  }

  // Méthode renvoyant une liste de tous les thèmes
  // Testé
  static function getAllScore(){
    global $bdd;
    if ($result = $bdd->query("SELECT * FROM `score`")){
         // Cycle through results
         $group_arr=null;
        while ($row = $result->fetch()){
            $group_arr[] = score::getSQLObject($row);
        }
         // Free result set
         $result->closeCursor();
         return $group_arr;
    }
  }

  static function getScore($id){
    global $bdd;
    if ($resultSQL = $bdd->query("SELECT * FROM `score` WHERE s_id='$id'")){
      $result = score::getSQLObject($resultSQL->fetch());
      $resultSQL->closeCursor();
      return $result;
    }
  }

  static function getScoreByQuestion($q_id,$e_id){
    global $bdd;
    if ($resultSQL = $bdd->query("SELECT * FROM `score` WHERE s_q_id='$q_id' AND s_e_id='$e_id'")){
      $result = score::getSQLObject($resultSQL->fetch());
      $resultSQL->closeCursor();
      return $result;
    }
  }

  static function scoreExiste($q_id,$e_id){
    global $bdd;
    $result = $bdd->query("SELECT * FROM `score` WHERE s_q_id='$q_id' AND s_e_id='$e_id'");
    return $result->fetch() != null;
  }

  static function calculeScore($idReponse,$idChoix,$leNbPts){
    if($idReponse==$idChoix){
      return $leNbPts;
    }
    return 0;
  }


}

?>
