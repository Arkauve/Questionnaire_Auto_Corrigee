(function(){

    var init = function(){
        handleInputThemes();
        handleInputQuestions();
        handleInputChoix();
    }

    function handleInputThemes(){
        $("#form-theme").on('submit',function(event){
            event.preventDefault(); //supprimer l'event de base du submit

            //inputs
            var input_intitule = $("#intitule_theme");
            var input_nb_questions = $("#nb_questions");

            //values
            intitule_theme = input_intitule.val();
            nb_questions = input_nb_questions.val();

            if(intitule_theme!='' && nb_questions!=''){
                ajouterThemeToList(intitule_theme,nb_questions);
                input_intitule.val('');
                ajaxCreateTheme(intitule_theme,nb_questions);
                //Mise a jour liste des selects

            }
        });

    }

    function handleInputQuestions(){
        $("#form-question").on('submit',function(event){
            event.preventDefault(); //supprimer l'event de base du submit

            //inputs
            var input_intitule = $("#intitule_question");
            var input_theme = $("#select_theme");
            var input_indice = $("#indice");
            var input_nb_choix = $("#nb_choix");

            //values
            intitule_question = input_intitule.val();
            theme = input_theme.find(":selected").text();
            indice = input_indice.val();
            nb_choix = input_nb_choix.val();
            id_theme = input_theme.find(":selected").attr("name");
            if(intitule_question!='' && theme!='' && indice!='' && nb_choix!='' && input_theme.find(":selected").val()!="nonono"){

                var numero_question = $("#liste_questions").children().length;
                //Mise a jour liste des selects


                ajouterQuestionToList(intitule_question,nb_choix,theme,indice,numero_question);

                input_intitule.val('');
                input_indice.val('');
                ajaxCreateQuestion(intitule_question,indice,nb_choix,id_theme);
                }
        });

    }

    function handleInputChoix(input_elem){
        $("#form-choix").on('submit',function(event){
            event.preventDefault(); //supprimer l'event de base du submit

            //inputs
            var input_intitule = $("#intitule_choix");
            var input_question = $("#select_question");
            var input_correct = $("#correct");

            //values
            intitule_choix = input_intitule.val();
            question = input_question.find(":selected").text();
            correct = input_correct.is(':checked');
            id_question = input_question.find(":selected").attr("name");
            if(intitule_choix!='' && question!='' && input_question.find(":selected").val()!="nonono"){
                ajouterChoixToList(intitule_choix,question,correct);
                input_intitule.val('');
                input_correct.prop('checked', false);
                ajaxCreateChoix(intitule_choix,id_question,correct);
            }
        });
    }



    function ajouterThemeToList(nom,nb_questions){

        var li_theme = $("<li>"+nom+" : "+nb_questions+" questions"+"</li>");
        $("#liste_themes").append(li_theme);
    }





    function ajouterQuestionToList(nom, nb_choix,theme,indice,numero_question){
        var li_question = $("<li>Question "+numero_question+" : "+nom+" ("+nb_choix+" choix,"+ "theme : "+theme+", indice : "+indice+")</li>");
        $("#liste_questions").append(li_question);
    }


    function ajouterChoixToList(nom_choix, question,correct){
        var li_choix = $("<li>"+question+" - \""+nom_choix+"\", Correct : "+correct +"</li>");
        $("#liste_choix").append(li_choix);
    }




    function compterThemes(){
      return $("#themes-container li").length;
    }

    function ajaxCreateTheme(nom_theme,nb_questions){
        $.ajax({ url: '../operations/queries.php',
         data: {action: 'createTheme', nom_theme: nom_theme,nb_questions:nb_questions},
         type: 'post',
         //callback
         success: function(output) {
             ajoutThemeDropdown(output,nom_theme);
                  }
});
    }
    function ajaxCreateQuestion(nom_question,indice,nb_choix,id_theme){
        $.ajax({ url: '../operations/queries.php',
         data: {action: 'createQuestion', nom_question: nom_question, indice: indice, nb_choix: nb_choix, id_theme:id_theme},
         type: 'post',
         //callback
         success: function(output) {
             ajoutQuestionDropdown(output,nom_question);
                  }
});
    }
    function ajaxCreateChoix(nom_choix,id_question,correct){
        $.ajax({ url: '../operations/queries.php',
         data: {action: 'createChoix', nom_choix: nom_choix, id_question: id_question},
         type: 'post',
         //callback
         success: function(output) {
             if(correct)
                ajaxUpdateQuestion(id_question,output);
                  }
});
    }

    function ajaxUpdateQuestion(id_question,id_choix){
        $.ajax({ url: '../operations/queries.php',
         data: {action: 'updateQuestion', id_question: id_question, id_choix: id_choix},
         type: 'post',
         //callback
         success: function(output) {
             erreur(output);
                  }
});
    }

    //badass
    function ajoutThemeDropdown(id,nom_theme) {
        $("#select_theme").append("<option name=\""+id+"\">"+intitule_theme);
    }

    function ajoutQuestionDropdown(id,nom_question) {
        $("#select_question").append("<option name=\""+id+"\"> Question "+(($("#liste_questions").children().length)-1));
    }

    function erreur(str) {
        $("body").append(str);

    }



init();
})();
