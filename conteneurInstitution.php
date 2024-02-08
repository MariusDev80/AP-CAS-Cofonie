<?php 

include_once('metierInstitution.php');

class conteneurInstitution
{
    private $lesInstitutions;
    
    public function __construct(){
        $this->lesInstitutions = new ArrayObject();
    }

    public function ajouterUneInstitution(int $unId,string $unLibelle){
        $uneInstitution = new metierArticle($unId,$unLibelle);
        $this->lesInstitutions->append($uneInstitution); 
    }

    public function nbInstitution(){
        return $this->lesInstitutions->count();
    }

    public function listeDesInsitutions(){

        $liste = '';
        foreach($this->lesInstitutions as $uneInstitution){
            $liste = $liste.$uneInstitution->libelleInstitution;
        }
        return $liste;
    }
}
?>