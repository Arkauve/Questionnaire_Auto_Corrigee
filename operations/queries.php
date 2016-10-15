<?php
include "../include.php";
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    //Switch sur l'action spécificé dans le call ajax
    switch($action) {
        case 'createTheme' :
            $leTheme = new Theme($_POST['nom_theme'],$_POST['nb_questions']);
            $leTheme->save();
            print_r($leTheme->getId());
        break;

        case 'createQuestion' :
            $laQuestion = new Question($_POST['nom_question'],$_POST['indice'],$_POST['nb_choix']);
            $laQuestion->save($_POST['id_theme']);
            print_r($laQuestion->getId());
        break;

        case 'createChoix' :
            $leChoix = new Choix($_POST['nom_choix']);
            $leChoix->save(intval($_POST['id_question']));
            print_r($leChoix->getId());
        break;

        case 'updateQuestion' :
            $laQuestion = Question::getQuestion($_POST['id_question']);
            $laQuestion->setSolution($_POST['id_choix']);
            print_r($laQuestion->update());
        break;


}
}

?>
