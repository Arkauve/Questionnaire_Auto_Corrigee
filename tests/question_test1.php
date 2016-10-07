<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

<?php
include "../class/question.php";

if(!empty($_POST)){
  $question = new Question($_POST["phrase"],$_POST["solution"],$_POST["indice"],$_POST["nbChoix"]);
  $question.save();
}

?>

  <body>
    <form class="" action="index.html" method="post">
      <label for=""></label><input type="button" name="name" value="">
    </form>

  </body>
</html>
