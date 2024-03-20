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
		$this->passwd="";
		$this->base="cofonie";
		$this->connexion();
		}

	private function connexion()
	{
		try
        {
            $this->conn = new PDO("mysql:host=".$this->hote.";dbname=".$this->base.";charset=utf8", $this->login, $this->passwd);
            //$this->boolConnexion = true;
        }
        catch(PDOException $e)
        {
            die("Connection à la base de données échouée".$e->getMessage());
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
	public function insererUnRole($idRole,$idInstitution,$libelleRole)
	{
		$sonRole = $this->donneProchainIdentifiant("ROLEINSTITUTION","code");
		$requete = $this->conn->prepare("INSERT INTO roleInstitution (idRole,idInstitution,libelleRole) VALUES (?,?,?)");
		$requete->bindValue(1,$idRole);
		$requete->bindValue(2,$idInstitution);
		$requete->bindValue(3,$libelleRole);
		if(!$requete->execute())
		{
			die("Erreur dans insert Cofonie : ".$requete->errorCode());
		}
		return $sonRole;
	}
	public function insererUneInstitution($idInstitution, $libelleInstitution)
	{
		$sonInstitution = $this->donneProchainIdentifiant("INSTITUTION", "code");
		$requete = $this->conn->prepare("INSERT INTO institution (idInstitution,libelleInstitution) VALUES (?,?)");
		$requete->bindValue(1,$idInstitution);
		$requete->bindValue(2,$libelleInstitution);
		if(!$requete->execute())
		{
			die("Erreur dans insert Cofonie : ".$requete->errorCode());
		}
		return $sonInstitution;
	}
	
	/***********************************************************************************************
	C'est la fonction qui permet de charger les tables et de les mettre dans un tableau 2 dimensions. La petite fontions specialCase permet juste de psser des minuscules aux majuscules pour les noms des tables de la base de données
	************************************************************************************************/
	public function chargement($uneTable)
	{
		$lesInfos=null;
		$nbTuples=0;
		$stringQuery="SELECT * FROM ";
		$stringQuery = $this->specialCase($stringQuery,$uneTable);
		$query = $this->conn->prepare($stringQuery);
		if($query->execute())
		{
			while($row = $query->fetch(PDO::FETCH_NUM))
			{
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
			}
		}
		else
		{
			die('Problème dans chargement : '.$query->errorCode());
		}
		return $lesInfos;
	}

	private function specialCase($stringQuery,$uneTable)
	{
			$uneTable = strtoupper($uneTable);
			switch ($uneTable) {

			case 'ROLEINSTITUTION':
				$stringQuery.='roleinstitution';
				break;
			case 'INSTITUTION':
				$stringQuery.='institution';
        		break;
			case 'TYPEINSTITUTION':
				$stringQuery.='typeinstitution'; // concatenation de stringQuery et 'voiture'
				break;
			case 'AMENDEMENT':
				$stringQuery.='amendement';
				break;
			case 'ORGANE':
				$stringQuery.='organe';
				break;
			case 'ARTICLE':
				$stringQuery.='article';
				break;
			case 'TEXTE':
				$stringQuery.='texte';
				break;
			case 'FAIREREFERENCE':
				$stringQuery.='fairereference';
				break;
			default:
				die('Pas une table valide');
				break;	
			}

			return $stringQuery.";";
	}
	
	/**************************************************************************
	fonction qui permet d'avoir le prochain identifiant de la table. Elle est là uniquement parce que nous n'avons pas d'autoincremente dans notre base de données
	***************************************************************************/
	public function donneProchainIdentifiant($uneTable)
	{
		$stringQuery = $this->specialCase("SELECT * FROM ",$uneTable);
		$requete = $this->conn->prepare($stringQuery);
		//$requete->bindValue(1,$unIdentifiant);

		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
				$nb = $row[0];
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur donneProchainIdentifiant : '+$requete->errorCode());
		}
	}
	
	
		
}