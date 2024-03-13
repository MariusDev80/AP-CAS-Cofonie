<?php 

include_once('autoload.php');

class conteneurOrgane
{
    private $lesOrganes;

    public function __construct(){
        $this->lesOrganes = new ArrayObject();
    }

    public function ajouterUnOrgane(int $unId,string $unOrgane,int $nbPersonnes){

        $unOrgane = new metierOrgane($unId,$unOrgane,$nbPersonnes, new conteneurOrgane);
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