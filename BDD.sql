#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Theme
#------------------------------------------------------------

CREATE TABLE Theme(
        Id_theme    int (11) Auto_increment  NOT NULL ,
        theme       Varchar (50) ,
        id_question Int ,
        PRIMARY KEY (Id_theme )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: question
#------------------------------------------------------------

CREATE TABLE question(
        id_question int (11) Auto_increment  NOT NULL ,
        indice      Varchar (250) ,
        nb_choix    Int ,
        id_score    Int ,
        id_choix    Int ,
        PRIMARY KEY (id_question )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Choix
#------------------------------------------------------------

CREATE TABLE Choix(
        id_choix int (11) Auto_increment  NOT NULL ,
        valeur   Varchar (250) ,
        PRIMARY KEY (id_choix )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: etudiant
#------------------------------------------------------------

CREATE TABLE etudiant(
        id_etudiant int (11) Auto_increment  NOT NULL ,
        nom         Varchar (250) ,
        prenom      Varchar (250) ,
        id_score    Int ,
        PRIMARY KEY (id_etudiant )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Score
#------------------------------------------------------------

CREATE TABLE Score(
        id_score    int (11) Auto_increment  NOT NULL ,
        reponse     Varchar (250) ,
        consult     Bool ,
        valeur      Int ,
        id_question Int ,
        PRIMARY KEY (id_score )
)ENGINE=InnoDB;

ALTER TABLE Theme ADD CONSTRAINT FK_Theme_id_question FOREIGN KEY (id_question) REFERENCES question(id_question);
ALTER TABLE question ADD CONSTRAINT FK_question_id_score FOREIGN KEY (id_score) REFERENCES Score(id_score);
ALTER TABLE question ADD CONSTRAINT FK_question_id_choix FOREIGN KEY (id_choix) REFERENCES Choix(id_choix);
ALTER TABLE etudiant ADD CONSTRAINT FK_etudiant_id_score FOREIGN KEY (id_score) REFERENCES Score(id_score);
ALTER TABLE Score ADD CONSTRAINT FK_Score_id_question FOREIGN KEY (id_question) REFERENCES question(id_question);
