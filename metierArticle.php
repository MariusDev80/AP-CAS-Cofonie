<?php
class metierArticle {

    public function __construct(private int $idArticle,private string $texteArticle)
    {
    }

    public function __set($attribut,$valeur){
        switch($attribut) {
            case 'idArticle' : $this->idArticle = $valeur;break;
            case 'texteArticle' : $this->texteArticle = $valeur;break;
        }
    }

    public function __get($attribut){
        switch($attribut) {
            case 'idArticle' : return $this->idArticle;break;
            case 'texteArticle' : return $this->texteArticle;break;
        }
    }
}

?>