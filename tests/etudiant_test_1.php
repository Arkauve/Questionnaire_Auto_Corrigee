<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

  </head>

<?php
include "../class/etudiant.php";
include "../connexion_bdd.php";

if(!empty($_POST)){
  $etudiant = new Etudiant($_POST["nom"],$_POST["prenom"]);
  $etudiant->save();
}

?>

  <body>
    <pre>



      <form id="formEtudiant" class="" action="#" method="post">
        <label for="">Nom</label>        <input type="text" name="nom" value=""><br>
        <label for="">Prenom</label>        <input type="text" name="prenom" value=""><br>
        <input type="submit" name="name" value="valider">
      </form>



      <label>Liste de tous les etudiants</label>
    </pre>

    <?php
      if(($etudiantList = Etudiant::getAllEtudiant())!=null){
        foreach ($etudiantList as $key => $value) {
          //print_r($value);
          echo "<label id=".$value->getId().">Nom : ".$value->getNom().", Prenom : ".$value->getPrenom()."<label><br>";
        }
      }else echo "Il n'existe aucun étudiant";
    ?>

  </body>
</html>
