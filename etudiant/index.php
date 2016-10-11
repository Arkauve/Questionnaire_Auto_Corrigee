<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../prof/style.css">
</head>

<?php
include "../include.php";

  session_start();
  if(empty($_SESSION)){
    header("Location: ../etudiant/connect.php");
    exit();
  }
  if(!empty($_SESSION)){
    echo "<h1>Test de connaissance</h1><div class=f_droite> Nom : ".$_SESSION['nom'].", Prénom : ".$_SESSION['prenom']."</div>";
    afficheExamen();
  }

  function afficheExamen(){
    afficheThemes();
  }

  function afficheThemes(){
    $themesList = Theme::getAllThemes();
    foreach ($themesList as $key => $value) {
      echo "<div class=theme id=$value->_id>$value->_nom</div>";
      afficheQuestion($value->_id);
    }
  }

  function afficheQuestion($t_id){
    $questionsList = Theme::getTheme($t_id)->getQuestions();
    foreach ($questionsList as $key => $value) {
      echo "<div class=question id=$value->_id>$value->_phrase</div>";
      afficheChoix($t_id, $value->_id);
      echo "<button onclick=afficheIndice($value->_id)>Afficher l'indice</button><button class=valider onclick=calculerScore($value->_id)>Valider</button>";
    }
  }

  function afficheChoix($q_id){
    $choixList = Question::getQuestion($q_id)->getChoix();
    foreach ($choixList as $key => $value) {
      echo "<input type=radio class=choix name=$q_id value=$value->_valeur>$value->_phrase<br>";
    }
  }

?>

<script type="text/javascript">
var nom = <?php echo "'".$_SESSION["nom"]."'" ?>;
var prenom = <?php echo "'".$_SESSION["prenom"]."'" ?>;

function afficheIndice(q_id){

}

function calculerScore(q_id){

}

</script>

<body>

</body>
</html>
