<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<?php
include "../include.php";

  session_start();
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
      echo "<div class=theme id=$value->_id>$value->_nom";
      afficheQuestion($value->_id);
      echo "</div>";
    }
  }

  function afficheQuestion($t_id){
    $questionsList = Theme::getTheme($t_id)->getQuestions();
    foreach ($questionsList as $key => $value) {
      if(!Score::scoreExiste($value->_id,$_SESSION["e_id"])){
        echo "<div class=question id=$value->_id>$value->_phrase<br>";
        afficheChoix($value->_id);
        echo "<div id=consult_$value->_id style=display:none>false</div><button class=valider onclick=calculerScore($value->_id)>Valider</button><button id=button_$value->_id onclick=afficheIndice($value->_id)>Afficher l'indice</button>";
        echo "</div>";
      }else {
        $score=Score::getScoreByQuestion($value->_id,$_SESSION["e_id"]);
        echo "<div class=question id=$value->_id>$value->_phrase $score->_valeur points</div>";
      }
    }
  }

  function afficheChoix($q_id){
    $choixList = Question::getQuestion($q_id)->getChoix();
    $i=0;
    foreach ($choixList as $key => $value) {
      $i++;
      echo "<div class=choix><input id=$value->_id type=radio class=choix name=question_$q_id>$value->_phrase</div>";
    }
    echo "<div class=score><label name=score_$q_id>$i</label>/$i points</div>";
  }

?>

<script type="text/javascript">
var nom = <?php echo "'".$_SESSION["e_nom"]."'" ?>;
var prenom = <?php echo "'".$_SESSION["e_prenom"]."'" ?>;

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
      type: "GET",
      url: "../operations/scoreOperations.php",
      data: "function=saveScore&id="+q_id+"&valeur="+scoreValeur+"&reponseId="+reponseId+"&consult="+consult,
      success: function(data){
        $("body")[0].innerHTML=data+$("body")[0].innerHTML;
      }
  });
}

function afficheIndice(q_id){
  var scoreValeur = parseInt($("label[name=score_"+q_id+"]")[0].innerHTML);
  scoreValeur--;
  $("label[name=score_"+q_id+"]")[0].innerHTML=scoreValeur;
  $("#consult_"+q_id)[0].innerHTML=true;
  $.ajax({
      type: "GET",
      url: "../operations/questionOperations.php",
      data: "function=getIndice&id="+q_id,
      success: function(data){
        alert("Indice : "+data);
      }
  });
  $("#button_"+q_id)[0].style.display="none";
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
          console.log(data);
          $("label[name=score_"+q_id+"]")[0].innerHTML=data;
        }
    });
    // saveScore(q_id);
  }

}

</script>

<body>

</body>
</html>
