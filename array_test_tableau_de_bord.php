<?php

$nb_questions_global = 30;
$dico_etudiant =  array(
    "Damien" => array(10,5),
    "Romain" => array(0,7),
    "Lucas" => array(21,14)
);


 ?>
 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


</head>

<body>
 <table>

    <tr>
        <th>Nom</th>
        <th>Score</th>
        <th>Questions répondues</th>
    </tr>

    <?php
foreach ($dico_etudiant as $nom => $tab_questions) {

  echo "<tr>";
    echo "<td>";
      echo $nom;
    echo "</td>";

    echo "<td>";
    echo $tab_questions[0];
    echo "</td>";

    echo "<td>";
    echo $tab_questions[1];
    echo "</td>";

  echo "</tr>";
}


     ?>

 </table>
 </body>
 </html>
