<?php 
class Voiture extends Vehicule{
    private $_nbrePortes;
    private $_decapotable;

    public const DECAPOTABLE = 1;
    public const CAPOT_FIXE = 0;

    public function __construct($nbrePortes="", $decapotable="", $id="", $marque="", $puissance="", $modele="", $km="", $img="", $boite=""){
        parent::__construct($id, $marque, $puissance, $modele, $km, $img, $boite);
        $this->setnbrePortes($nbrePortes);
        $this->setDecapotable($decapotable);
    }

    public function getNbrePortes(){
        return $this->_nbrePortes;
    }
    public function getDecapotableBool(){
        return $this->_decapotable;
    }
    public function getDecapotable(){
        if($this->_decapotable == self::DECAPOTABLE){
            return "Décapotable";
        }
        else{
            return "Capot fixe";
        }
    }

    public function setNbrePortes($nbrePortes){
        try{
            $nbrePortes = intval($nbrePortes);
        }finally{}
        if(is_integer($nbrePortes) && $nbrePortes >= 2 && $nbrePortes <= 9){
            $this->_nbrePortes = $nbrePortes;
        }
    }

    public function setDecapotable($decapotable){
        try{
            $decapotable = boolval($decapotable);
        }finally{}
        if(is_bool($decapotable)){
            $this->_decapotable = $decapotable;
        }
    }
}
?>