<?php 

// include des vues a ajouter
Class controleur 
{
    public $toutLesAmendements;
    public $toutLesArticles;
    public $toutLesOrganes;
    public $toutLesRoles;
    public $toutLesTextes;
    public $toutLesInstitutions;
    public $toutLesTypeInstitutions;
    private $maBD;

/*******************************************************************************
                                CONSTRUCTEUR 
********************************************************************************/
public function __construct()
{
    $this->maBD = new accesBD();
    $this->toutLesRoles = new conteneurRole();
    $this->chargeLesRoles();
    $this->toutLesInstitutions = new conteneurInstitution();
    $this->chargeLesInstitutions();
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
                    case "institution" :
                        $this->actionInstitution($action);
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
                $vue->ajouterRole($this->toutLesRoles->nbRole(),$this->toutLesInstitutions->listeDesInstitutions(),$this->toutLesInstitutions->nbInstitution());
                break;
            case "saisirRole" :
                $idRole = $_POST['idRole'];
                $idInstution = $_POST['idInstitution'];
                $choix = explode('-',$idInstution);
                $libelleRole = $_POST['libelleRole'];
                $this->toutLesRoles->ajouterUnRole($idRole, $choix[0], $libelleRole);
                $this->maBD->insererUnRole($idRole, $idInstution,$libelleRole);
                echo 'Rôle rajouté correctement';
                break;
            case "visualiser" :
                $listeRole = $this->toutLesRoles->listeDesRoles();
                $vue = new vueCentraleRole();
                $vue->visualiserRole($listeRole);
                break;
        }       
    }
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


}

?>