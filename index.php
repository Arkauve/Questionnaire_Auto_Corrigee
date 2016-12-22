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
  <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>

<body>
<h1 class="accueil-title">Examen</h1>

<div class="block-accueil">
  <div class="block-title"><b>Vous êtes</b></div>
  <a href="./etudiant/">etudiant</a>
  <a href="./prof/">enseignant</a>
</div>


</body>
