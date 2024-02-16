<?php 

include_once('metierTexte.php');

class conteneurTexte
{
    private $lesTextes;
    
    public function __construct(){
        $this->lesTextes = new ArrayObject();
    }

    public function ajouterUnTexte(int $unId,string $unTitreTexteLoi){

        $unTexte = new metierTexte($unId,$unTitreTexteLoi, new conteneurArticle);
        $this->lesTextes->append($unTexte);
    }

    public function nbTexte(){
        return $this->lesTextes->count();
    }

    public function listeDesTextes(){

        $liste = '';
        foreach($this->lesTextes as $unTexte){
            $liste = $liste.$unTexte->texteLoi;
        }
        return $liste;
    }
}
?>