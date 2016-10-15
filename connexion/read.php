<?php
session_start() ;
if( ! isset( $_SESSION["nom"] ) )
{ die("Pas de session trouvée !");
}
print "nom : " . $_SESSION["nom"] ;
?>