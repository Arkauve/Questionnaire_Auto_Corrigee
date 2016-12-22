<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

  </head>

<?php
  include "../include.php";

  if(!empty($_POST)){
    $choix = new Choix($_POST["choix"]);
    $choix->save($_POST["question"]);
    $choix->addToQuestion($_POST['question']);
  }

?>

  <body>
    <pre>

      <?php
      if(($questionList = Question::getAllQuestions())!=null){
        echo '<select name="question" form="formChoix">';
        foreach ($questionList as $key => $value) {
          echo "<option value=".$value->getId().">".$value->getPhrase()."</option>";
        }
        echo "</select>";
      }
      ?>

      <form id="formChoix" class="" action="#" method="post">
        <label for="">Choix</label>        <input type="text" name="choix" value=""><br>
        <input type="submit" name="name" value="valider">
      </form>



      <label>Liste de tous les choix</label>
    </pre>

    <?php
      if(($choixList = Choix::getAllChoix())!=null){
        foreach ($choixList as $key => $value) {
          //print_r($value);
          echo "<label id=".$value->getId().">Choix : ".$value->getPhrase()."<label><br>";
        }
      }else echo "Il n'existe aucun choix";
    ?>

  </body>
</html>
