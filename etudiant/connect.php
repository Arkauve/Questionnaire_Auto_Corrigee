<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>

    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <?php
    include "../include.php";
    if(!empty($_POST))
    {
      if(!empty($_POST['nom']) && !empty($_POST['prenom'])){
        session_start();
        if(($etudiant = Etudiant::getEtudiantByName($_POST['nom'],$_POST['prenom']))!=null){
          $_SESSION['e_nom']=$_POST['nom'];
          $_SESSION['e_prenom']=$_POST['prenom'];
          $_SESSION['e_id']=$etudiant->getId();
          header("Location: ../etudiant/index.php");
          exit();
        }
        echo "<div class=error>Erreur : vous n'êtes pas enregistré pour cet examen</div>";
      }
      else echo "Veuillez rensigner votre nom et votre prénom";
    }

     ?>
  </head>
  <body>
    <h1 class="accueil-title">Etudiant</h1>

    <form class="block-accueil" action="" method="post">
      <div><label for="nom">Nom : </label><input type="text" name="nom" value=""></div>
      <div><label for="prenom">Prénom : </label><input type="text" name="prenom" value=""></div>
      <input type="submit" name="name" value="valider">
    </form>

  </body>
</html>
