<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tableau de bord</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  </head>

<?php
include "../include.php";

if(!empty($_GET)){
  $e_id=$_GET["id"];
}else{
  $e_id=null;
}

?>

<script type="text/javascript">
$(document).ready(function (){
  $("#selectEtudiant").change(function (){
    refrechPage();
  });

  setInterval(refrechPage, 60000);

  function getIdSelected(){
    var list = $("option");
    for(var i=0;i<list.size();i++){
      if(list[i].selected)return list[i].value;
    }return null;
  }

  function refrechPage(){
    if((index=location.href.indexOf("?id"))<0)
      var url = window.location.href+"?id="+getIdSelected();
    else var url = window.location.href.substring(0,index)+"?id="+getIdSelected();
    //var url = window.location.href.split('?')[0]+"?id="+getIdSelected();
    location.href=url;
  }
});




</script>

  <body>

    <label>Choisisez un étudiant</label> <?php
    if(($themesList = Etudiant::getAllEtudiant())!=null){
      echo '<select id="selectEtudiant" name="etudiant" ><option value="">Aucun</option>';
      foreach ($themesList as $key => $value) {
        if($e_id==$value->getId())echo "<option selected value=".$value->getId().">".$value->getNom()." ".$value->getPrenom()."</option>";
        else echo "<option value=".$value->getId().">".$value->getNom()." ".$value->getPrenom()."</option>";
      }
      echo "</select>";
    }
    ?>

    <div class="tabScore">
      <?php
        if($e_id!=null){
          if(($scoresList = Score::getScoreByEtudiant($e_id))!=null){
            foreach ($scoresList as $key => $value) {
              echo "<label id=".$value->_reponseId.">Question : ".Question::getQuestion($value->_questionId)->_phrase.", Réponse : ".Choix::getChoixById($value->_reponseId)->_phrase.", Indice : ".$value->_consult.", Score : ".$value->_valeur." </label><br>";
            }
          }else echo "Cet etudiant n'a encore répondu à aucune question";
        }else {
          if(($scoresList = Score::getAllScore())!=null){
            foreach ($scoresList as $key => $value) {
              echo "<label id=".$value->_reponseId.">Question : ".Question::getQuestion($value->_questionId)->_phrase.", Réponse : ".Choix::getChoixById($value->_reponseId)->_phrase.", Indice : ".$value->_consult.", Score : ".$value->_valeur." </label><br>";
            }
          }else echo "Aucun n'étudiant n'a répondu à l'examen";
        }

      ?>
    </div>

  </body>
</html>
