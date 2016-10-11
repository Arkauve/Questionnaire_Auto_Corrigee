<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <header>
        <h1 id="foo">Votre examen</h1>
        <h2>Thèmes</h2>
    </header>
    <div class="theme-form-container">
        <form id="input-form">
          <input type="text" id="nom_theme" placeholder="Entrez votre thème ici..."/>
          <input type="submit" value="Ajouter" />
        </form>
    </div>

    <ul class="themes-container">

        <div class="question-form-container">
        </div>
        <ul class="question-container">

            <div class="choix-form-container">
            </div>

            <ul class="choix-container">
            </ul>

        </ul>
    </ul>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/script.js"></script>


</html>
