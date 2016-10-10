<?php

class Question {
  var $_id;
  var $_phrase;
  var $_solution;
  var $_choix;
  var $_indice;
  var $_nb_choix;


  function __construct($unePhrase, $uneSolution, $unIndice, $unNbChoix){
    $this->_phrase = $unePhrase;
    $this->_solution = $uneSolution;
    $this->_indice = $unIndice;
    $this->_nb_choix = $unNbChoix;
  }

  function save($id_theme){
    global $bdd;
    try{
      $bdd->query("INSERT INTO question(q_phrase,q_solution,q_indice,q_nb_choix,q_t_id) VALUES ('$this->_phrase','$this->_solution','$this->_indice','$this->_nb_choix','$id_theme')");
    }catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    $this->_id = $bdd->lastInsertId();
  }

  function getId(){
    return $this->_id;
  }

  function getPhrase(){
    return $this->_phrase;
  }

  function getSolution(){
    return $this->_solution;
  }

  function getIndice(){
    return $this->_indice;
  }

  function getNbChoix(){
    return $this->_nb_choix;
  }

  function getChoix(){
    return $this->_choix;
  }

  function setId($id){
    $this->_id=$id;
  }


  // Converti un objet SQL en Question
  // Testé
  static function getSQLObject($SQLObject){
    $question = new Question($SQLObject["q_phrase"],$SQLObject["q_solution"],$SQLObject["q_indice"],$SQLObject["q_nb_choix"],$SQLObject["q_t_id"]);
    $question->setId($SQLObject["q_id"]);
    return $question;
  }

  // Méthode renvoyant une liste de tous les thèmes
  // Testé
  static function getAllQuestions(){
    global $bdd;
    if ($result = $bdd->query("SELECT * FROM `question`")){
         // Cycle through results
         $group_arr=null;
        while ($row = $result->fetch()){
            $group_arr[] = Question::getSQLObject($row);
        }
         // Free result set
         $result->closeCursor();
         return $group_arr;
    }
  }

  static function getQuestion($id){
    global $bdd;
    if ($resultSQL = $bdd->query("SELECT * FROM `question` WHERE q_id=$id")){
      $result = $resultSQL->fetch();
      $resultSQL->closeCursor();
      return $result;
    }
  }

  function addChoix($unChoix){

  }

}

?>
