<?php 

include_once('metierTypeInstitution.php');

class conteneurTypeInstitution
{
    private $lesTypesInstitutions;
    
    public function __construct(){
        $this->lesTypesInstitutions = new ArrayObject();
    }

    public function ajouterUnTypeInstitution(int $unId,string $unLibelle){

        $unTypeInstitution = new metierTypeInstitution($unId,$unLibelle);
        $this->lesTypesInstitutions->append($unTypeInstitution);
    }

    public function nbTypeInstitution(){
        return $this->lesTypesInstitutions->count();
    }

    public function listeDesTypesInstitutions(){

        $liste = '';
        foreach($this->lesTypesInstitutions as $unTypeInstitution){
            $liste = $liste.$unTypeInstitution->libelleTypeInstitution;
        }
        return $liste;
    }
}
?>