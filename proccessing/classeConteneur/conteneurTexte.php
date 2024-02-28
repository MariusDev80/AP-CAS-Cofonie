<?php 

include_once('autoload.php');

class conteneurTexte
{
    private $lesTextes;
    
    public function __construct(){
        $this->lesTextes = new ArrayObject();
    }

    public function __get($attribut){
        switch($attribut){
            case 'lesTextes' : return $this->lesTextes;break;
        }
    }

    public function ajouterUnTexte(int $unIdTexte,int $unIdInstitution,string $unTitreTexte){

        $unTexte = new metierTexte($unIdTexte,$unIdInstitution,$unTitreTexte);
        $this->lesTextes->append($unTexte);
    }

    public function nbTexte(){
        return $this->lesTextes->count();
    }
}
?>