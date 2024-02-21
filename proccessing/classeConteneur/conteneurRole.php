<?php 

include_once('autoload.php');

class conteneurRole
{
    private $lesRoles;

    public function __construct(){
        $this->lesRoles = new ArrayObject();
    }

    public function ajouterUnRole(int $unId,string $unLibelle){

        $unRole = new metierRole($unId,$unLibelle);
        $this->lesRoles->append($unRole);
    }

    public function nbRole(){
        return $this->lesRoles->count();
    }

    public function listeDesRoles(){

        $liste = '';
        foreach($this->lesRoles as $unRole){
            $liste = $liste.$unRole->libelleRole;
        }
        return $liste;
    }
}
?>