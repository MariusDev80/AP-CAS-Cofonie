<?php 

include_once('autoload.php');

class conteneurVote
{
    private $lesVotes;

    public function __construct(){
        $this->lesVotes = new ArrayObject();
    }

    public function ajouterUnVote(int $unIdVote,metierArticle $unArticle, metierOrgane $unOrgane, DateTime $uneDate, int $unNbPour, int $unNbContre){

        $unVote = new metierVote($unIdVote,$unArticle,$unOrgane,$uneDate,$unNbPour,$unNbContre);
        $this->lesVotes->append($unVote);
    }
    
    public function nbVotes(){
        return $this->lesVotes->count();
    }

    public function listeDesVotes(){

        $liste = '';
        foreach($this->lesVotes as $unVote){
            $liste = $liste.$unVote->nbPour.','.$unVote->nbContre;
        }
        return $liste;
    }
}
?>