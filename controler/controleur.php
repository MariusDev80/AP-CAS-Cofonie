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

    public function affichePage($action, $vue)
    {

        if (isset($_GET['action']) && isset($_GET['vue'])) {
            $action = $_GET['action'];
            $vue = $_GET['vue'];

            switch ($vue) {
                case "texte":
                    $this->actionTexte($action);
                    break;
                case "institution":
                    $this->actionInstitution($action);
                    break;
                case "organe":
                    $this->actionOrgane($action);
                    break;
                case "role":
                    $this->actionRole($action);
                    break;
                case "typeInstitution":
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
                case "afficherUtilisateurs";
                    $this->afficherUtilisateurs();
                    break;
                case "modifRole";
                    $this->modifRole();
                    break;
            }
        }
    }

    public function modifRole()
    {
        // Vérification si des données de formulaire ont été soumises
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération de l'ID de l'utilisateur et du nouveau rôle à partir du formulaire
            $idUtilisateur = $_POST['utilisateur'];
            $nouveauRole = $_POST['role'];

            // Requête SQL pour mettre à jour le rôle de l'utilisateur
            $sql = "UPDATE users SET role = :nouveauRole WHERE id = :idUtilisateur";

            // Préparation de la requête SQL
            $query = $this->maBD->getConn()->prepare($sql);

            // Liaison des paramètres
            $query->bindParam(':nouveauRole', $nouveauRole, PDO::PARAM_INT);
            $query->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);

            // Exécution de la requête SQL
            if ($query->execute()) {
                echo '<div class="alert alert-success" role="alert">';
                echo "Le rôle de l'utilisateur a été mis à jour avec succès.";
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo "Erreur lors de la mise à jour du rôle de l'utilisateur.";
                echo '</div>';
            }
        }

        // Requête SQL pour récupérer tous les utilisateurs
        $sql = "SELECT id, username FROM users";

        // Exécution de la requête SQL
        $query = $this->maBD->getConn()->query($sql);

        // Vérification si la requête a réussi
        if ($query) {
            // Récupération des données sous forme de tableau associatif
            $utilisateurs = $query->fetchAll(PDO::FETCH_ASSOC);

            // Affichage du formulaire de modification du rôle avec Bootstrap
            echo '<div class="container">';
            echo '<h2>Modifier le rôle d\'un utilisateur</h2>';
            echo '<form action="" method="POST">';
            echo '<div class="form-group">';
            echo '<label for="utilisateur">Utilisateur :</label>';
            echo '<select class="form-control" name="utilisateur" id="utilisateur">';
            foreach ($utilisateurs as $utilisateur) {
                echo '<option value="' . $utilisateur['id'] . '">' . $utilisateur['username'] . '</option>';
            }
            echo '</select>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="role">Nouveau rôle :</label>';
            echo '<label for="role">Nouveau rôle :</label>';
            echo '<select class="form-control" name="role" id="role">';
            echo '<option value="1">1 (Secrétaire)</option>';
            echo '<option value="2">2 (Greffier)</option>';
            echo '<option value="3">3 (Citoyen)</option>';
            echo '<option value="4">4 (Monarque)</option>';
            echo '</select>';
            echo '</select>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Modifier le rôle</button>';
            echo '</form>';
            echo '</div>';
        } else {
            // En cas d'échec de la requête
            echo '<div class="alert alert-danger" role="alert">';
            echo "Erreur lors de la récupération des utilisateurs.";
            echo '</div>';
        }
    }
    public function afficherUtilisateurs()
    {
        $sql = "SELECT * FROM users";

        // Exécution de la requête SQL
        $query = $this->maBD->getConn()->query($sql);

        // Vérification si la requête a réussi
        if ($query) {
            // Récupération des données sous forme de tableau associatif
            $utilisateurs = $query->fetchAll(PDO::FETCH_ASSOC);

            // Affichage du début du tableau HTML avec les en-têtes
            echo '<table class="table table-striped table-bordered table-sm">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Username</th>
							<th scope="col">Role</th>
						</tr>
					</thead>
					<tbody>';

            // Affichage des lignes du tableau avec les données des utilisateurs
            foreach ($utilisateurs as $utilisateur) {
                echo "<tr>";
                echo "<td>" . $utilisateur['id'] . "</td>";
                echo "<td>" . $utilisateur['username'] . "</td>";
                echo "<td>" . $utilisateur['role'] . "</td>";
                echo "</tr>";
            }

            // Affichage de la fin du tableau HTML
            echo '</tbody></table>';
        } else {
            // En cas d'échec de la requête
            echo "Erreur lors de la récupération des utilisateurs.";
        }
    }
    public function deconnexion()
    {
        // Détruire la session
        session_destroy();
        header('Location: ../AP-CAS-COFONIE-5/index.php');
        // array_pop($_GET['action']);
        // array_pop($_GET['vue']);
    }

    public function signup()
    {
        if (isset($_POST['signupUsername']) && isset($_POST['signupPassword']) && isset($_POST['confirmPassword'])) {
            $signupUsername = $_POST['signupUsername'];
            $signupPassword = $_POST['signupPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            // Vérification que les mots de passe correspondent
            if ($signupPassword !== $confirmPassword) {
                echo "Les mots de passe ne correspondent pas.";
                exit();
            }

            // Hashage du mot de passe
            $password_hash = md5($signupPassword);

            // Définition du rôle
            $role = 0;

            // Insérer l'utilisateur dans la base de données
            $this->maBD->insererUnUtilisateur($signupUsername, $password_hash, $role);

            // Afficher un message de succès
            echo '<center style="color: #39FF33">Compte créé avec succès.</center>';
        }
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
            if ($role == 0) {
                echo '<br><center style="color:#FF0000">L\'administrateur doit vérifier votre compte.</center><br>';
                echo '
                    <form action="index.php?vue=deconnexion&action=deconnexion" method="post">
                        <center><button type="submit" class="btn btn-danger">
                            Allez à la page de connexion
                        </button></center>
                    </form>
                </div>
                ';
                exit();
            }

            // Stocker le rôle dans une variable de session
            $_SESSION['role'] = $role;
        } else {
            echo '<center style="color:#FF0000">Identifiant ou mot de passe incorrect <br></center>';
        }


        // Fermeture de la requête
        $req->closeCursor();
    }

    public function actionVote($action)
    {
        switch ($action) {
            case "voter":
                break;
            case "visualiser":
                $vue = new vueCentraleVote();
                $vue->choisirVote($this->toutLesTextes);
                break;

            case "visualiserVote":
                $texte = $_POST['texte'];
                $vue = new vueCentraleVote();
                foreach ($this->toutLesTextes->__get('lesTextes') as $unTexte) {
                    if ($unTexte->__get('idTexte') == $texte) {
                        $texteChoisi = $unTexte;
                    }
                }
                $vue->visualiserVote($texteChoisi); // ajouter le conteneurVote pour
                break;                                   // avoir le nombre de vote sur les articles
        }
    }

    public function actionOrgane($action)
    {
        switch ($action) {
            case 'ajouter':
                $vue = new vueCentraleOrgane();
                $vue->ajouterOrgane();
                break;
            case 'saisirOrgane':
                break;

            case 'visualiser':
                $vue = new vueCentraleOrgane();
                $vue->visualiserOrgane();
                break;
        }
    }

    public function actionTypeInstitution($action)
    {
        switch ($action) {
            case "ajouter":
                $vue = new vueCentraleTypeInstitution();
                $vue->ajouterTypeInstitution();
                break;

            case "saisirTypeInstitution":
            // break;

            case "visualiser":
                $liste = $this->toutLesTypesInstitutions->listeDesTypesInstitutions();
                $vue = new vueCentraleTypeInstitution();
                $vue->visualiserTypeInstitution($liste);
                break;
        }
    }

    public function actionTexte($action)
    {
        switch ($action) {

            case "ajouter":
                $vue = new vueCentraleTexte();
                $vue->ajouterTextes();
                break;
            case "saisirAmendement":
                break;

            case "visualiser":
                $textes = $this->toutLesTextes->__get('lesTextes');
                $vue = new vueCentraleTexte();
                $vue->visualiserTextes($textes, $this->toutLesArticles);
                break;
        }
    }

    public function actionInstitution($action)
    {
        switch ($action) {
            case "ajouter":
                $vue = new vueCentraleInstitution();
                $vue->ajouterInstitution($this->toutLesInstitutions->nbInstitution());
                break;
            case "saisirInstitution":
                $idInstitution = $_POST['idInstitution'];
                $libelleInstitution = $_POST['libelleInstitution'];
                $this->toutLesInstitutions->ajouterUneInstitution($idInstitution, $libelleInstitution);
                $this->maBD->insererUneInstitution($idInstitution, $libelleInstitution);
                echo 'Rôle rajouté correctement';
                break;
            case "visualiser":
                $listeInstitution = $this->toutLesInstitutions->listeDesInstitutions();
                $vue = new vueCentraleInstitution();
                $vue->visualiserInstitution($listeInstitution);
                break;
        }
    }
    public function actionRole($action)
    {
        switch ($action) {

            case "ajouter":
                $vue = new vueCentraleRole();
                // vue de l'ajout d'un role, a besoin du nombre de role et d'institutions ainsi que de la liste des institutions
                $vue->ajouterRole($this->toutLesRoles->nbRole(), $this->toutLesInstitutions->listeDesInstitutions(), $this->toutLesInstitutions->nbInstitution());
                break;
            case "saisirRole":
                $idRole = $_POST['idRole'];
                $idInstitution = $_POST['idInstitution'];
                $choix = explode('-', $idInstitution);
                $libelleRole = $_POST['libelleRole'];
                $this->toutLesRoles->ajouterUnRole($idRole, $choix[0], $libelleRole);
                $this->maBD->insererUnRole($idRole, $idInstitution, $libelleRole);
                echo 'Rôle rajouté correctement';
                break;
            case "visualiser":
                $listeRole = $this->toutLesRoles->listeDesRoles();
                $vue = new vueCentraleRole();
                $vue->visualiserRole($listeRole);
                break;
        }
    }

    /***********************************************************************************************************************
                                        CHARGEMENT DES TABLES DANS LES CONTENEURS
    ***********************************************************************************************************************/
    public function chargeLesInstitutions()
    {
        $resultatInstitutions = $this->maBD->chargement('institution');
        $nbE = 0;
        while ($nbE < sizeof($resultatInstitutions)) {
            $this->toutLesInstitutions->ajouterUneInstitution($resultatInstitutions[$nbE][0], $resultatInstitutions[$nbE][1]);

            $nbE++;
        }
    }
    public function chargeLesRoles()
    {
        $resultatRoles = $this->maBD->chargement('roleinstitution');
        $nbE = 0;
        while ($nbE < sizeof($resultatRoles)) {
            $this->toutLesRoles->ajouterUnRole($resultatRoles[$nbE][0], $resultatRoles[$nbE][1], $resultatRoles[$nbE][2]);

            $nbE++;
        }

    }

    public function chargeLesTypesInstitutions()
    {
        // définir une variable résultat
        $resultatTypeInstitutions = $this->maBD->chargement("typeInstitution");
        $nbE = 0;

        // parcourir la liste resultat pour prendre chaque elem et en faire un obj
        while ($nbE < sizeof($resultatTypeInstitutions)) {
            $this->toutLesTypesInstitutions->ajouterUnTypeInstitution($resultatTypeInstitutions[$nbE][0], $resultatTypeInstitutions[$nbE][1]);
            $nbE++;
        }
    }

    public function chargeLesAmendements()
    {
        $resultatAmendements = $this->maBD->chargement('amendement');
        $nbE = 0;
        while ($nbE < sizeof($resultatAmendements)) {
            $this->toutLesAmendements->ajouterUnAmendement($resultatAmendements[$nbE][0], $resultatAmendements[$nbE][1], $resultatAmendements[$nbE][2], $resultatAmendements[$nbE][3], $resultatAmendements[$nbE][4], $resultatAmendements[$nbE][5]);
            $nbE++;
        }
    }

    public function chargeLesArticles()
    {
        $resultatArticles = $this->maBD->chargement('article');
        $nbE = 0;
        while ($nbE < sizeof($resultatArticles)) {
            $this->toutLesArticles->ajouterUnArticle($resultatArticles[$nbE][0], $resultatArticles[$nbE][1], $resultatArticles[$nbE][2], $resultatArticles[$nbE][3]);
            $nbE++;
        }

        // parcours tout les articles et pour chaque articles tout les amendements
        // ajoute les amendements qui correspondent a un article dans sa liste des amendements
        $art = $this->toutLesArticles->__get('lesArticles');
        foreach ($art as $unArticle) {
            $idTexteArt = $unArticle->__get('idTexte');
            $codeSeqArt = $unArticle->__get('codeSeqArticle');
            $amend = $this->toutLesAmendements->__get('lesAmendements');

            foreach ($amend as $unAmendement) {
                $idTexteArtAm = $unAmendement->__get('idTexte');
                $codeSeqArtAm = $unAmendement->__get('codeSeqArticle');

                if ($idTexteArt == $idTexteArtAm) {
                    if ($codeSeqArt == $codeSeqArtAm) {
                        $unArticle->ajouterAmendement($unAmendement);
                    }
                }
            }
        }
    }

    public function chargeArtRef()
    {
        $resultatArtRef = $this->maBD->chargement('faireReference');
        $nbE = 0;
        while ($nbE < sizeof($resultatArtRef)) {
            $tempArr = array($resultatArtRef[$nbE][0], $resultatArtRef[$nbE][1], $resultatArtRef[$nbE][2], $resultatArtRef[$nbE][3]);
            $this->refArticles->append($tempArr);
            $nbE++;
        }
        // pour chaque reference = (text1, artText1, text2, artText2)
        foreach ($this->refArticles as $uneRef) {
            // pour chaque art
            foreach ($this->toutLesArticles->__get('lesArticles') as $unArticle) {
                $idTexteArt1 = $unArticle->__get('idTexte');
                $codeSeqArt1 = $unArticle->__get('codeSeqArticle');
                // si un art correspond au premier art d'une ref
                if ($idTexteArt1 == $uneRef[0] && $codeSeqArt1 == $uneRef[1]) {
                    // pour chaque article
                    foreach ($this->toutLesArticles->__get('lesArticles') as $unAutreArticle) {
                        $idTexteArt2 = $unAutreArticle->__get('idTexte');
                        $codeSeqArt2 = $unAutreArticle->__get('codeSeqArticle');
                        // si l'art correspond au deuxieme art de la ref
                        if ($idTexteArt2 == $uneRef[2] && $codeSeqArt2 == $uneRef[3]) {
                            $unArticle->ajouterReference($unAutreArticle);
                            // est ce qu'il faut ajouter la reference dans l'autre sens aussi ? si oui :
                            // $unAutreArticle->ajouterReference($unArticle);
                        }
                    }
                }
            }
        }
    }

    public function chargeLesTextes()
    {
        $resultatTextes = $this->maBD->chargement('texte');
        $nbE = 0;
        while ($nbE < sizeof($resultatTextes)) {
            $this->toutLesTextes->ajouterUnTexte($resultatTextes[$nbE][0], $resultatTextes[$nbE][1], $resultatTextes[$nbE][2]);
            $nbE++;
        }

        foreach ($this->toutLesTextes->__get('lesTextes') as $unTexte) {
            $id = $unTexte->__get('idTexte');

            foreach ($this->toutLesArticles->__get('lesArticles') as $unArticle) {
                $idTexteArt = $unArticle->__get('idTexte');

                if ($id == $idTexteArt) {
                    $unTexte->ajouterArticle($unArticle);
                }
            }
            foreach ($this->toutLesInstitutions->__get('lesInstitutions') as $uneInstitution) {
                $idInst = $uneInstitution->__get('idInstitution');
                $idTextInst = $unTexte->__get('idInstitution');
                if ($idTextInst == $idInst) {
                    $unTexte->__set('lInstitution', $uneInstitution);
                }
            }
        }
    }
}
