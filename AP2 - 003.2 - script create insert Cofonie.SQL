DROP DATABASE IF EXISTS COFONIE;

CREATE DATABASE IF NOT EXISTS COFONIE;
USE COFONIE;

# -----------------------------------------------------------------------------
#       TABLE : TYPE_INSTITUTION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TYPEINSTITUTION
 (
   idTypeInstitution int NOT NULL AUTO_INCREMENT ,
   libelleTypeInstitution CHAR(32) NULL  ,
   constraint pk_typeInstitution PRIMARY KEY (idTypeInstitution) 
    ) ENGINE = INNODB;

    insert into typeInstitution values (1,'executif');
    insert into typeInstitution values (2,'legislatif');
    insert into typeInstitution values (3,'judiciaire');
    insert into typeInstitution values (4,'pas de pouvoir');



# -----------------------------------------------------------------------------
#       TABLE : INSTITUTION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INSTITUTION
 (
   idInstitution int NOT NULL AUTO_INCREMENT ,
   libelleInstitution CHAR(32) NULL , 
   constraint pk_institution PRIMARY KEY (idInstitution) 
  ) ENGINE = INNODB;



     insert into institution values (1,'President');
     insert into institution values (2,'Gouvernement');
     insert into institution values (3,'Parlement');
     insert into institution values (4,'Conseil constitutionnel');
     insert into institution values (5,'Juges');

# -----------------------------------------------------------------------------
#       TABLE : ROLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ROLEINSTITUTION
 (
   idRole int NOT NULL  AUTO_INCREMENT,
   idInstitution int NOT NULL  ,
   libelleRole CHAR(150) NULL  , 
   constraint pk_roleInstitution PRIMARY KEY (idRole) ,
   constraint fk_roleInstitution_institution FOREIGN KEY (idInstitution) REFERENCES INSTITUTION (idInstitution)
 ) ENGINE = INNODB;
 


 insert into ROLEINSTITUTION values (1, 1,"Dissoudre l'assemblée");
 insert into ROLEINSTITUTION values (2,1,'Recourir au référendum');
 insert into ROLEINSTITUTION values (3,1, 'Promulguer des lois');
 insert into ROLEINSTITUTION values (4,1,'Exercer les plien pouvoirs en cas de crise');
 insert into ROLEINSTITUTION values (5,1, 'Négocier des traités');

 insert into ROLEINSTITUTION values (6, 2, 'Défini la politique de la nation');
 insert into ROLEINSTITUTION values (7, 2, 'Conduit la politique de la nation');

 insert into ROLEINSTITUTION values (8, 3, "Vote les lois dans le domaine énuméré par l'article 34 de la constitution");

 insert into ROLEINSTITUTION values (9, 4 ,'Chargé de vérifier que les lois adoptées par le parlement respectent la constitution');

 insert into ROLEINSTITUTION values (10, 5, 'Pouvoir de sanctionner');


# -----------------------------------------------------------------------------
#       TABLE : APPARTENIR (ici nous aovns la talbe appartenir car une institution n appartient à aucun type or une clé étrangère ne peut etre null)
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS APPARTENIR
 (
   idInstitution int NOT NULL ,
   idTypeInstitution int not NULL  ,
   constraint pk_institution PRIMARY KEY (idInstitution, idTypeInstitution) ,
    constraint fk_institution_Institution FOREIGN KEY (idInstitution) REFERENCES INSTITUTION (idInstitution) ,
   constraint fk_institution_typeInstitution FOREIGN KEY (idTypeInstitution) REFERENCES TYPEINSTITUTION (idTypeInstitution) 

 ) ENGINE = INNODB;

 insert into APPARTENIR values (1,1);
 insert into APPARTENIR values (2,1);
 insert into APPARTENIR values (3,2);
 insert into APPARTENIR values (5,3);

# -----------------------------------------------------------------------------
#       TABLE : ORGANES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ORGANE
 (
   idOrgane int NOT NULL  AUTO_INCREMENT,
   libOrgane CHAR(32) NULL  ,
  nbrPersonnesOrgane int NULL  , 
   CONSTRAINT PK_ORGANES PRIMARY KEY (idOrgane) 
 ) ENGINE = INNODB;

 insert into ORGANE values (1,'Assemblée nationale', 577);
 insert into ORGANE values (2,'Sénat', 321);

 # -----------------------------------------------------------------------------
