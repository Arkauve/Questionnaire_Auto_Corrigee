<?php
session_start() ;
$_SESSION["nom"] = $_GET["nom"] ;
print "session créée, nom : " . $_SESSION['nom'] ;
?>