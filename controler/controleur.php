<?php

// include des vues a ajouter

use function PHPSTORM_META\type;

class controleur
{
    private $toutLesAmendements;
    private $toutLesArticles;
    private $toutLesOrganes;
    private $toutLesRoles;
    private $toutLesTextes;
    private $toutLesInstitutions;
    private $toutLesTypesInstitutions;
    private $refArticles;
    private $maBD;

public function __construct()
{
    $this->maBD = new accesBD();
    $this->toutLesRoles = new conteneurRole();
    $this->chargeLesRoles();
    $this->toutLesTypesInstitutions = new conteneurTypeInstitution();
    $this->chargeLesTypesInstitutions(); 
    $this->toutLesInstitutions = new conteneurInstitution();
    $this->chargeLesInstitutions();
    $this->toutLesAmendements = new conteneurAmendement();
    $this->chargeLesAmendements();
    $this->toutLesArticles = new conteneurArticle();
    $this->chargeLesArticles();
    $this->refArticles = new ArrayIterator();
    $this->chargeArtRef();
    $this->toutLesTextes = new conteneurTexte();
    $this->chargeLesTextes();

}

/*******************************************************************************

                    Affichage ENTETE et PIED de PAGE 
     ********************************************************************************/
    public function afficheEntete()
    {
        require 'entete.php';
    }

    public function affichePiedPage()
    {
        require 'piedPage.php';
    }

    /********************************************************************************
                Execution des differentes actions selon les vues

     *********************************************************************************/

    public function affichePage($action,$vue){

        if (isset($_GET['action']) && isset($_GET['vue'])){
                $action = $_GET['action'];
                $vue = $_GET['vue'];

                switch ($vue){
                    case "texte" : 
                        $this->actionTexte($action);
                        break;
                    case "institution" :
                        $this->actionInstitution($action);
                        break;
                    case "organe" :
                        $this->actionOrgane($action);
                        break;
                    case "role" :
                        $this->actionRole($action);
                        break;
                    case "typeInstitution" :
                        $this->actionTypeInstitution($action);
                        break;
                    case "vote":
                        $this->actionVote($action);
                        break;
                    case "deconnexion":
                      $this->deconnexion();
                      break;
                    case "connexion":
                      $this->connexion();
                      break;
                    case "signup":
                      $this->signup();
                      break;
                }
            }
        }
    

    public function deconnexion(){
        // Détruire la session
        session_destroy();
        header('Location: ../AP-CAS-COFONIE/index.php');
        // array_pop($_GET['action']);
        // array_pop($_GET['vue']);
    }

    public function signup(){
        $signupUsername = $_POST['signupUsername'];
        $signupPassword = $_POST['signupPassword'];
        $confirmPassword = $_POST['confirmPassword'];

    }