#       TABLE : COMPRENDRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPRENDRE
 (
   idInstitution int NOT NULL  ,
   idOrgane int NOT NULL  , 
   constraint pk_comprendre PRIMARY KEY (idInstitution,idOrgane) ,
   constraint fk_comprendre_institution FOREIGN KEY (idInstitution) REFERENCES INSTITUTION (idInstitution),
   constraint fk_comprendre_organe FOREIGN KEY (idOrgane) REFERENCES ORGANE (idOrgane)
 ) ENGINE = INNODB;
 
insert into COMPRENDRE values (3,1);
insert into COMPRENDRE values (3,2);

# -----------------------------------------------------------------------------
#       TABLE : TEXTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TEXTE
 (
   idTexte int NOT NULL AUTO_INCREMENT ,
   idInstitution int NOT NULL  ,
   titreTexte CHAR(32) NULL  ,
   promulgationTexte boolean NULL  , -- 1 etant true et 0 false
   constraint pk_texte PRIMARY KEY (idTexte) ,
   constraint fk_texte_institution FOREIGN KEY (idInstitution) REFERENCES INSTITUTION (idInstitution) 
 ) ENGINE = INNODB;

insert into TEXTE values (1, 2, 'Texte Loi 1', 1);
insert into TEXTE values (2, 2, 'Texte Loi 2', 1);

insert into TEXTE values (3, 3, 'Texte Loi 3', 0);
insert into TEXTE values (4, 3, 'Texte Loi 4', 1);


# -----------------------------------------------------------------------------
#       TABLE : ARTICLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ARTICLE
 (
   idTexte int NOT NULL  ,
   codeSeqArticle int NOT NULL  ,
   titreArticle CHAR(32) NULL  ,
   texteArticle CHAR(255) NULL  ,
   constraint pk_article PRIMARY KEY (idTexte,codeSeqArticle) ,
   constraint fk_article_texte FOREIGN KEY (idTexte) REFERENCES TEXTE (idtexte)
 ) ENGINE = INNODB;


insert into ARTICLE values (1, 1, 'Article 1.1', "Détail de l'article 1.1");
insert into ARTICLE values (1, 2, 'Article 1.2', "Détail de l'article 1.2");
insert into ARTICLE values (1, 3, 'Article 1.3', "Détail de l'article 1.3");

insert into ARTICLE values (2, 1, 'Article 2.1', "Détail de l'article 2.1");
insert into ARTICLE values (2, 2, 'Article 2.2', "Détail de l'article 2.2");
insert into ARTICLE values (2, 3, 'Article 2.3', "Détail de l'article 2.3");
insert into ARTICLE values (2, 4, 'Article 2.4', "Détail de l'article 2.4");

insert into ARTICLE values (3, 1, 'Article 3.1', "Détail de l'article 3.1");
insert into ARTICLE values (3, 2, 'Article 3.2', "Détail de l'article 3.2");

insert into ARTICLE values (4, 1, 'Article 4.1', "Détail de l'article 4.1");
insert into ARTICLE values (4, 2, 'Article 4.2', "Détail de l'article 4.2");
insert into ARTICLE values (4, 3, 'Article 4.3', "Détail de l'article 4.3");



# -----------------------------------------------------------------------------
#       TABLE : AMENDEMENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AMENDEMENT
 (
   idTexte int NOT NULL  ,
   codeSeqArticle int NOT NULL  ,
   codeSeqAmendement int NOT NULL  ,
   libelleAmendement CHAR(32) NULL  ,
   textAmendement CHAR(255) NULL  ,
   dateAmendement DATE NULL  , 
   constraint pk_amendement PRIMARY KEY (idTexte,codeSeqArticle,codeSeqAmendement) ,
   constraint fk_amendement_article FOREIGN KEY (idTexte,codeSeqArticle) REFERENCES ARTICLE (idTexte,codeSeqArticle) 
 ) ENGINE = INNODB;




