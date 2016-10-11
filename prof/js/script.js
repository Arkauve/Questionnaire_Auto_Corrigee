(function(){

    var init = function(){
        handleInput();



    }

    function handleInput(){
        $("#input-form").on('submit',function(event){
            var input_nom_theme = $("#nom_theme");
            event.preventDefault(); //supprimer l'event de base du submit
            nom_theme = input_nom_theme.val();
            console.log(nom_theme);
            if(nom_theme){
                ajouterThemeToList(nom_theme);
                input_nom_theme.val('');
            }
        });

    }

    function ajouterThemeToList(nom){
        var ul_themes = $(".themes-container");
        ul_themes.append("<li>"+nom+"</li>");
    }





init();
})();