    public function connexion()
    {
        $username = htmlspecialchars($_POST['username']); //htmlspecialchars permet d'éviter de mettre des caractères spéciaux et permet d'éviter les attques sql
        $password = htmlspecialchars($_POST['password']);

        // Hachage du mot de passe avec MD5
        $hashed_password = md5($password);

        // Création de l'objet de connexion à la base de données
        $accesBD = $this->maBD;

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
            $_SESSION['role'] = $role;
        } else {
            echo '<center style="color:#FF0000">Identifiant ou mot de passe incorrect <br></center>';
            echo '<center><a href="../index.php"><button type="button" class="btn btn-primary">Retour a la page de connexion</button></a><center>';

        }
        // Fermeture de la requête
        $req->closeCursor();
    }

    public function actionVote($action){
        switch($action){
            case "voter":
                break;
            case "visualiser":
                $vue = new vueCentraleVote();
                $vue->choisirVote($this->toutLesTextes);
                break;
            
            case "visualiserVote":
                $texte = $_POST['texte'];
                $vue = new vueCentraleVote();
                foreach ($this->toutLesTextes->__get('lesTextes') as $unTexte){
                    if ($unTexte->__get('idTexte') == $texte){
                        $texteChoisi = $unTexte;
                    }
                }
                $vue->visualiserVote($texteChoisi); // ajouter le conteneurVote pour
                break;                                   // avoir le nombre de vote sur les articles
        }
    }

    public function actionOrgane($action){
        switch($action) {
            case 'ajouter' :
                $vue = new vueCentraleOrgane();
                $vue->ajouterOrgane();
                break;
            case 'saisirOrgane' :
                break;

            case 'visualiser' :
                $vue = new vueCentraleOrgane();
                $vue->visualiserOrgane();
                break;
        }
    }

    public function actionTypeInstitution($action) {
        switch ($action) {
            case "ajouter":
                $vue = new vueCentraleTypeInstitution();
                $vue->ajouterTypeInstitution();
                break;

            case "saisirTypeInstitution" :
                // break;

            case "visualiser":
                $liste=$this->toutLesTypesInstitutions->listeDesTypesInstitutions();
				$vue=new vueCentraleTypeInstitution();
				$vue->visualiserTypeInstitution($liste);
				break;
        }
    }

    public function actionTexte($action){
        switch ($action) {

            case "ajouter" :
                $vue = new vueCentraleTexte();
                $vue->ajouterTextes();
                break;
            case "saisirAmendement" :
                break;

            case "visualiser" :
                $textes = $this->toutLesTextes->__get('lesTextes');
                $vue = new vueCentraleTexte();
                $vue->visualiserTextes($textes,$this->toutLesArticles);
                break;
        }
    }

    public function actionInstitution($action){
        switch ($action) {
            case "ajouter" :
                $vue = new vueCentraleInstitution();
                $vue->ajouterInstitution($this->toutLesInstitutions->nbInstitution());
                break;
            case "saisirInstitution" :
                $idInstitution = $_POST['idInstitution'];
                $libelleInstitution = $_POST['libelleInstitution'];
                $this->toutLesInstitutions->ajouterUneInstitution($idInstitution, $libelleInstitution);
                $this->maBD->insererUneInstitution($idInstitution, $libelleInstitution);
                echo 'Rôle rajouté correctement';
                break;
            case "visualiser" :
                $listeInstitution = $this->toutLesInstitutions->listeDesInstitutions();
                $vue = new vueCentraleInstitution();
                $vue->visualiserInstitution($listeInstitution);
                break;
        }
    }
    public function actionRole($action){
        switch ($action) {
            
            case "ajouter" :
                $vue = new vueCentraleRole();
                // vue de l'ajout d'un role, a besoin du nombre de role et d'institutions ainsi que de la liste des institutions
                $vue->ajouterRole($this->toutLesRoles->nbRole(),$this->toutLesInstitutions->listeDesInstitutions(),$this->toutLesInstitutions->nbInstitution());
                break;
            case "saisirRole" :
                $idRole = $_POST['idRole'];
                $idInstitution = $_POST['idInstitution'];
                $choix = explode('-',$idInstitution);
                $libelleRole = $_POST['libelleRole'];
                $this->toutLesRoles->ajouterUnRole($idRole, $choix[0], $libelleRole);
                $this->maBD->insererUnRole($idRole, $idInstitution,$libelleRole);
                echo 'Rôle rajouté correctement';
                break;
            case "visualiser" :
                $listeRole = $this->toutLesRoles->listeDesRoles();
                $vue = new vueCentraleRole();
                $vue->visualiserRole($listeRole);
                break;
        }       
    }

