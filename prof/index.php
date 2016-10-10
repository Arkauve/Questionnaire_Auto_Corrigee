<?php
include "../class/theme.php";
include "../connexion_bdd.php";

if(isset($_POST['action'])){

  $nom =$_POST['nom'];
  $th = new Theme($nom);
  $th->save();
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
            print_r("Thème ".$row->t_nom."\n");
        }
         // Free result set
         $result->close();
    }
     ?>
</pre>
</body>
</html>
