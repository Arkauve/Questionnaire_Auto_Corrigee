<?php
// Ce fichier contient des fonctions php permettant d'executer les fonctions de la classe Question

include "../connexion_bdd.php";
include "../class/theme.php";
include "../class/question.php";

if(!empty($_GET)){
  choixFonction();
}

function choixFonction(){
  switch ($_GET["function"]){
    case "createQuestion" :
      createQuestion();
      break;
    case "deleteQuestion" :
      Theme::deleteQuestion($_GET["id"]);
      break;
    case "getListChoix" :
      getListChoix();
      break;
    case "getListQuestions" :
      getListQuestions();
      break;
    case "getIndice" :
      getIndice($_GET["id"]);
      break;
  }
}

function createTheme($id){
    $theme = new Theme($_POST["phrase"]);
    $theme->save();
}


function getListQuestion(){
  if(($listTheme = Question::getAllQuestions())!=null){
    foreach ($listTheme as $key => $value) {
      echo "<label class=theme id=".$value->_id." onload=afficheListeQuestions(".$value->_id.")>".$value->_nom."</label><button onclick=deleteTheme(".$value->_id.")>suprimer</button><br>";
    }
  }else echo "Il n'existe aucun thème";
}

function getListChoix(){
  $theme = Question::getQuestion($_GET["id"]);
  if($question=$theme->getQuestions()){
    foreach ($question as $key => $value) {
      echo "<div class=question id=".$theme->_id."_".$value->_id." onload=afficheListeChoix(".$theme->_id.",".$value->_id.")>$value->_phrase</div><br>";
    }
  }else echo "il n'existe aucune question pour ce thème";
}

function getIndice($id){
  $question = Question::getQuestion($id);
  echo $question->getIndice();
}


 ?>
