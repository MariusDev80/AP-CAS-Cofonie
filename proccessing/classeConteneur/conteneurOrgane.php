<?php 

include_once('autoload.php');

class conteneurOrgane
{
    private $lesOrganes;

    public function __construct(){
        $this->lesOrganes = new ArrayObject();
    }

    public function __get($attribut){
        switch($attribut){
            case'lesOrganes': return $this->lesOrganes;break;
        }
    }

    public function ajouterUnOrgane(int $unId,string $unOrgane,int $nbrPersonnes){

        $unOrgane = new metierOrgane($unId,$unOrgane,$nbrPersonnes);
        $this->lesOrganes->append($unOrgane);
    }

    public function nbOrgane(){
        return $this->lesOrganes->count();
    }

    public function listeDesOrganes(){

        $liste = '';
        foreach($this->lesOrganes as $unOrgane){
            $liste = $liste.$unOrgane->afficheOrgane();
        }
        return $liste;
    }
}
?>