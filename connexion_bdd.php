<?php
global $bdd;
$bdd = new mysqli('localhost', 'root', '' , 'examen');

/* Vérification de la connexion */
if ($bdd->connect_errno) {
    printf("Échec de la connexion : %s\n", $bdd->connect_error);
    exit();
}

 ?>
