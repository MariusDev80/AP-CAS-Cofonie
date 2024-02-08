<?php
class metierRole
{
    public function __construct(private int $idRole, private string $libelleRole)
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
}
?>