<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

  </head>

<?php
include "../class/theme.php";
include "../connexion_bdd.php";
/*
if(!empty($_GET)){
  if($_GET['function']=="deleteTheme"){
    echo "fonction ".$_GET['function']." id :".$_GET["id"]." <br>";
    $theme = Theme::deleteTheme($_GET["id"]);
  }
}

if(!empty($_POST)){
  $theme = new Theme($_POST["phrase"]);
  $theme->save();
}
*/
?>

  <body>

    <script type="text/javascript">
    $(document).ready(function(){
      afficheListeTheme();
    });

    function afficheListeTheme(){
      $.ajax({
          type: "GET",
          url: "../operations/themeOperations.php",
          data: "function=getListThemes",
          success: function(data){
              $("#listThemes")[0].innerHTML=data;
         }
      });
    }

    function createTheme(){
      var id=$("input[name=phrase]")[0].value;
      $.ajax({
          type: "GET",
          url: "../operations/themeOperations.php",
          data: "function=createTheme&id="+id,
          success: function(data){
              console.log("data");
         }
      });
      afficheListeTheme();
    }

    function deleteTheme(id){
      //Methode POST
      //document.location.href="theme_test_1.php?function=deleteTheme&id="+id;
      //Mode ajax
       $.ajax({
           type: "GET",
           url: "../operations/themeOperations.php",
           data: "function=deleteTheme&id="+id,
           success: function(data){
               console.log("data");
          }
       });
       afficheListeTheme();
    }


    </script>

      <label >Nom du theme</label>  <input type="text" name="phrase" value="">
      <button name="name" onclick="createTheme()">Valider</button>
      <label>Liste de thèmes</label>
      <div id="listThemes"></div>


  </body>
</html>
