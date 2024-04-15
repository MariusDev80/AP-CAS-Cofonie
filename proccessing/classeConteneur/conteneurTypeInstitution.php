<?php 

include_once('autoload.php');

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

    public function listeDesTypesInstitutions() {

        $liste = '';
        foreach($this->lesTypesInstitutions as $unTypeInstitution){
            $liste = $liste.$unTypeInstitution->afficheTypeInstitution();
            
        }
        return $liste;
    }

    public function lesTypesInstitutionsAuFormatHTML()
		{
		$liste = "<SELECT name = 'libelleTypeInstitution'>";
		foreach ($this->lesTypesInstitutions as $unTypeInstitution)
			{
			$liste = $liste."<OPTION value='".$unTypeInstitution->idTypeInstitution."'>".$unTypeInstitution->libelleTypeInstitution."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}
}
?>