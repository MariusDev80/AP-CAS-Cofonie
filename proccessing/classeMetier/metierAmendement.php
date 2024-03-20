<?php
include_once('autoload.php');
class metierAmendement {

    # ajouter un moyen de connaitre l'article concerner par l'amendement
    public function __construct(private int $idTexte, private int $codeSeqArticle, private int $codeSeqAmendement, private string $libelleAmendement, private string $texteAmendement, private DateTime $dateAmendement)
    {
    }

    public function __get($attribut){
        switch ($attribut){
            case 'idTexte' : return $this->idTexte;break;
            case 'codeSeqArticle' : return $this->codeSeqArticle;break;
            case 'idAmendement': return $this->codeSeqAmendement; break;
            case 'dateAmendement':return $this->dateAmendement; break;
            case 'texteAmendement':return $this->texteAmendement; break;
        }
    }

    public function __set($attribut,$valeur){
        switch($attribut){
            case 'idAmendement': $this->codeSeqAmendement = $valeur; break;
            case '$dateAmendement': $this->dateAmendement = $valeur; break;
            case 'texteAmendement': $this->texteAmendement = $valeur; break;
        }
    }

    public function afficheAmendement(){
        $id = $this->idTexte.'.'.$this->codeSeqArticle.'-'.$this->codeSeqAmendement;
        $lib = $this->libelleAmendement;
        $texte = $this->texteAmendement;
        $date = $this->dateAmendement->format('Y-m-d');
        echo "<h3>$id | $date | $lib</h3><br><p>$texte</p>";
    }
}
?>