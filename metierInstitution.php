<?php

class metierInstitution 
{   
    # changer le type/role en fonction de si il peut y en avoir plusieurs ou non
    public function __construct(private int $idInstitution, private string $libelleInstitution, private metierTypeInstitution $typeInstitution, private conteneurRole $roleInstitution)
    {
    }

    # ajouter les getters pour le role et type institution
    public function __get($attribut) 
    {
        switch($attribut){
            case 'idInstitution': return $this->idInstitution; break;
            case 'libelleInstitution': return $this->libelleInstitution; break;
        }
    }

    # ajouter les setters pour le role et type institution
    public function __set($attribut, $valeur) 
    {
        switch($attribut) {
            case 'idInstitution': $this->idInstitution = $valeur; break;
            case 'libelleInstitution': $this->libelleInstitution = $valeur; break;
        }
    }
}
?>