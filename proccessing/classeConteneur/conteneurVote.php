<?php 

include_once('autoload.php');

class conteneurVote
{
    private $lesVotes;

    public function __construct(){
        $this->lesVotes = new ArrayObject();
    }

    public function ajouterUnVote(int $unIdTexte,int $unArticle, DateTime $uneDate, int $unOrgane, int $unNbPour, int $unNbContre, int $unAmendement){
        if ($unAmendement == 0){
            $amendement = false;
        }
        else {
            $amendement = true;
        }
        $unVote = new metierVote($unIdTexte,$unArticle,$uneDate,$unOrgane,$unNbPour,$unNbContre,$amendement);
        $this->lesVotes->append($unVote);
    }

    public function __get($attribut){
        switch ($attribut){
            case "lesVotes": return $this->lesVotes; break;
        }
    }
    
    public function nbVotes(){
        return $this->lesVotes->count();
    }

    public function listeDesVotes(){

        $liste = '';
        foreach($this->lesVotes as $unVote){
            $liste = $liste.$unVote->afficheVote();
        }
        return $liste;
    }
}
?>