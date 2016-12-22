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

if(!empty($_POST)){
  $question = new Question($_POST["phrase"],$_POST["indice"],$_POST["nbChoix"]);
  print_r($_POST["phrase"]." ".$_POST["solution"]." ".$_POST["indice"]." ".$_POST["nbChoix"]);
  print_r($question->getId()." ".$question->getPhrase()." ".$question->getSolution()." ".$question->getIndice()." ".$question->getNbChoix());
  $question->save($_POST["theme"]);
}

?>

  <body>
    <pre>

      <?php
      if(($themesList = Theme::getAllThemes())!=null){
        echo '<select name="theme" form="formQuestion">';
        foreach ($themesList as $key => $value) {
          echo "<option value=".$value->getId().">".$value->getNom()."</option>";
        }
        echo "</select>";
      }
      ?>

      <form id="formQuestion" class="" action="#" method="post">
        <label for="">Question</label>        <input type="text" name="phrase" value=""><br>
        <label for="">Solution</label>        <input type="text" name="solution" value=""><br>
        <label for="">Indice</label>          <input type="text" name="indice" value=""><br>
        <label for="">Nombre de choix</label> <input type="number" name="nbChoix" value=""><br>
        <input type="submit" name="name" value="valider">
      </form>



      <label>Liste des questions</label>
    </pre>

    <?php
      if(($questionsList = Question::getAllQuestions())!=null){
        foreach ($questionsList as $key => $value) {
          //print_r($value);
          echo "<label id=".$value->getId().">Question : ".$value->getPhrase().", solution : ".$value->getSolution().", nombre de choix: ".$value->getNbChoix().", indice: ".$value->getIndice()."<label><br>";
        }
      }else echo "Il n'existe aucune questions";
    ?>

  </body>
</html>
