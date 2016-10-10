<?php

class Etudiant{
  var $_id;
  var $_nom;
  var $_prenom;

  function __construct($unNom,$unPrenom){
    $this->_nom = $unNom;
    $this->_prenom = $unPrenom;
  }

  function save(){
    global $bdd;
    try{
      $bdd->query("INSERT INTO etudiant(e_nom, e_prenom) VALUES ('$this->_nom','$this->_prenom')");
    }catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    $this->_id = $bdd->lastInsertId();
  }

  function setId($id){
    $this->_id=$id;
  }

  function getId(){
     return $this->_id;
  }

  function getNom(){
    return $this->_nom;
  }

  function getPrenom(){
    return $this->_prenom;
  }

  // Converti un objet SQL en Etudiant
  // Testé
  static function getSQLObject($SQLObject){
    $etudiant = new Etudiant($SQLObject["e_nom"],$SQLObject["e_prenom"]);
    $etudiant->setId($SQLObject["e_id"]);
    return $etudiant;
  }

  // Méthode renvoyant une liste de tous les thèmes
  // Testé
  static function getAllEtudiant(){
    global $bdd;
    if ($result = $bdd->query("SELECT * FROM `etudiant`")){
         // Cycle through results
         $group_arr=null;
        while ($row = $result->fetch()){
            $group_arr[] = Etudiant::getSQLObject($row);
        }
         // Free result set
         $result->closeCursor();
         return $group_arr;
    }
  }

  static function getEtudiant($id){
    global $bdd;
    if ($resultSQL = $bdd->query("SELECT * FROM `Etudiant` WHERE t_id=$id")){
      $result = Etudiant::getSQLObject($resultSQL->fetch());
      $resultSQL->closeCursor();
      return $result;
    }
  }


}

?>