insert into AMENDEMENT values (1, 1, 1, "Amendement 1 de l'article 1.1", "Détail de l'amendement 1 de l'article 1.1", '2019-01-01');
insert into AMENDEMENT values (1, 1, 2, "Amendement 2 de l'article 1.1", "Détail de l'amendement 2 de l'article 1.1", '2022-01-01');
insert into AMENDEMENT values (1, 2, 1, "Amendement 1 de l'article 1.2", "Détail de l'amendement 1 de l'article 1.2", '2020-06-01');
insert into AMENDEMENT values (1, 2, 2, "Amendement 2 de l'article 1.2", "Détail de l'amendement 2 de l'article 1.2", '2020-07-01');
insert into AMENDEMENT values (1, 2, 3, "Amendement 3 de l'article 1.2", "Détail de l'amendement 1 de l'article 1.2", '2020-08-01');
insert into AMENDEMENT values (1, 3, 1, "Amendement 1 de l'article 1.3", "Détail de l'amendement 1 de l'article 1.3", '2023-09-01');

insert into AMENDEMENT values (2, 1, 1, "Amendement 1 de l'article 2.1", "Détail de l'amendement 1 de l'article 2.1", '2020-01-01');
insert into AMENDEMENT values (2, 1, 2, "Amendement 2 de l'article 2.1", "Détail de l'amendement 2 de l'article 2.1", '2020-02-01');
insert into AMENDEMENT values (2, 2, 1, "Amendement 1 de l'article 2.2", "Détail de l'amendement 1 de l'article 2.2", '2020-03-01');
insert into AMENDEMENT values (2, 3, 1, "Amendement 1 de l'article 2.3", "Détail de l'amendement 1 de l'article 2.3", '2020-04-01');
insert into AMENDEMENT values (2, 3, 2, "Amendement 2 de l'article 2.3", "Détail de l'amendement 2 de l'article 2.3", '2020-08-01');
insert into AMENDEMENT values (2, 3, 3, "Amendement 3 de l'article 2.3", "Détail de l'amendement 3 de l'article 2.3", '2023-09-01');
insert into AMENDEMENT values (2, 4, 1, "Amendement 1 de l'article 2.4", "Détail de l'amendement 1 de l'article 2.4", '2023-10-01');

insert into AMENDEMENT values (2, 4, 2, "Amendement 2 de l'article 2.4", "Détail de l'amendement 1 de l'article 2.4", '2023-11-01');
insert into AMENDEMENT values (3, 1, 1, "Amendement 1 de l'article 3.1", "Détail de l'amendement 1 de l'article 3.1", '2020-01-01');
insert into AMENDEMENT values (3, 1, 2, "Amendement 2 de l'article 3.1", "Détail de l'amendement 2 de l'article 3.1", '2020-02-01');

insert into AMENDEMENT values (4, 1, 1, "Amendement 1 de l'article 4.1", "Détail de l'amendement 1 de l'article 4.1", '2023-02-01');
insert into AMENDEMENT values (4, 1, 2, "Amendement 2 de l'article 4.1", "Détail de l'amendement 2 de l'article 4.1", '2023-03-01');
insert into AMENDEMENT values (4, 2, 1, "Amendement 1 de l'article 4.2", "Détail de l'amendement 1 de l'article 4.2", '2023-04-01');
insert into AMENDEMENT values (4, 2, 2, "Amendement 2 de l'article 4.2", "Détail de l'amendement 2 de l'article 4.2", '2023-08-01');
insert into AMENDEMENT values (4, 2, 3, "Amendement 3 de l'article 4.2", "Détail de l'amendement 3 de l'article 4.2", '2023-09-01');
insert into AMENDEMENT values (4, 3, 1, "Amendement 1 de l'article 4.3", "Détail de l'amendement 1 de l'article 4.3", '2023-10-01');
insert into AMENDEMENT values (4, 3, 2, "Amendement 2 de l'article 4.3", "Détail de l'amendement 1 de l'article 4.3", '2023-11-01');


