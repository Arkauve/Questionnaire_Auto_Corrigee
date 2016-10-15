<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <header>
        <h1 style="width : 10em;
        margin:auto">Votre examen</h1>

    </header>

<div id="partie_themes">
<h2>Thèmes</h2>
    <div  style="display:inline;">
        <form id="form-theme">
            <input autocomplete="off" placeholder="Intitulé" id="intitule_theme" type="text"/>
            <input placeholder="N. questions" id="nb_questions" type="number"/>
            <input type="submit" value="Ajouter"/>
        </form>
    </div>

<ul id="liste_themes">

</ul>


</div>

<div>

<!-- QUESTIONS -->
<div id="partie_questions">
    <h2>Questions</h2>
    <form id="form-question">
        <input autocomplete="off" placeholder="Votre question" id="intitule_question" type="text" name="intitule"/>
        <SELECT  id="select_theme" name="theme">
            <option value="nonono" disabled selected>Choissisez un thème</option>
        </SELECT>
        <input autocomplete="off" placeholder="Indice" id="indice" type="text" name="indice"/>
        <input placeholder="N. choix" id="nb_choix" type="number"/>
        <input type="submit" value="Ajouter"/>
    </form>

<ul id="liste_questions">

</ul>

</div>

<!-- CHOIX -->
<div id="partie_choix">
    <h2>Choix</h2>
    <form id="form-choix">
        <input autocomplete="off" placeholder="Un choix"id="intitule_choix" type="text" name="intitule"/>
        <SELECT id="select_question" name="question">
            <option value="nonono" disabled selected>Choissisez une question</option>
        </SELECT>
        <input type="submit" value="Ajouter"/>
        <label style="display:inline" for="correct">Correct <input style="vertical-align: middle;" id="correct" name="correct" type="checkbox"/></label>

    </form>

<ul id="liste_choix">

</ul>

</div>
<div style="clear:both; font-size:1px;"></div>
</div>
<div style="text-align : center;margin-top : 2em;">
    <a href="dashboard.php"class="btn">C'est parti !</a>
</divW
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/script.js"></script>


</html>
