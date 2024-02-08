<?php 

include_once('metierArticle.php');

class conteneurArticle 
{
    private $lesArticles;

    public function __construct(){
        $this->lesArticles = new ArrayObject();
    }

    public function ajouterUnArticle(int $unId,string $unTexte){

        $unArticle = new metierArticle($unId,$unTexte);
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