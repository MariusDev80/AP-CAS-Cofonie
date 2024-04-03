<?php 

include_once('autoload.php');

class conteneurInstitution
{
    private $lesInstitutions;
    
    public function __construct(){
        $this->lesInstitutions = new ArrayObject();
    }
	public function __get($attribut){
        switch($attribut){
            case'lesInstitutions': return $this->lesInstitutions;break;
        }
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
    public function lesInstitutionsAuFormatHTML()
		{
		$liste = "<SELECT name = 'libelleInstitution'>";
		foreach ($this->lesInstitutions as $uneInstitution)
			{
			$liste = $liste."<OPTION value='".$uneInstitution->idInstitution."'>".$uneInstitution->libelleInstitution."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}

	public function	modificationDuLibelle($message,$id)
	{	foreach ($this->lesInstitutions as $lInstitution)
			{
			if ($lInstitution->idInstitution==$id)
			{
				$lInstitution->libelleInstitution=$message;
			}
		}
	
	}
    public function donneObjetInstitutionDepuisNumero($uneIdInstitution)
	{
		$trouve=false;
		$laBonneInstitution=null;
		$idInstitution = $this->lesInstitutions->getIterator();
		while ((!$trouve)&&($idInstitution->valid()))
			{
			if ($idInstitution->current()->idInstitution()==$uneIdInstitution)
				{
				$trouve=true;
				$laBonneInstitution = $idInstitution->current();
				}
			else
				$idInstitution->next();
			}
		return $laBonneInstitution;
	}		



	public function donneLibelleInstitutionDepuisNumero($uneIdInstitution)
	{
		$trouve=false;
		$laBonneInstitution=null;
		foreach($this->lesInstitutions as $lInstitution)
		{
			if ($lInstitution->idInstitution==$uneIdInstitution)
			{
				$trouve=true;
				$laBonneInstitution = $lInstitution;
			}
		}
		return $laBonneInstitution->libelleInstitution;
	}		
}
?>