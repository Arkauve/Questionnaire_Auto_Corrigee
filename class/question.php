<?php

class Question {
  var $_id;
  var $_phrase;
  var $_id_choix;
  var $_choix;
  var $_indice;
  var $_nb_choix;


  function __construct($unePhrase, $unIndice, $unNbChoix){
    $this->_phrase = $unePhrase;
    $this->_indice = $unIndice;
    $this->_nb_choix = $unNbChoix;
  }

  function save($id_theme){
    global $bdd;
    try{
      $bdd->query("INSERT INTO question(q_phrase,q_indice,q_nb_choix,q_t_id) VALUES ('$this->_phrase','$this->_indice','$this->_nb_choix','$id_theme')");
    }catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    $this->_id = $bdd->lastInsertId();
  }

  function update(){
    global $bdd;
    try{
      $bdd->query("UPDATE question SET q_phrase='$this->_phrase',q_indice='$this->_indice',q_nb_choix='$this->_nb_choix',q_c_id='$this->_id_choix' WHERE q_id='$this->_id';");
    }catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }

  function setSolution($unIdChoix){
    $this->_id_choix=$unIdChoix;
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

  function setId($id){
    $this->_id=$id;
  }



  function getChoix(){
    global $bdd;
    if($this->_choix!=null)return $this->_choix;
    if($resultSQL = $bdd->query("SELECT * FROM `choix` WHERE c_q_id = '$this->_id'")){
      while($result = $resultSQL->fetch()){
        $this->_choix[]=Choix::getSQLObject($result);
      }
      $resultSQL->closeCursor();
      return $this->_choix;
    }
    return null;
  }

  function getChoixRandom(){
    global $bdd;
    if($this->_choix!=null)return $this->_choix;
    if($resultSQL = $bdd->query("SELECT * FROM `choix` WHERE c_q_id = '$this->_id' ORDER BY RAND() LIMIT $this->_nb_choix;")){
      while($result = $resultSQL->fetch()){
        $this->_choix[]=Choix::getSQLObject($result);
      }
      $resultSQL->closeCursor();
      return $this->_choix;
    }
    return null;
  }

  // Converti un objet SQL en Question
  // Testé
  static function getSQLObject($SQLObject){
    $question = new Question($SQLObject["q_phrase"],$SQLObject["q_indice"],$SQLObject["q_nb_choix"],$SQLObject["q_t_id"]);
    $question->setId($SQLObject["q_id"]);
    $question->setSolution($SQLObject["q_c_id"]);
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
      return Question::getSQLObject($result);
    }
  }

  function addChoix($unChoix){

  }

}

?>
