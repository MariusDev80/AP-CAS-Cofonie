<?php
class metierTexte
{   
    # ajouter un conteneur Institution/l'id de l'institution qui propose le texte de loi
    # texteLoi peut etre modifié, sois en descriptionTexteLoi ou libelleTexteLoi car le texte en lui meme est dans les articles
    public function __construct(private int $idTexte, private string $titreTexteLoi, private conteneurArticle $lesArticles)
    {
    }
    public function __get($attribut){
        switch ($attribut){
            case 'idTexte': return $this->idRole;break;
            case 'texteLoi': return $this->texteLoi;break;
        }
    }
    public function __set($attribut,$valeur){
        switch($attribut){
        case 'idTexte': $this->idRole = $valeur; break;
            case 'texteLoi': $this->texteLoi = $valeur; break;
        }
    }
}
?>