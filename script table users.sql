CREATE TABLE users (
  id int(11) NOT NULL,
  username varchar(55) DEFAULT NULL,
  password varchar(50) DEFAULT NULL,
  role int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table users
--

INSERT INTO users (id, username, password, role) VALUES
(1, 'marius', '98fbcccdc2e8ddcda2c45c422111531d', 1),
(2, 'nolan', '14d54cbd95b45292736ee3e4cb2ed925', 2),
(3, 'teddy', 'e148cf6f0815f1daecaea692f9cf5fc3', 3),
(4, 'leopold', '20c1592bea0b2000bf4ef1fe1463117a', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table users
--
ALTER TABLE users
  ADD PRIMARY KEY (id);
COMMIT;