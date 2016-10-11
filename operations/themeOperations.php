<?php
// Ce fichier contient des fonctions php permettant d'executer les fonctions de la classe Theme

include "../connexion_bdd.php";
include "../class/theme.php";
include "../class/question.php";

if(!empty($_GET)){
  choixFonction();
}

function choixFonction(){
  switch ($_GET["function"]){
    case "createTheme" :
      createTheme($_GET["nom"]);
      break;
    case "deleteTheme" :
      Theme::deleteTheme($_GET["id"]);
      break;
    case "getQuestions" :
      getListQuestions();
      break;
    case "getListThemes" :
      getListThemes();
      break;
  }
}

function createTheme($nom){
    $theme = new Theme($nom);
    $theme->save();
}


function getListThemes(){
  if(($listTheme = Theme::getAllThemes())!=null){
    foreach ($listTheme as $key => $value) {
      echo "<label class=theme id=".$value->_id." onload=afficheListeQuestions(".$value->_id.")>".$value->_nom."</label><button onclick=deleteTheme(".$value->_id.")>suprimer</button><br>";
    }
  }else echo "Il n'existe aucun thème";
}

function getListQuestions(){
  $theme = Theme::getTheme($_GET["id"]);
  if($question=$theme->getQuestions()){
    foreach ($question as $key => $value) {
      echo "<div class=question id=".$theme->_id."_".$value->_id." onload=afficheListeChoix(".$theme->_id.",".$value->_id.")>$value->_phrase</div><br>";
    }
  }else echo "il n'existe aucune question pour ce thème";
}


 ?>
