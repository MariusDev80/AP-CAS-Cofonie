<?php
class metierRole
{
    # voir si on ajoute un conteneur institution pour avoir la liste des institutions relatives a un role
    public function __construct(private int $idRole, private int $idInstitution, private string $libelleRole)
    {
    }
    public function __get($attribut){
        switch ($attribut){
            case 'idRole': return $this->idRole; break;
            case 'role':return $this->libelleRole; break;
        }
    }
    public function __set($attribut,$valeur){
        switch($attribut){
            case 'idRole': $this->idRole = $valeur; break;
            case 'role': $this->libelleRole = $valeur; break;
        }
    }
    public function afficheRole(){
        $liste=$this->idRole.' | '.$this->idInstitution.' | '.$this->libelleRole.' | ';
		return $liste;
    }
}
?>