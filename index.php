<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$( function() {
  $("#create").click( function(){
   $("#res").load("connexion/create.php?nom=" + $("#nom").val() );
  }) ;

  $("#read").click( function(){
    $("#res").load("connexion/read.php");
  }) ;

  $("#dest").click( function(){
    $("#res").load("connexion/destroy.php");
  }) ;


});
</script>
</head>

<body>
<h2>Session</h2>
<input id="nom">
<button id="create">Création</button>
<button id="read">Lecture</button>
<button id="dest">Suppression</button>

<div id="res">
</div>
</body>
