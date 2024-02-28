<?php 

include_once('autoload.php');

class conteneurArticle 
{
    private $lesArticles;

    public function __construct(){
        $this->lesArticles = new ArrayObject();
    }

    public function __get($attribut){
        switch ($attribut){
            case 'lesArticles': return $this->lesArticles;break;
        }
    }

    public function ajouterUnArticle(int $unIdTexte,int $unCodeSeqArticle,string $unTitreArticle,string $unTexte){

        $unArticle = new metierArticle($unIdTexte,$unCodeSeqArticle,$unTitreArticle,$unTexte);
        $this->lesArticles->append($unArticle);
    }

    public function ajouterObjArticle(metierArticle $article){
        $this->lesArticles->append($article);
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