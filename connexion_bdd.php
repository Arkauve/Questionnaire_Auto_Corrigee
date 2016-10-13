<?php
global $bdd;

// Connexion avec mysqli
//$bdd = new mysqli('localhost', 'root', '' , 'examen');

//Connexion à la base de données avec PDO
try{
  $bdd = new PDO('mysql:host=localhost;dbname=examen;charset=utf8', 'root', '10223102m');
}catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

/* Vérification de la connexion
if ($bdd->connect_errno) {
    printf("Échec de la connexion : %s\n", $bdd->connect_error);
    exit();
}*/

 ?>
