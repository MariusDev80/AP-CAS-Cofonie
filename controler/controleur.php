<?php 

// include des vues a ajouter
include_once('autoload.php');

Class controleur 
{
    public $toutLesAmendements;
    public $toutLesArticles;
    public $toutLesOrganes;
    public $toutLesRoles;
    public $toutLesTextes;
    public $toutLesTypeInstitutions;
    private $maBD;

/*******************************************************************************
                                CONSTRUCTEUR 
********************************************************************************/
    public function __construct()
    {
        $this->maBD = new accesBD();
        if (isset($_SESSION['amendements'])) {
            $this->toutLesAmendements = unserialize($_SESSION['amendements']);
        } else {
            $this->toutLesAmendements = new conteneurAmendement();
        }
        if (isset($_SESSION['articles'])) {
            $this->toutLesArticles = unserialize($_SESSION['articles']);
        } else {
            $this->toutLesArticles = new conteneurArticle();
        }
        if (isset($_SESSION['organes'])) {
            $this->toutLesOrganes = unserialize($_SESSION['organes']);
        } else {
            $this->toutLesOrganes = new conteneurOrgane();
        }
        if (isset($_SESSION['roles'])) {
            $this->toutLesRoles = unserialize($_SESSION['roles']);
            $this->chargeLesRoles();
        } else {
            $this->toutLesRoles = new conteneurRole();
            $this->chargeLesRoles();
        }
        if (isset($_SESSION['textes'])) {
            $this->toutLesTextes = unserialize($_SESSION['textes']);
        } else {
            $this->toutLesTextes = new conteneurTexte();
        }
        if (isset($_SESSION['typeInstitutions'])) {
            $this->toutLesTypeInstitutions = unserialize($_SESSION['typeInstitutions']);
        } else {
            $this->toutLesTypeInstitutions = new conteneurTypeInstitution();
        }
    }
/*******************************************************************************
                    Affichage ENTETE et PIED de PAGE 
********************************************************************************/
    public function afficheEntete() {
        require 'entete.php';
    }

    public function affichePiedPage() {
        require 'piedPage.php';
    }

/********************************************************************************
                Execution des differentes actions selon les vues
*********************************************************************************/ 

// liste = ('bonjour', 'bonsoir')
// isset(liste['bonjour']) -> true
// isset(liste['coucou']) -> false

    public function affichePage($action,$vue){

        if (isset($_GET['action']) && isset($_GET['vue'])){
                $action = $_GET['action'];
                $vue = $_GET['vue'];

                switch ($vue){
                    case "amendement" : 
                        $this->actionAmendement($action);
                        break;
                    case "article" :
                        // $this->actionArticle($action);
                        break;
                    case "organe" :
                        // $this->actionOrgane($action);
                        break;
                    case "role" :
                        $this->actionRole($action);
                        break;
                    case "texte" : 
                        // $this->actionTexte($action);
                        break;
                    case "typeInstitution" :
                        // $this->actionTypeInstitution($action);
                        break;
                }
            }
    }

    public function actionAmendement($action){
        switch ($action) {

            // l'ajout passe par deux etapes,
            // la creation de vueAmendement et l'appel de la fonction d'ajout puis la saisie et l'ajout 
            case "ajouter" :
                $vue = new vueCentraleAmendement();
                $vue->ajouterAmendement();
                break;
            case "saisirAmendement" :
                // $idAmendement = $_POST['idAmendement'];
                // $dateAmendement = $_POST['dateAmendement'];
                // $texteAmendement = $_POST['texteAmendement'];
                // $this->toutLesAmendements->ajouterUnAmendement($idAmendement,$dateAmendement,$texteAmendement);
                break;

            // visualisation des amendements
            case "visualiser" :
                // mettre les amendement sous la forme souhaité et en string
                // $liste = $this->toutLesAmendements->listeDesAmendements();
                // ?? voir fichier prof : $liste = $liste.$this->tousLesVehicules->listeDesVehicules();

                // creation de l'objet vueAmendement
                $vue = new vueCentraleAmendement();
                //$vue->visualiserAmendement($liste);
                $vue->visualiserAmendement();

                // ?? voir fichier prof : echo $this->tousLesVehicules->listeDesVehicules();
        }       
    }
    public function actionRole($action){
        switch ($action) {
            /*
            // l'ajout passe par deux etapes,
            // la creation de vueRole et l'appel de la fonction d'ajout puis la saisie et l'ajout 
            case "ajouter" :
                $vue = new vueCentraleRole();
                $vue->ajouterRole();
                break;
            case "saisirRole" :
                $idRole = $_POST['idRole'];
                $libelleRole = $_POST['libelleRole'];
                $this->toutLesRoles->ajouterUnRole($idRole, $libelleRole);
                break;
            */
            // visualisation des amendements
            case "visualiser" :
                // mettre les amendement sous la forme souhaité et en string
                $listeRole = $this->toutLesRoles->listeDesRoles();
                // ?? voir fichier prof : $liste = $liste.$this->tousLesVehicules->listeDesVehicules();

                // creation de l'objet vueAmendement
                $vue = new vueCentraleRole();
                //$vue->visualiserAmendement($liste);
                $vue->visualiserRole($listeRole);

                // ?? voir fichier prof : echo $this->tousLesVehicules->listeDesVehicules();
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


}

?>