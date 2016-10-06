<?php
include "../recup_exam/theme.php";

// version mysqli (style objet)
// changez l'identifiant / mdp en fonction de votre config
// param : server, login, mdp, nom de la bdd
$bdd = new mysqli('localhost', 'root', '10223102m' , 'examen');

/* Vérification de la connexion */
if ($bdd->connect_errno) {
    printf("Échec de la connexion : %s\n", $bdd->connect_error);
    exit();
}

/* Requête "Select" retourne un jeu de résultats */
/*if ($result = $bdd->query("SELECT * FROM `theme`")) {
    printf("Select a retourné %d lignes.\n", $result->num_rows);}
*/
    /* Libération du jeu de résultats */
/*
    if($result){
         // Cycle through results
        while ($row = $result->fetch_object()){
            $group_arr[] = $row;
        }
         // Free result set
         $result->close();
         print_r($group_arr);
    }
*/

if(isset($_POST['action'])){

  $nom =$_POST['nom'];
  new Theme($nom);

  }


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<body>
<pre>
<h1> Gestion des themes </h1>

<h3> Ajout d'un thème </h3>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="inserer" />
<p>Nom du theme : <input type="text" name="nom" /></p>
<p><input type="submit" name="Submit" value="Ajouter" /></p>
</form>

<h3> Liste des thèmes enregistrés </h3>
<?php

if ($result = $bdd->query("SELECT * FROM `theme`")) {
    printf("Select a retourné %d lignes.\n", $result->num_rows);}

    /* Libération du jeu de résultats */

    if($result){
         // Cycle through results
        while ($row = $result->fetch_object()){
            $group_arr[] = $row;
            print_r("Thème ".$row->nom."\n");
        }
         // Free result set
         $result->close();
    }
     ?>
</pre>
</body>
</html>
