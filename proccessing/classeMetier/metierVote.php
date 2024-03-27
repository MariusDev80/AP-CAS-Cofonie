<?php

class metierVote 
{
    public function __construct(private int $idTexte, private int $lArticle, private DateTime $dateVote, private int $lOrgane, private int $nbPour, private int $nbContre, private bool $amendement)
    {
    }

    public function __get($attribut) 
    {
        switch($attribut){
            case 'idTexte': return $this->idTexte; break;
            case 'lArticle': return $this->lArticle; break;
            case 'lOrgane': return $this->lOrgane; break;
            case 'dateVote': return $this->dateVote; break;
            case 'nbPour': return $this->nbPour; break;
            case 'nbContre': return $this->nbContre; break;
            case 'amendement': return $this->amendement; break;
        }
    }
    public function __set($attribut, $valeur)
    {
        switch($attribut){
            case 'idTexte': $this->idTexte = $valeur; break;
            case 'lArticle': $this->lArticle = $valeur; break;
            case 'lOrgane': $this->lOrgane = $valeur; break;
            case 'dateVote': $this->dateVote = $valeur; break;
            case 'nbPour': $this->nbPour = $valeur; break;
            case 'nbContre': $this->nbContre = $valeur; break;
            case 'amendement': $this->amendement = $valeur; break;
        }
    }

    public function afficheVote() {
        $date = $this->dateVote->format("Y-m-d");
        if ($this->lOrgane == 1){ $organe = "de l'Assemblé nationnale";}
        $organe = "du Sénat";

        echo "<p class='votes'>";
        if ($this->amendement == true){
            echo "<br><h4>$date vote $organe</h4>$this->nbPour voix Pour | $this->nbContre voix Contre<br>";
            echo "Proposition d'amendement :";
        }
        else {
            echo "$date vote $organe, $this->nbPour voix Pour | $this->nbContre voix Contre<br>";
        }
        echo "</p>";
    }
}
?>