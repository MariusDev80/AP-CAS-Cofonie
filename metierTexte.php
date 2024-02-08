<?php
class metierTexte
{
    public function __construct(private int $idTexte, private array $texteLoi, private conteneurArticle $lesArticles)
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