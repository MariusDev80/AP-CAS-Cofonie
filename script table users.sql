CREATE TABLE USERS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(55) DEFAULT NULL,
  password VARCHAR(50) DEFAULT NULL,
  role INT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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