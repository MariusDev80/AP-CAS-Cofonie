<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php
$username = htmlspecialchars($_POST['username']); //htmlspecialchars permet d'éviter de mettre des caractères spéciaux et permet d'éviter les attques sql
$password = htmlspecialchars($_POST['password']);

// Hachage du mot de passe avec MD5
$hashed_password = md5($password);

// Création de l'objet de connexion à la base de données
$accesBD = new accesBD();

// Requête SQL pour récupérer l'utilisateur et le rôle
$req = $accesBD->getConn()->prepare('SELECT username, role FROM users WHERE username = :username AND password = :password');
$req->execute(
	array(
		'username' => $username,
		'password' => $hashed_password
	)
);

// Récupération du résultat
$userInfo = $req->fetch(PDO::FETCH_ASSOC);

// Vérification du résultat
if ($userInfo) {
	$role = $userInfo['role'];

	// Stocker le rôle dans une variable de session
	session_start();
	$_SESSION['role'] = $role;

	// Redirection vers menu-user.php
	header("Location: ../menu-user.php");
	exit();
} else {
	echo '<center style="color:#FF0000">Identifiant ou mot de passe incorrect <br></center>';
	echo '<center><a href="../index.php"><button type="button" class="btn btn-primary">Retour a la page de connexion</button></a><center>';
}
// Fermeture de la requête
$req->closeCursor();


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
		$this->hote = "localhost";
		$this->login = "root";
		$this->passwd = "";
		$this->base = "cofonie";
		$this->connexion();
	}

	private function connexion()
	{
		try {
			$this->conn = new PDO("mysql:host=" . $this->hote . ";dbname=" . $this->base . ";charset=utf8", $this->login, $this->passwd);
			//$this->boolConnexion = true;
		} catch (PDOException $e) {
			die("Connection à la base de données échouée" . $e->getMessage());
		}
	}

	public function getConn()
	{
		return $this->conn;
	}

	public function insererUnVehicule($unCodeVoiture, $uneCouleurVoiture, $unNombrePlaceVoiture)
	{
		$sonCodeVoiture = $this->donneProchainIdentifiant("VOITURE", "code");
		$requete = $this->conn->prepare("INSERT INTO voiture (code,couleur,nbrPlace) VALUES (?,?,?)");
		$requete->bindValue(1, $unCodeVoiture);
		$requete->bindValue(2, $uneCouleurVoiture);
		$requete->bindValue(3, $unNombrePlaceVoiture);
		if (!$requete->execute()) {
			die("Erreur dans insert Voiture : " . $requete->errorCode());
		}
		return $sonCodeVoiture;
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
			case 'VOITURE':
				$stringQuery .= 'voiture'; // concatenation de stringQuery et 'voiture'
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