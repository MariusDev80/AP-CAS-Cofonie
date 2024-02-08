<?php

class metierInstitution 
{
    public function __construct(private int $idInstitution, private string $libelleInstitution)
    {
    }

    public function __get($attribut) 
    {
        switch($attribut){
            case 'idInstitution': return $this->idInstitution; break;
            case 'libelleInstitution': return $this->libelleInstitution; break;
        }
    }
    public function __set($attribut, $valeur) 
    {
        switch($attribut) {
            case 'idInstitution': $this->idInstitution = $valeur; break;
            case 'libelleInstitution': $this->libelleInstitution = $attribut; break;
        }
    }   
}
?>