# -----------------------------------------------------------------------------
#       TABLE : FAIREREFERENCE (reflexive)
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FAIREREFERENCE
 (
   idTexte1 int NOT NULL  ,
   codeSeqArticle1 int NOT NULL  ,
   idTexte2 int NOT NULL  ,
   codeSeqArticle2 int NOT NULL  ,
   constraint pk_faireReference PRIMARY KEY (idTexte1,codeSeqArticle1,idtexte2,codeSeqArticle2) ,
   constraint fk_fairereference_article1 FOREIGN KEY (idTexte1,codeSeqArticle1) REFERENCES ARTICLE (idTexte,codeSeqArticle),
   constraint fk_fairereference_article2 FOREIGN KEY (idTexte2,codeSeqArticle2) REFERENCES ARTICLE (idTexte,codeSeqArticle)
   )ENGINE = INNODB ;


insert into FAIREREFERENCE values (1,1,1,3);
insert into FAIREREFERENCE values (1,1,2,1);
insert into FAIREREFERENCE values (1,2,3,1);
insert into FAIREREFERENCE values (4,1,2,4);

# -----------------------------------------------------------------------------
#       TABLE : VOTER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VOTER
 (
   idTexte int NOT NULL ,
   codeSeqArticle int NOT NULL ,
   jourVote date NOT NULL ,
   idOrgane int NOT NULL ,
   nbrVoixPour int NULL ,
   nbrVoixContre int NULL , 
   propositionAmendement boolean NOT NULL,
   constraint pk_voter PRIMARY KEY (idTexte,codeSeqArticle,jourVote,idOrgane) ,
   constraint fk_voter_article FOREIGN KEY (idTexte,codeSeqArticle) REFERENCES ARTICLE (idTexte,codeSeqArticle),
   constraint fk_voter_organe FOREIGN KEY (idOrgane) REFERENCES ORGANE (idOrgane)
 )ENGINE = INNODB ;


insert into voter values(1,1,'2019-01-01',1,388,112,1);
insert into voter values(1,1,'2022-01-01',1,225,275,1);
insert into voter values(1,2,'2020-06-01',2,9,491,1);
insert into voter values(1,2,'2020-07-01',2,8,492,1);
insert into voter values(1,2,'2020-08-01',1,346,154,1);
insert into voter values(1,3,'2023-09-01',2,372,128,1);
insert into voter values(2,1,'2020-01-01',1,61,439,1);
insert into voter values(2,1,'2020-02-01',1,212,288,1);
insert into voter values(2,2,'2020-03-01',1,111,389,1);
insert into voter values(2,3,'2020-04-01',2,222,278,1);
insert into voter values(2,3,'2020-08-01',2,253,247,1);
insert into voter values(2,3,'2020-09-01',1,129,371,1);
insert into voter values(2,4,'2023-10-01',1,367,133,1);
insert into voter values(2,4,'2023-11-01',2,84,416,1);
insert into voter values(3,1,'2023-01-01',2,354,146,1);
insert into voter values(3,1,'2020-02-01',2,324,176,1);
insert into voter values(4,1,'2020-02-01',1,444,56,1);
insert into voter values(4,1,'2023-03-01',2,76,424,1);
insert into voter values(4,2,'2023-04-01',1,427,73,1);
insert into voter values(4,2,'2023-08-01',1,407,93,1);
insert into voter values(4,2,'2023-09-01',2,296,204,1);
insert into voter values(4,3,'2023-10-01',2,446,54,1);
insert into voter values(4,3,'2023-11-01',2,205,295,1);

CREATE TABLE IF NOT EXISTS USERS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(55) DEFAULT NULL,
  password VARCHAR(50) DEFAULT NULL,
  role INT DEFAULT NULL
) ENGINE=INNODB;

ALTER TABLE USERS ADD PRIMARY KEY (id);

INSERT INTO USERS (username, password, role) VALUES
('marius', '98fbcccdc2e8ddcda2c45c422111531d', 1),
('nolan', '14d54cbd95b45292736ee3e4cb2ed925', 2),
('teddy', 'e148cf6f0815f1daecaea692f9cf5fc3', 3),
('leopold', '20c1592bea0b2000bf4ef1fe1463117a', 4),
('admin', '21232f297a57a5a743894a0e4a801fc3', 10);


