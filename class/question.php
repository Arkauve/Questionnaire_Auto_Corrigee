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

  function save(){
    try{
      $bdd->query("INSERT INTO theme(q_phrase,q_solution,q_indice,q_nb_choix) VALUES ($this->_id = $unId,this->_phrase,$this->_solution,$this->_indice,$this->_nb_choix)");
    }catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }

  function addChoix($unChoix){
    
  }

}

?>
