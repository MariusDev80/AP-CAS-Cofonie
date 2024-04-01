CREATE TABLE USERS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(55) DEFAULT NULL,
  password VARCHAR(50) DEFAULT NULL,
  role INT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table users
--

INSERT INTO USERS (username, password, role) VALUES
('marius', '98fbcccdc2e8ddcda2c45c422111531d', 1),
('nolan', '14d54cbd95b45292736ee3e4cb2ed925', 2),
('teddy', 'e148cf6f0815f1daecaea692f9cf5fc3', 3),
('leopold', '20c1592bea0b2000bf4ef1fe1463117a', 4),
('admin', '21232f297a57a5a743894a0e4a801fc3', 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table users
--
ALTER TABLE USERS
  ADD PRIMARY KEY (id);
COMMIT;

create table newspratique(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre varchar(255),
    contenu text
    );
create table newsjuridique(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre varchar(255),
    contenu text
    )

INSERT INTO newspratique (titre, contenu) VALUES ('Étude : Consommation de Fruits et Légumes et Risque Cardiaque', 'Une nouvelle étude menée par des chercheurs de l''Université de Médecine de Stanford met en lumière l''importance de la consommation régulière de fruits et légumes dans la prévention des maladies cardiaques. Les résultats, publiés dans le Journal of Cardiology, montrent que les personnes qui intègrent une quantité adéquate de fruits et légumes dans leur alimentation ont un risque réduit de développer des problèmes cardiovasculaires. L''étude, menée sur une période de cinq ans et impliquant plus de 10 000 participants, a révélé une corrélation significative entre la consommation de fruits et légumes et la santé cardiaque. Les personnes qui consommaient au moins cinq portions de fruits et légumes par jour présentaient un risque de maladies cardiaques réduit de 25 % par rapport à celles qui en consommaient moins. Le Dr. Sarah Johnson, cardiologue et co-auteur de l''étude, commente : "Nos résultats soulignent l''importance d''une alimentation équilibrée, riche en fruits et légumes, pour maintenir la santé cardiovasculaire. Les nutriments présents dans ces aliments, tels que les fibres, les vitamines et les antioxydants, jouent un rôle crucial dans la protection contre les maladies cardiaques." Ces conclusions renforcent les recommandations déjà établies par les experts en nutrition et en santé publique, qui encouragent une augmentation de la consommation de fruits et légumes dans la population générale. En incorporant davantage de ces aliments dans leur alimentation quotidienne, les individus peuvent non seulement améliorer leur santé cardiaque, mais aussi réduire leur risque de développer d''autres problèmes de santé chroniques. Alors que les chercheurs continuent d''explorer les liens entre l''alimentation et la santé, cette étude apporte un éclairage précieux sur les habitudes alimentaires qui favorisent la santé cardiovasculaire à long terme.');

INSERT INTO newsjuridique (titre, contenu) VALUES
('Une Nouvelle Loi Proposée Vise à Renforcer la Protection des Données Personnelles en Ligne', 'Une proposition de loi déposée aujourd''hui au Parlement vise à accroître la protection des données personnelles des citoyens sur Internet. Cet effort législatif intervient dans un contexte où les préoccupations concernant la confidentialité en ligne et la sécurité des données sont de plus en plus présentes.  Le projet de loi, intitulé "Loi sur la Protection des Données Numériques", prévoit plusieurs mesures destinées à renforcer les droits des individus en matière de confidentialité et de sécurité des données. Parmi les principales dispositions figurent l''obligation pour les entreprises de fournir des informations claires et transparentes sur la manière dont elles collectent, utilisent et stockent les données personnelles des utilisateurs.  En outre, la proposition de loi propose de donner aux individus un plus grand contrôle sur leurs données en ligne, notamment en leur permettant d''accéder facilement à leurs informations personnelles, de les corriger et même de les supprimer si nécessaire. Elle impose également des sanctions plus sévères aux entreprises qui enfreignent les règles en matière de protection des données, afin de dissuader les pratiques abusives.  Le député John Smith, principal architecte de la loi, a souligné l''importance de garantir la confidentialité des données à l''ère numérique. Il a déclaré : "À une époque où nos vies sont de plus en plus numérisées, il est essentiel que nous protégions efficacement les informations personnelles des individus. Cette proposition de loi vise à mettre en place des mesures robustes pour garantir que les citoyens ont un contrôle total sur leurs données et que leur vie privée est respectée."  La proposition de loi suscite déjà un débat animé parmi les législateurs, les défenseurs de la vie privée et les représentants de l''industrie technologique. Certains saluent l''initiative comme un pas important vers une meilleure protection des droits des consommateurs, tandis que d''autres expriment des préoccupations quant à son impact potentiel sur l''innovation et la compétitivité des entreprises.  La discussion autour de cette proposition de loi promet d''être animée dans les semaines à venir, alors que les législateurs cherchent à trouver un équilibre entre la protection de la vie privée des individus et les besoins légitimes des entreprises dans l''économie numérique en évolution rapide.');