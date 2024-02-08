<?php 
// ajoute le fichier contenant la class concernée, ne le fait qu'une fois et ne se repète pas a chaque appel du ficher
include_once('metierAmendement.php');

class conteneurAmendement
{   
    // le constructeur n'est appelé qu'une fois et initialise une liste d'objets vide 
    // dans laquelle vont etre contenu les objets de la class Amendement
    private $lesAmendements;

    public function __construct(){
        $this->lesAmendements = new ArrayObject();
    }

    // fonction qui créée les objets Amendements et les ajoute dans la liste
    public function ajouterUnAmendement(int $unId,DateTime $uneDate,string $unTexte){

        $unAmendement = new metierAmendement($unId,$uneDate,$unTexte);
        $this->lesAmendements->append($unAmendement);
    }
    
    // retourne le nombre d'objets dans le liste 
    public function nbAmendement(){
        return $this->lesAmendements->count();
    }

    // retourne un string avec tout les textes des objets amendements dans la liste lesAmendements
    public function listeDesAmendements(){

        $liste = '';
        foreach($this->lesAmendements as $unAmendement){
            $liste = $liste.$unAmendement->texteAmendement;
        }
        return $liste;
    }
}
?>