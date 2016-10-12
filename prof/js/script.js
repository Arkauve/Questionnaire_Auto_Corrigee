(function(){

    var init = function(){
        handleInputThemes();



    }

    function handleInputThemes(){
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

    //Appelé à la création du input pour parametré l'ajout de l'entitulé de la question dans le  bon <ul>
    function handleInputQuestions(id_input){
      $("#input-form-question-"+id_input).on('submit',function(event){
          var input_nom_theme = $("#"+id_input+"nom_question");
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

        var form = $("<form></form>");
        form.attr("id","question-form-"+compterThemes());


        ul_themes.prepend(form);
        form.after("<li>"+nom+"</li>");
        form.append("<input type=\"text\" placeholder=\"Votre question ici...\" autocomplete=\"off\"/>");
        form.append("<input type=\"submit\" value=\"Ajouter\"/>");

        form.after("<ul class=\"questions-container\" id=\"\"></ul>");


    }

    function ajouterInputQuestion(nom_theme){


    }

    function compterThemes(){
      return $("#themes-container li").length;
    }




init();
})();
