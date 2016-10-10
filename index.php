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
<h1>Trigaro : l'examen sourire :)</h1>

<form method="post" action="connexion/connect.php" enctype="multipart/form-data" >

<p>
<label for="login">login :</label>
<input type="text" id="login" name="login" />
</p>
<p>
<label for="pass">Mot de passe :</label>
<input type="password" id="pass" name="pass" />
</p>
<input type="submit" name="connect" value="Me connecter" />

</form>



<div id="res">
</div>
</body>
