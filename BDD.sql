#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: theme
#------------------------------------------------------------

CREATE TABLE theme(
        id_theme    int (11) Auto_increment  NOT NULL ,
        t_theme       Varchar (50) ,
        PRIMARY KEY (Id_theme )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: question
#------------------------------------------------------------

CREATE TABLE question(
        id_question int (11) Auto_increment  NOT NULL ,
        q_phrase      Varchar (250) NOT NULL,
        q_solution    Varchar (25) NOT NULL,
        q_indice      Varchar (250) ,
        q_nb_choix    Int ,
        q_id_theme Int ,
        PRIMARY KEY (id_question )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: choix
#------------------------------------------------------------

CREATE TABLE choix(
        id_choix int (11) Auto_increment  NOT NULL ,
        c_valeur   Varchar (250) NOT NULL,
        c_phrase   Varchar (250) NOT NULL,
        c_id_question Int,
        PRIMARY KEY (id_choix )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: etudiant
#------------------------------------------------------------

CREATE TABLE etudiant(
        id_etudiant int (11) Auto_increment  NOT NULL ,
        e_nom         Varchar (250) ,
        e_prenom      Varchar (250) ,
        PRIMARY KEY (id_etudiant )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: score
#------------------------------------------------------------

CREATE TABLE score(
        id_score    int (11) Auto_increment  NOT NULL ,
        s_reponse     Varchar (250) ,
        s_consult     Boolean,
        s_valeur      Int ,
        s_id_question Int ,
        s_id_etudiant Int,
        PRIMARY KEY (id_score )
)ENGINE=InnoDB;

ALTER TABLE question ADD CONSTRAINT FK_question_id_theme FOREIGN KEY (q_id_theme) REFERENCES theme(id_theme);
ALTER TABLE choix ADD CONSTRAINT FK_choix_id_question FOREIGN KEY (c_id_question) REFERENCES question(id_question);
ALTER TABLE score ADD CONSTRAINT FK_score_id_question FOREIGN KEY (s_id_question) REFERENCES question(id_question);
ALTER TABLE score ADD CONSTRAINT FK_score_id_etudiant FOREIGN KEY (s_id_etudiant) REFERENCES etudiant(id_etudiant);


INSERT INTO 'etudiant' ('e_nom','e_prenom') VALUES ('GARNIER','Romain');
INSERT INTO 'etudiant' ('e_nom','e_prenom') VALUES ('ROGE','Damien');
INSERT INTO 'etudiant' ('e_nom','e_prenom') VALUES ('TRIPPONI','Lucas');
