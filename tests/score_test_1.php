<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

  </head>

<?php
include "../connexion_bdd.php";
include "../class/question.php";
include "../class/etudiant.php";
include "../class/score.php";

if(!empty($_POST)){
  $consult = true;
  $valeur = Score::calculScore($_POST["reponse"],$_POST["solution"],$_POST["nbPt"],$consult);
  echo $valeur.'<br>';
  $score = new Score($_POST["reponse"],$valeur,$consult, $_POST["question"]);
  print_r($score->getReponse());
  $score->save($_POST["etudiant"]);
}

?>

  <body>
    <pre>

      <?php
      if(($questionList = Question::getAllQuestions())!=null){
        echo '<select name="question" form="formScore">';
        foreach ($questionList as $key => $value) {
          echo "<option value=".$value->getId().">".$value->getPhrase()."</option>";
        }
        echo "</select><br><br>";
      }

      if(($etudiantList = Etudiant::getAllEtudiant())!=null){
        echo '<select name="etudiant" form="formScore">';
        foreach ($etudiantList as $key => $value) {
          echo "<option value=".$value->getId().">".$value->getNom()." ".$value->getPrenom()."</option>";
        }
        echo "</select>";
      }
      ?>

      <form id="formScore" class="" action="#" method="post">
        <label for="">Reponse</label>              <input type="text" name="reponse" value=""><br>
        <label for="">solution</label>             <input type="text" name="solution" value=""><br>
        <label for="">Nombre de points MAX</label> <input type="number" name="nbPt" value=""><br>
        <input type="submit" name="name" value="valider">
      </form>



      <label>Liste de tous les score</label>
    </pre>

    <?php
      if(($scoreList = Score::getAllScore())!=null){
        foreach ($scoreList as $key => $value) {
          //print_r($value);
          echo "<label id=".$value->getId().">valeur : ".$value->getValeur().", réponse : ".$value->getReponse()."<label><br>";
        }
      }else echo "Il n'existe aucun score";
    ?>

  </body>
</html>
