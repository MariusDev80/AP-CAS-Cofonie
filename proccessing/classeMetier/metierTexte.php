<?php

include_once('autoload.php');
class metierTexte
{   
    private $lesArticles;
    private metierInstitution $lInstitution;
    
    public function __construct(private int $idTexte, private int $idInstitution, private string $titreTexte)
    {
        $this->lesArticles = new conteneurArticle();
    }
    public function __get($attribut){
        switch ($attribut){
            case 'idTexte': return $this->idTexte;break;
            case 'titreTexte': return $this->titreTexte;break;
            case 'lesArticles': return $this->lesArticles;break;
        }
    }
    public function __set($attribut,$valeur){
        switch($attribut){
            case 'idTexte': $this->idTexte = $valeur; break;
            case 'titreTexte': $this->titreTexte = $valeur; break;
            case 'lInstitution': $this->lInstitution = $valeur; break;
        }
    }

    public function afficheTexte(){
        $id = $this->idTexte;
        $titre = $this->titreTexte;
        // $nomInstitution = $this->lInstitution->__get('libelleInstitution');
        // - $nomInstitution
        echo "<h3>$id | $titre</h3>";
    }

    public function ajouterArticle($article){
        $this->lesArticles->ajouterObjArticle($article);
    }
}
?>