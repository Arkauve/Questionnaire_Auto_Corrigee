<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <header>
        <h1>Votre examen</h1>

    </header>

<div id="partie_themes">
<h2>Thèmes</h2>
    <div  style="display:inline;">
        <form id="form-theme">
            Intitulé : <input id="intitule_theme" type="text"/>
            Nombre de questions à poser : <input id="nb_questions" type="number"/>
            <input type="submit" value="Ajouter"/>
        </form>
    </div>

<ul id="liste_themes">

</ul>


</div>

<div >

<!-- QUESTIONS -->
<div id="partie_questions">
    <h2>Questions</h2>
    <form id="form-question">
        Intitulé : <input id="intitule_question" type="text" name="intitule"/>
        Theme : <SELECT  id="select_theme" name="theme"></SELECT>
        Indice : <input id="indice" type="text" name="indice"/>
        Nombre choix dispo : <input id="nb_choix" type="number"/>
        <input type="submit" value="Ajouter"/>
    </form>

<ul id="liste_questions">

</ul>

</div>

<!-- CHOIX -->
<div id="partie_choix">
    <h2>Choix</h2>
    <form id="form-choix">
        Intitulé : <input id="intitule_choix" type="text" name="intitule"/>
        Question : <SELECT id="select_question" name="question"></SELECT>
        Correct: <input id="correct" name="correct" type="checkbox"/>
        <input type="submit" value="Ajouter"/>
    </form>

<ul id="liste_choix">

</ul>

</div>
<div style="clear:both; font-size:1px;"></div>
</div>

</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/script.js"></script>


</html>
