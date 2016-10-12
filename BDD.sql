#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: theme
#------------------------------------------------------------

CREATE TABLE theme(
        t_id    int (11) Auto_increment  NOT NULL ,
        t_nom       Varchar (50) ,
        t_nb_question Int ,
        PRIMARY KEY (t_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: question
#------------------------------------------------------------

CREATE TABLE question(
        q_id int (11) Auto_increment  NOT NULL ,
        q_phrase      Varchar (250) NOT NULL,
        q_solution    Varchar (25) NOT NULL,
        q_indice      Varchar (250) ,
        q_nb_choix    Int ,
        q_t_id Int ,
        PRIMARY KEY (q_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: choix
#------------------------------------------------------------

CREATE TABLE choix(
        c_id int (11) Auto_increment  NOT NULL ,
        c_valeur   Varchar (250) NOT NULL,
        c_phrase   Varchar (250) NOT NULL,
        c_q_id Int,
        PRIMARY KEY (c_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: etudiant
#------------------------------------------------------------

CREATE TABLE etudiant(
        e_id int (11) Auto_increment  NOT NULL ,
        e_nom         Varchar (250) ,
        e_prenom      Varchar (250) ,
        PRIMARY KEY (e_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: score
#------------------------------------------------------------

CREATE TABLE score(
        s_id    int (11) Auto_increment  NOT NULL ,
        s_reponse     Varchar (250) ,
        s_consult     Varchar (250),
        s_valeur      Int ,
        s_q_id Int ,
        s_e_id Int,
        PRIMARY KEY (s_id )
)ENGINE=InnoDB;

ALTER TABLE question ADD CONSTRAINT FK_question_t_id FOREIGN KEY (q_t_id) REFERENCES theme(t_id);
ALTER TABLE choix ADD CONSTRAINT FK_choix_q_id FOREIGN KEY (c_q_id) REFERENCES question(q_id);
ALTER TABLE score ADD CONSTRAINT FK_score_q_id FOREIGN KEY (s_q_id) REFERENCES question(q_id);
ALTER TABLE score ADD CONSTRAINT FK_score_e_id FOREIGN KEY (s_e_id) REFERENCES etudiant(e_id);


INSERT INTO etudiant (e_nom,e_prenom) VALUES ('GARNIER','Romain');
INSERT INTO etudiant (e_nom,e_prenom) VALUES ('ROGE','Damien');
INSERT INTO etudiant (e_nom,e_prenom) VALUES ('TRIPPONI','Lucas');
