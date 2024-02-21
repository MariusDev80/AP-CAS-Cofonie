<?php
class metierArticle {

    # ajouter un moyen de connaitre le Texte de loi qui contient cet article
    public function __construct(private int $idArticle,private string $texteArticle, private conteneurAmendement $lesAmendement, private conteneurArticle $lesArticlesDeReference, private conteneurVote $lesVotes)
    {
    }

    public function __get($attribut){
        switch($attribut) {
            case 'idArticle' : return $this->idArticle;break;
            case 'texteArticle' : return $this->texteArticle;break;
        }
    }

    public function __set($attribut,$valeur){
        switch($attribut) {
            case 'idArticle' : $this->idArticle = $valeur;break;
            case 'texteArticle' : $this->texteArticle = $valeur;break;
        }
    }

}

?>