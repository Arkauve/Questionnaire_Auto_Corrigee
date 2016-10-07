<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

<?php
include "../class/theme.php";
include "../connexion_bdd.php";

if(!empty($_POST)){
  $theme = new Theme($_POST["phrase"]);
  $theme->save();
}

?>

  <body>
    <pre>
      <form class="" action="#" method="post">
        <label for="">Nom du theme</label>  <input type="text" name="phrase" value=""> <input type="submit" name="name" value="valider">
      </form>
      <label>Liste de thèmes</label>
      <?php
      if(($themesList = Theme::getAllThemes())!=null){
        foreach ($themesList as $key => $value) {
          echo "<label id=".$value->id_theme.">".$value->t_theme."</label><br>";
        }
      }else echo "Il n'existe aucun thème"
      ?>

    </pre>

  </body>
</html>
