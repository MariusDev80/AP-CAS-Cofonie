<?php

class metierOrgane 
{
    public function __construct(private int $idOrgane, private string $libelleOrgane, private int $nbPersonnes)
    {
    }

    public function __get($attribut) 
    {
        switch($attribut){
            case 'idOrgane': return $this->idOrgane; break;
            case 'libelleOrgane': return $this->libelleOrgane; break;
            case 'nbPersonnes' : return $this->nbPersonnes; break;
        }
    }
    public function __set($attribut, $valeur)
    {
        switch($attribut){
            case 'idOrgane': $this->idOrgane = $valeur; break;
            case 'libelleOrgane': $this->libelleOrgane = $valeur; break;
            case 'nbPersonnes' : $this->nbPersonnes = $valeur; break;
        }
    }
    public function afficheOrgane(){
        $liste=$this->idOrgane.' | '.$this->libelleOrgane.' | '.$this->nbPersonnes.' | ';
		return $liste;  
    }   
}
?>