<?php
if(isset($_POST))
{
  if($_POST['login']!=''){
    session_start();
    $_SESSION['login']=$_POST['login'];
    header("Location: ../etudiant/index.php");

  }
  else echo "ERROR";
}


 ?>
