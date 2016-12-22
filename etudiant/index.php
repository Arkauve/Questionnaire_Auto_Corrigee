<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Examen</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
include "../include.php";


  session_start();

  if(!empty($_GET)){
    if(!empty($_GET["terminer"])){
      session_destroy();
      header("Location: ../etudiant/connect.php");
      exit();
    }
  }

  if(empty($_SESSION)){
    header("Location: ../etudiant/connect.php");
    exit();
  }
  if(!empty($_SESSION)){
    echo "<h1>Test de connaissance</h1><div class=f_droite> Nom : ".$_SESSION['e_nom'].", Prénom : ".$_SESSION['e_prenom']."</div>";
    afficheExamen();
  }

  function afficheExamen(){
    afficheThemes();
  }

  function afficheThemes(){
    $themesList = Theme::getAllThemes();
    foreach ($themesList as $key => $value) {
      echo "<fieldset class=block_theme id=$value->_id><legend clas=theme_nom>$value->_nom</legend>";
      afficheQuestion($value->_id);
      echo "</fieldset>";
    }
  }

  function afficheQuestion($t_id){
    $questionsList = Theme::getTheme($t_id)->getQuestionsRandom();
    foreach ($questionsList as $key => $value) {
      if(!Score::scoreExiste($value->_id,$_SESSION["e_id"])){
        echo "<fieldset class=block_question id=question_$value->_id><legend class=question_phrase id=phrase_$value->_id>$value->_phrase</legend><div id=content_question_$value->_id>";
        afficheChoix($value->_id);
        echo "<div id=consult_$value->_id style=display:none>false</div><button class=valider onclick=calculerScore($value->_id)>Valider</button><button id=button_$value->_id onclick=afficheIndice($value->_id)>Afficher l'indice</button>";
        echo "<div class=score><label name=score_$value->_id>$value->_nb_points</label>/$value->_nb_points points</div></div></fieldset>";
      }else {
        $score=Score::getScoreByQuestion($value->_id,$_SESSION["e_id"]);
        echo "<div class=question id=$value->_id><label class=question_phrase id=phrase_$value->_id>$value->_phrase</label>  <label id=score_$value->_id class=score>$score->_valeur/$value->_nb_points points</label></div>";
      }
    }
  }

  function afficheChoix($q_id){
    $choixList = Question::getQuestion($q_id)->getChoixRandom();
    foreach ($choixList as $key => $value) {
      echo "<div class=choix><input id=$value->_id type=radio class=choix name=question_$q_id>$value->_phrase</div>";
    }
  }

?>

<script type="text/javascript">
var nom = <?php echo "'".$_SESSION["e_nom"]."'" ?>;
var prenom = <?php echo "'".$_SESSION["e_prenom"]."'" ?>;

$(document).ready(function (){
  $("#b_terminer").click(function(){
    location.href+="?terminer=true";
  });
});

function getReponseId(q_id){
  var list = $("input[name=question_"+q_id+"]");
  for(var i = 0 ; i < list.size() ; i++){
    if(list[i].checked)return parseInt(list[i].id);
  }return null;
}

function saveScore(q_id){
  var scoreValeur = parseInt($("label[name=score_"+q_id+"]")[0].innerHTML);
  var reponseId = getReponseId(q_id);
  var consult = $("#consult_"+q_id)[0].innerHTML;
  console.log("score:"+scoreValeur+" reponse: "+reponseId+" consult:"+consult);
  $.ajax({
      type: "POST",
      url: "../operations/scoreOperations.php",
      data: "function=saveScore&id="+q_id+"&valeur="+scoreValeur+"&reponseId="+reponseId+"&consult="+consult,
      success: function(data){
        $("body")[0].innerHTML=data+$("body")[0].innerHTML;
      }
  });
}

function afficheIndice(q_id){
  $.ajax({
      type: "POST",
      url: "../operations/questionOperations.php",
      data: "function=getIndice&id="+q_id,
      success: function(data){
        alert("Indice : "+data);
      }
  });
  updatescore(q_id);
}

function updatescore(q_id){
  $.ajax({
      type: "POST",
      url: "../operations/questionOperations.php",
      data: "function=getScoreMax&id="+q_id,
      success: function(data){
        $("label[name=score_"+q_id+"]")[0].innerHTML=data;
      }
  });
}


function calculerScore(q_id){
  var reponseId = getReponseId(q_id);
  if(reponseId==null)alert("Erreur : vous n'avez pas répondu à la question");
  else {
    var scoreValeur = $("label[name=score_"+q_id+"]")[0].innerHTML;
    var consult = $("#consult_"+q_id)[0].innerHTML;
    console.log("score:"+scoreValeur+" reponse: "+reponseId+" consult:"+consult);
    $.ajax({
        type: "GET",
        url: "../operations/scoreOperations.php",
        data: "function=calculeScore&id="+q_id+"&reponseId="+reponseId+"&valeur="+scoreValeur+"&consult="+consult,
        success: function(data){
          $("#content_question_"+q_id)[0].style.display="none";
          $("#question_"+q_id)[0].innerHTML=$("#question_"+q_id)[0].innerHTML+" <label id=score_"+q_id+" class=score>"+data+" points</label>";
        }
    });
    // saveScore(q_id);
  }

}

</script>

<body>

  <button id="b_terminer">Terminer</button>

</body>
</html>
