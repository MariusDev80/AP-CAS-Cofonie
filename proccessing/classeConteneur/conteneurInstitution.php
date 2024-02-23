<?php 

include_once('autoload.php');

class conteneurInstitution
{
    private $lesInstitutions;
    
    public function __construct(){
        $this->lesInstitutions = new ArrayObject();
    }

    public function ajouterUneInstitution(int $unId,string $unLibelle){
        $uneInstitution = new metierInstitution($unId,$unLibelle);
        $this->lesInstitutions->append($uneInstitution); 
    }

    public function nbInstitution(){
        return $this->lesInstitutions->count();
    }

    public function listeDesInstitutions(){

        $liste = '';
        foreach($this->lesInstitutions as $uneInstitution){
            $liste = $liste.$uneInstitution->afficheInstitution();
        }
        return $liste;
    }
}
?>