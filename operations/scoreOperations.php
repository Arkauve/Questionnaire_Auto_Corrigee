<?php
// Ce fichier contient des fonctions php permettant d'executer les fonctions de la classe Score
include "../include.php";
session_start();
if(!empty($_GET)){
  choixFonction();
}

function choixFonction(){
  switch ($_GET["function"]){
    case "saveScore" :
      saveScore($_GET["id"],$_GET["reponseId"],$_GET["consult"],$_GET["valeur"]);
      break;
    case "createScore" :
      createScore($_GET["id"],$_GET["reponseId"],$_GET["consult"],$_GET["valeur"],$_SESSION["e_id"]);
      break;
    case "calculeScore" :
      calculeScore($_GET["id"],$_GET["reponseId"],$_GET["consult"],$_GET["valeur"]);
      break;
  }
}

function saveScore($q_id,$reponseId,$consult,$valeur){
  if(!Score::scoreExiste($q_id,$_SESSION["e_id"])){
    createScore($q_id,$reponseId,$valeur,$consult,$_SESSION["e_id"]);
  }else {
    $score = Score::getScoreByQuestion($q_id,$_SESSION["e_id"]);
    $score->_reponseId=$reponseId;
    $score->__consult=$consult;
    $score->_valeur=$valeur;
    $score->update();
  }
}

function createScore($q_id,$reponseId,$valeur,$consult,$e_id){
  $score = new Score($reponseId,$valeur,$consult,$q_id);
  echo $score->save($e_id);
}

function calculeScore($q_id,$reponseId,$consult,$valeur){
  $question = Question::getQuestion($q_id);
  $score_valeur = Score::calculeScore($reponseId,$question->_id_choix,$valeur);
  saveScore($q_id,$reponseId,$consult,$score_valeur);
  echo $score_valeur;
}


function getListThemes(){
  if(($listTheme = Theme::getAllThemes())!=null){
    foreach ($listTheme as $key => $value) {
      echo "<label class=theme id=".$value->_id.">".$value->_nom."</label><br>";
    }
  }else echo "Il n'existe aucun thème";
}


 ?>
