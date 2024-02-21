<?php 

include_once('autoload.php');

class conteneurTexte
{
    private $lesTextes;
    
    public function __construct(){
        $this->lesTextes = new ArrayObject();
    }

    public function ajouterUnTexte(int $unId,string $unTitreTexteLoi, conteneurArticle $lesArticles, metierInstitution $lInstitution){

        $unTexte = new metierTexte($unId,$unTitreTexteLoi,$lesArticles,$lInstitution);
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