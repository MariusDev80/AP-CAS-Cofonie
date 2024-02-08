<?php
class metierAmendement {

    public function __construct(private int $idAmendement, private DateTime $dateAmendement, private string $texteAmendement)
    {
    }

    public function __get($attribut){
        switch ($attribut){
            case 'idAmendement': return $this->id; break;
            case 'dateAmendement':return $this->dateTime; break;
            case 'texteAmendement':return $this->texteAmendement; break;
        }
    }

    public function __set($attribut,$valeur){
        switch($attribut){
            case 'idAmendement': $this->id = $valeur; break;
            case '$dateAmendement': $this->dateTime = $valeur; break;
            case 'texteAmendement': $this->texteAmendement = $valeur; break;
        }
    }
}
?>