/***********************************************************************************************************************
                                    CHARGEMENT DES TABLES DANS LES CONTENEURS
***********************************************************************************************************************/
    public function chargeLesInstitutions(){
        $resultatInstitutions=$this->maBD->chargement('institution');
        $nbE=0;
        while ($nbE<sizeof($resultatInstitutions))
			{
				$this->toutLesInstitutions->ajouterUneInstitution($resultatInstitutions[$nbE][0],$resultatInstitutions[$nbE][1]);
                
				$nbE++;
			}
    }
    public function chargeLesRoles()
		{   $resultatRoles=$this->maBD->chargement('roleinstitution');
			$nbE=0;
			while ($nbE<sizeof($resultatRoles))
			{
				$this->toutLesRoles->ajouterUnRole($resultatRoles[$nbE][0],$resultatRoles[$nbE][1],$resultatRoles[$nbE][2]);
                
				$nbE++;
			}
			
		}

    public function chargeLesTypesInstitutions() {
        // définir une variable résultat
        $resultatTypeInstitutions = $this->maBD->chargement("typeInstitution");
        $nbE=0;

        // parcourir la liste resultat pour prendre chaque elem et en faire un obj
        while ($nbE < sizeof($resultatTypeInstitutions)) {
            $this->toutLesTypesInstitutions->ajouterUnTypeInstitution($resultatTypeInstitutions[$nbE][0], $resultatTypeInstitutions[$nbE][1]);
            $nbE++;
        }
    }

    public function chargeLesAmendements(){
        $resultatAmendements = $this->maBD->chargement('amendement');
        $nbE = 0;
        while ($nbE < sizeof($resultatAmendements)) {
            $this->toutLesAmendements->ajouterUnAmendement($resultatAmendements[$nbE][0],$resultatAmendements[$nbE][1],$resultatAmendements[$nbE][2],$resultatAmendements[$nbE][3],$resultatAmendements[$nbE][4],$resultatAmendements[$nbE][5]);
            $nbE++;
        }
    }

    public function chargeLesArticles(){
        $resultatArticles = $this->maBD->chargement('article');
        $nbE = 0;
        while ($nbE < sizeof($resultatArticles)) {
            $this->toutLesArticles->ajouterUnArticle($resultatArticles[$nbE][0],$resultatArticles[$nbE][1],$resultatArticles[$nbE][2],$resultatArticles[$nbE][3]);
            $nbE++;
        }

        // parcours tout les articles et pour chaque articles tout les amendements
        // ajoute les amendements qui correspondent a un article dans sa liste des amendements
        $art = $this->toutLesArticles->__get('lesArticles');
        foreach ($art as $unArticle){
            $idTexteArt = $unArticle->__get('idTexte');
            $codeSeqArt = $unArticle->__get('codeSeqArticle'); 
            $amend = $this->toutLesAmendements->__get('lesAmendements');

            foreach ($amend as $unAmendement) {
                $idTexteArtAm = $unAmendement->__get('idTexte');
                $codeSeqArtAm = $unAmendement->__get('codeSeqArticle');

                if ($idTexteArt == $idTexteArtAm){
                    if ($codeSeqArt == $codeSeqArtAm){
                        $unArticle->ajouterAmendement($unAmendement);
                    }
                }
            }
        }
    }

    public function chargeArtRef() {
        $resultatArtRef = $this->maBD->chargement('faireReference');
        $nbE = 0;
        while ($nbE < sizeof($resultatArtRef)) {
            $tempArr = array($resultatArtRef[$nbE][0],$resultatArtRef[$nbE][1],$resultatArtRef[$nbE][2],$resultatArtRef[$nbE][3]); 
            $this->refArticles->append($tempArr);
            $nbE++;
        }
        // pour chaque reference = (text1, artText1, text2, artText2)
        foreach($this->refArticles as $uneRef) {
            // pour chaque art
            foreach($this->toutLesArticles->__get('lesArticles') as $unArticle){
                $idTexteArt1 = $unArticle->__get('idTexte');
                $codeSeqArt1 = $unArticle->__get('codeSeqArticle');
                // si un art correspond au premier art d'une ref
                if ($idTexteArt1 == $uneRef[0] && $codeSeqArt1 == $uneRef[1]){
                    // pour chaque article
                    foreach($this->toutLesArticles->__get('lesArticles') as $unAutreArticle){
                        $idTexteArt2 = $unAutreArticle->__get('idTexte');
                        $codeSeqArt2 = $unAutreArticle->__get('codeSeqArticle');
                        // si l'art correspond au deuxieme art de la ref
                        if ($idTexteArt2 == $uneRef[2] && $codeSeqArt2 == $uneRef[3]){
                            $unArticle->ajouterReference($unAutreArticle);
                            // est ce qu'il faut ajouter la reference dans l'autre sens aussi ? si oui :
                            // $unAutreArticle->ajouterReference($unArticle);
                        }
                    }
                }
            }
        }
    }

    public function chargeLesTextes(){
        $resultatTextes = $this->maBD->chargement('texte');
        $nbE = 0;
        while ($nbE < sizeof($resultatTextes)){
            $this->toutLesTextes->ajouterUnTexte($resultatTextes[$nbE][0],$resultatTextes[$nbE][1],$resultatTextes[$nbE][2]);
            $nbE++;
        }

        foreach($this->toutLesTextes->__get('lesTextes') as $unTexte){
            $id = $unTexte->__get('idTexte');

            foreach($this->toutLesArticles->__get('lesArticles') as $unArticle){
                $idTexteArt = $unArticle->__get('idTexte');

                if ($id == $idTexteArt){
                    $unTexte->ajouterArticle($unArticle);
                }
            }
            foreach($this->toutLesInstitutions->__get('lesInstitutions') as $uneInstitution){
                $idInst = $uneInstitution->__get('idInstitution');
                $idTextInst = $unTexte->__get('idInstitution');
                if ($idTextInst == $idInst){
                    $unTexte->__set('lInstitution',$uneInstitution);
                }
            }
        }
    }
}
