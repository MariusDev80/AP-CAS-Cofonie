<?php

class metierOrgane 
{
    public function __construct(private int $idOrgane, private string $libelleOrgane, private conteneurInstitution $lesInstitutions)
    {
    }

    public function __get($attribut) 
    {
        switch($attribut){
            case 'idOrgane': return $this->idOrgane; break;
            case 'libelleOrgane': return $this->libelleOrgane; break;
        }
    }
    public function __set($attribut, $valeur)
    {
        switch($attribut){
            case 'idOrgane': $this->idOrgane = $valeur; break;
            case 'libelleOrgane': $this->libelleOrgane = $valeur; break;
        }
    }
}
?>