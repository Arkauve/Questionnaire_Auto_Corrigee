<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>

    <?php
    if(!empty($_POST))
    {
      if(!empty($_POST['nom']) && !empty($_POST['prenom'])){
        session_start();
        if(Etudiant::etudiantExiste($_POST['nom'],$_POST['prenom'])){
          $_SESSION['nom']=$_POST['nom'];
          $_SESSION['prenom']=$_POST['prenom'];
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
    <form class="" action="" method="post">
      <label for="nom">Nom : </label><input type="text" name="nom" value=""><br>
      <label for="prenom">Prénom : </label><input type="text" name="prenom" value=""><br>
      <input type="submit" name="name" value="valider">
    </form>

  </body>
</html>
