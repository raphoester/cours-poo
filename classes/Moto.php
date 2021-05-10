<?php 
class Moto extends Vehicule{
    private $_nbreRoues;
    private $_type;

    public function __construct($nbreRoues="", $type="", $id="", $marque="", $puissance="", $modele="", $km="", $img="", $boite=""){
        parent::__construct($id, $marque, $puissance, $modele, $km, $img, $boite);
        $this->setnbreRoues($nbreRoues);
        $this->setType($type);
    }

    public function roueArriere($duree){
        return "Vr".str_repeat("o", $duree/2).str_repeat("u", $duree/2)."m !";
    }

    public function getNbreRoues(){
        return $this->_nbreRoues;
    }
    public function getType(){
        return $this->_type;
    }

    public function setNbreRoues($nbreRoues){
        try{
            $nbreRoues = intval($nbreRoues);
        }finally{}
        if(is_integer($nbreRoues) && $nbreRoues >= 2 && $nbreRoues <= 4){
            $this->_nbreRoues = $nbreRoues;
        }
    }

    public function setType($type){
        try{
            $type = strval($type);
        }finally{}
        if(is_string($type)){
            $this->_type = $type;
        }
    }
}
?>