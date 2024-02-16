<?php

class metierTypeInstitution 
{
    # voir si il faut mettre un conteneur des institutions dans le constructeur pour avoir la liste des institutions relatives a un type
    public function __construct(private int $idTypeInstitution, private string $libelleTypeInstitution)
    {
    }

    public function __get($attribut) 
    {
        switch($attribut){
            case 'idTypeInstitution': return $this->idTypeInstitution; break;
            case 'libelleTypeInstitution': return $this->libelleTypeInstitution; break;
        }
    }
    public function __set($attribut, $valeur) 
    {
        switch($attribut) {
            case 'idTypeInstitution': $this->idTypeInstitution = $valeur; break;
            case 'libelleTypeInstitution': $this->libelleTypeInstitution = $valeur; break;
        }
    }   
}
?>