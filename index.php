<?php

if(isset($_SESSION['nom']))
{
  header("Location: etudiant/index.php");
  exit();
}

?>

 <!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body>
<h1>Examen</h1>

<label id="redirect">Vous êtes</label>

<a href="./etudiant/">etudiant</a>
<a href="./prof/">enseignant</a>

</body>
