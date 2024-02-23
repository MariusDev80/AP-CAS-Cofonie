<?php 

include_once('autoload.php');

class conteneurArticle 
{
    private $lesArticles;

    public function __construct(){
        $this->lesArticles = new ArrayObject();
    }

    public function ajouterUnArticle(int $unId,string $unTexte, conteneurAmendement $lesAmendements, conteneurArticle $lesArticlesDeReference, conteneurVote $lesVotes){

        $unArticle = new metierArticle($unId,$unTexte, $lesAmendements, $lesArticlesDeReference, $lesVotes);
        $this->lesArticles->append($unArticle);
    }

    public function nbArticle(){
        return $this->lesArticles->count();
    }

    public function listeDesArticles(){

        $liste = '';
        foreach($this->lesArticles as $unArticle){
            $liste = $liste.$unArticle->texteArticle;
        }
        return $liste;
    }
}
?>