<?php
class accesBD
{
	private $hote;
	private $login;
	private $passwd;
	private $base;
	private $conn;

	// Nous construisons notre connexion
	public function __construct()
	{
		$this->hote="localhost";
		$this->login="root";
		$this->passwd="root";
		$this->base="cofonie";
		$this->connexion();
	}

	private function connexion()
	{
		try {
			$this->conn = new PDO("mysql:host=" . $this->hote . ";dbname=" . $this->base . ";charset=utf8", $this->login, $this->passwd);

		} catch (PDOException $e) {
			die("Connection à la base de données échouée" . $e->getMessage());
		}
	}

	public function __get($attribut){
		switch($attribut){
			case "conn":
				return $this->conn;
				break;
		}
	}

	public function insererUnOrgane($idOrgane,$nomOrgane,$nbPersonne)
	{
		$sonOrgane = $this->donneProchainIdentifiant("ORGANE","code");
		$requete = $this->conn->prepare("INSERT INTO organe (idOrgane,libOrgane,nbrPersonnesOrgane) VALUES (?,?,?)");
		$requete->bindValue(1,$idOrgane);
		$requete->bindValue(2,$nomOrgane);
		$requete->bindValue(3,$nbPersonne);
		if(!$requete->execute())
		{
			die("Erreur dans insert Cofonie : ".$requete->errorCode());
		}
		return $sonOrgane;
	}
	
	public function insererUnRole($idRole, $idInstitution, $libelleRole)
	{
		$sonRole = $this->donneProchainIdentifiant("ROLEINSTITUTION", "code");
		$requete = $this->conn->prepare("INSERT INTO roleInstitution (idRole,idInstitution,libelleRole) VALUES (?,?,?)");
		$requete->bindValue(1, $idRole);
		$requete->bindValue(2, $idInstitution);
		$requete->bindValue(3, $libelleRole);
		if (!$requete->execute()) {
			die("Erreur dans insert Cofonie : " . $requete->errorCode());
		}
		return $sonRole;
	}
	public function insererUneInstitution($idInstitution, $libelleInstitution)
	{
		$sonInstitution = $this->donneProchainIdentifiant("INSTITUTION", "code");
		$requete = $this->conn->prepare("INSERT INTO institution (idInstitution,libelleInstitution) VALUES (?,?)");
		$requete->bindValue(1, $idInstitution);
		$requete->bindValue(2, $libelleInstitution);
		if (!$requete->execute()) {
			die("Erreur dans insert Cofonie : " . $requete->errorCode());
		}
		return $sonInstitution;
	}

	public function insererUnUtilisateur($username, $password_hash, $role)
    {
        $requete = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $requete->bindValue(1, $username);
        $requete->bindValue(2, $password_hash);
        $requete->bindValue(3, $role);

        if (!$requete->execute()) {
            die("Erreur dans l'insertion d'un utilisateur : " . $requete->errorCode());
        }
	}

	public function insererUnTexte($idTexte,$idInstitution,$titreTexte)
    {
        $requete = $this->conn->prepare("INSERT INTO texte (idTexte, idInstitution, titreTexte,promulgationTexte) VALUES (?, ?, ?, ?)");
        $requete->bindValue(1, $idTexte);
        $requete->bindValue(2, $idInstitution);
        $requete->bindValue(3, $titreTexte);
		$requete->bindValue(4, 0);

        if (!$requete->execute()) {
            die("Erreur dans l'insertion d'un utilisateur : " . $requete->errorCode());
        }
	}

	public function insererUnArticle($idTexte,$idArticle,$titreArticle,$texteArticle)
    {
        $requete = $this->conn->prepare("INSERT INTO article (idTexte, codeSeqArticle, titreArticle,texteArticle) VALUES (?, ?, ?, ?)");
        $requete->bindValue(1, $idTexte);
        $requete->bindValue(2, $idArticle);
        $requete->bindValue(3, $titreArticle);
		$requete->bindValue(4, $texteArticle);

        if (!$requete->execute()) {
            die("Erreur dans l'insertion d'un utilisateur : " . $requete->errorCode());
        }
	}

	public function annulerAjout($idTexte){

		$this->conn->query("DELETE FROM article where idTexte = $idTexte");
		$this->conn->query("DELETE FROM texte where idTexte = $idTexte");
		echo '<h3 style="text-align:center; margin:5%;">L\'ajout a bien été annulé</h3>';

	}



	/***********************************************************************************************
									 C'est la fonction qui permet de charger les tables et de les mettre dans un tableau 2 dimensions. La petite fontions specialCase permet juste de psser des minuscules aux majuscules pour les noms des tables de la base de données
		  ************************************************************************************************/
	public function chargement($uneTable)
	{
		$lesInfos = null;
		$nbTuples = 0;
		$stringQuery = "SELECT * FROM ";
		$stringQuery = $this->specialCase($stringQuery, $uneTable);
		$query = $this->conn->prepare($stringQuery);
		if ($query->execute()) {
			while ($row = $query->fetch(PDO::FETCH_NUM)) {
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
			}
		} else {
			die('Problème dans chargement : ' . $query->errorCode());
		}
		return $lesInfos;
	}

	private function specialCase($stringQuery, $uneTable)
	{
		$uneTable = strtoupper($uneTable);
		switch ($uneTable) {

			case 'ROLEINSTITUTION':
				$stringQuery .= 'roleinstitution';
				break;
			case 'INSTITUTION':
				$stringQuery .= 'institution';
				break;
			case 'TYPEINSTITUTION':
				$stringQuery .= 'typeinstitution'; // concatenation de stringQuery et 'voiture'
				break;
			case 'AMENDEMENT':
				$stringQuery .= 'amendement';
				break;
			case 'ORGANE':
				$stringQuery.='organe';
				break;
			case 'ARTICLE':
				$stringQuery .= 'article';
				break;
			case 'TEXTE':
				$stringQuery .= 'texte';
				break;
			case 'FAIREREFERENCE':
				$stringQuery .= 'fairereference';
				break;
			case 'USERS';
				$stringQuery .= 'users';
				break;
			case 'VOTER':
				$stringQuery.='voter';
				break;
			default:
				die('Pas une table valide');
				break;
		}

		return $stringQuery . ";";
	}

	/**************************************************************************
									 fonction qui permet d'avoir le prochain identifiant de la table. Elle est là uniquement parce que nous n'avons pas d'autoincremente dans notre base de données
									 ***************************************************************************/
	public function donneProchainIdentifiant($uneTable)
	{
		$stringQuery = $this->specialCase("SELECT * FROM ", $uneTable);
		$requete = $this->conn->prepare($stringQuery);
		//$requete->bindValue(1,$unIdentifiant);

		if ($requete->execute()) {
			$nb = 0;
			while ($row = $requete->fetch(PDO::FETCH_NUM)) {
				$nb = $row[0];
			}
			return $nb + 1;
		} else {
			die('Erreur sur donneProchainIdentifiant : ' + $requete->errorCode());
		}
	}
}