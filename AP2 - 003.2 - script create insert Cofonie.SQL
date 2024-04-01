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
   texteArtitcle CHAR(255) NULL  ,
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

CREATE TABLE USERS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(55) DEFAULT NULL,
  password VARCHAR(50) DEFAULT NULL,
  role INT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table newspratique(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre varchar(255),
    contenu text
    );
create table newsjuridique(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre varchar(255),
    contenu text
    );

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

INSERT INTO USERS (username, password, role) VALUES
('marius', '98fbcccdc2e8ddcda2c45c422111531d', 1),
('nolan', '14d54cbd95b45292736ee3e4cb2ed925', 2),
('teddy', 'e148cf6f0815f1daecaea692f9cf5fc3', 3),
('leopold', '20c1592bea0b2000bf4ef1fe1463117a', 4),
('admin', '21232f297a57a5a743894a0e4a801fc3', 10);


INSERT INTO newspratique (titre, contenu) VALUES ('Étude : Consommation de Fruits et Légumes et Risque Cardiaque', 'Une nouvelle étude menée par des chercheurs de l''Université de Médecine de Stanford met en lumière l''importance de la consommation régulière de fruits et légumes dans la prévention des maladies cardiaques. Les résultats, publiés dans le Journal of Cardiology, montrent que les personnes qui intègrent une quantité adéquate de fruits et légumes dans leur alimentation ont un risque réduit de développer des problèmes cardiovasculaires. L''étude, menée sur une période de cinq ans et impliquant plus de 10 000 participants, a révélé une corrélation significative entre la consommation de fruits et légumes et la santé cardiaque. Les personnes qui consommaient au moins cinq portions de fruits et légumes par jour présentaient un risque de maladies cardiaques réduit de 25 % par rapport à celles qui en consommaient moins. Le Dr. Sarah Johnson, cardiologue et co-auteur de l''étude, commente : "Nos résultats soulignent l''importance d''une alimentation équilibrée, riche en fruits et légumes, pour maintenir la santé cardiovasculaire. Les nutriments présents dans ces aliments, tels que les fibres, les vitamines et les antioxydants, jouent un rôle crucial dans la protection contre les maladies cardiaques." Ces conclusions renforcent les recommandations déjà établies par les experts en nutrition et en santé publique, qui encouragent une augmentation de la consommation de fruits et légumes dans la population générale. En incorporant davantage de ces aliments dans leur alimentation quotidienne, les individus peuvent non seulement améliorer leur santé cardiaque, mais aussi réduire leur risque de développer d''autres problèmes de santé chroniques. Alors que les chercheurs continuent d''explorer les liens entre l''alimentation et la santé, cette étude apporte un éclairage précieux sur les habitudes alimentaires qui favorisent la santé cardiovasculaire à long terme.');

INSERT INTO newsjuridique (titre, contenu) VALUES
('Une Nouvelle Loi Proposée Vise à Renforcer la Protection des Données Personnelles en Ligne', 'Une proposition de loi déposée aujourd''hui au Parlement vise à accroître la protection des données personnelles des citoyens sur Internet. Cet effort législatif intervient dans un contexte où les préoccupations concernant la confidentialité en ligne et la sécurité des données sont de plus en plus présentes.  Le projet de loi, intitulé "Loi sur la Protection des Données Numériques", prévoit plusieurs mesures destinées à renforcer les droits des individus en matière de confidentialité et de sécurité des données. Parmi les principales dispositions figurent l''obligation pour les entreprises de fournir des informations claires et transparentes sur la manière dont elles collectent, utilisent et stockent les données personnelles des utilisateurs.  En outre, la proposition de loi propose de donner aux individus un plus grand contrôle sur leurs données en ligne, notamment en leur permettant d''accéder facilement à leurs informations personnelles, de les corriger et même de les supprimer si nécessaire. Elle impose également des sanctions plus sévères aux entreprises qui enfreignent les règles en matière de protection des données, afin de dissuader les pratiques abusives.  Le député John Smith, principal architecte de la loi, a souligné l''importance de garantir la confidentialité des données à l''ère numérique. Il a déclaré : "À une époque où nos vies sont de plus en plus numérisées, il est essentiel que nous protégions efficacement les informations personnelles des individus. Cette proposition de loi vise à mettre en place des mesures robustes pour garantir que les citoyens ont un contrôle total sur leurs données et que leur vie privée est respectée."  La proposition de loi suscite déjà un débat animé parmi les législateurs, les défenseurs de la vie privée et les représentants de l''industrie technologique. Certains saluent l''initiative comme un pas important vers une meilleure protection des droits des consommateurs, tandis que d''autres expriment des préoccupations quant à son impact potentiel sur l''innovation et la compétitivité des entreprises.  La discussion autour de cette proposition de loi promet d''être animée dans les semaines à venir, alors que les législateurs cherchent à trouver un équilibre entre la protection de la vie privée des individus et les besoins légitimes des entreprises dans l''économie numérique en évolution rapide.');