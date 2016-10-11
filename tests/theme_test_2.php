<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

  </head>

<?php
include "../class/question.php";
include "../class/theme.php";
include "../connexion_bdd.php";

if(!empty($_GET)){
  if($_GET['function']=="deleteTheme"){
    echo "fonction ".$_GET['function']." id :".$_GET["id"]." <br>";
    $theme = Theme::deleteTheme($_GET["id"]);
  }
}

if(!empty($_POST)){
  $theme = new Theme($_POST["phrase"]);
  $theme->save();
}

?>

<script type="text/javascript">
  $(document).ready(function(){
    $("#selectTheme").change(function(){
      $.ajax({
          type: "GET",
          url: "../operations/themeOperations.php",
          data: "function=getQuestions&id="+this.value+"",
          success: function(data){
              $("#questions")[0].innerHTML=data;
         }
      });
    });
  });

</script>

<body>
  <pre>

    <label>Liste des questions du theme</label> <?php
    if(($themesList = Theme::getAllThemes())!=null){
      echo '<select id="selectTheme" name="theme" ><option value="">Aucun</option>';
      foreach ($themesList as $key => $value) {
        echo "<option value=".$value->getId().">".$value->getNom()."</option>";
      }
      echo "</select>";
    }
    ?>

  </pre>
  <div id="questions">


  <?php
    if(($questionsList = Question::getAllQuestions())!=null){
      foreach ($questionsList as $key => $value) {
        //print_r($value);
        echo "<label id=".$value->getId().">Question : ".$value->getPhrase().", solution : ".$value->getSolution().", nombre de choix: ".$value->getNbChoix().", indice: ".$value->getIndice()."<label><br>";
      }
    }else echo "Il n'existe aucune questions";
  ?>
  </div>

</body>
</html>
