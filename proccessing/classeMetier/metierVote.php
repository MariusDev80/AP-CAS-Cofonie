<?php

class metierVote 
{
    public function __construct(private int $idVote, private metierArticle $lArticle, private metierOrgane $lOrgane, private DateTime $dateVote, private int $nbPour, private int $nbContre)
    {
    }

    public function __get($attribut) 
    {
        switch($attribut){
            case 'idVote': return $this->idVote; break;
            case 'lArticle': return $this->lArticle; break;
            case 'lOrgane': return $this->lOrgane; break;
            case 'dateVote': return $this->dateVote; break;
            case 'nbPour': return $this->nbPour; break;
            case 'nbContre': return $this->nbContre; break;
        }
    }
    public function __set($attribut, $valeur)
    {
        switch($attribut){
            case 'idVote': $this->idVote = $valeur; break;
            case 'lArticle': $this->lArticle = $valeur; break;
            case 'lOrgane': $this->lOrgane = $valeur; break;
            case 'dateVote': $this->dateVote = $valeur; break;
            case 'nbPour': $this->nbPour = $valeur; break;
            case 'nbContre': $this->nbContre = $valeur; break;
        }
    }
}
?>