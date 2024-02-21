<?php
class metierAmendement {

    # ajouter un moyen de connaitre l'article concerner par l'amendement
    public function __construct(private int $idAmendement, private DateTime $dateAmendement, private string $texteAmendement)
    {
    }

    public function __get($attribut){
        switch ($attribut){
            case 'idAmendement': return $this->idAmendement; break;
            case 'dateAmendement':return $this->dateAmendement; break;
            case 'texteAmendement':return $this->texteAmendement; break;
        }
    }

    public function __set($attribut,$valeur){
        switch($attribut){
            case 'idAmendement': $this->idAmendement = $valeur; break;
            case '$dateAmendement': $this->dateAmendement = $valeur; break;
            case 'texteAmendement': $this->texteAmendement = $valeur; break;
        }
    }
}
?>