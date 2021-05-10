<?php 
    class Camion extends Vehicule{
        private $_chargeMax;
        private $_poidsVide;
        private $_chargeActuelle;

        public const CHARGE_VIDE = 0;

        public function __construct($chargeMax="", $poidsVide="", $id="", $marque="", $puissance="", $modele="", $km="", $img="", $boite=""){
            parent::__construct($id, $marque, $puissance, $modele, $km, $img, $boite);
            $this->setChargeMax($chargeMax);
            $this->setPoidsVide($poidsVide);
            $this->setChargeActuelle(self::CHARGE_VIDE);
        }

        public function decharger($charge){
            $nouvelleCharge = $this->getChargeActuelle()-$charge;
            $this->setChargeActuelle($nouvelleCharge);
        }

        public function getChargeMax(){
            return $this->_chargeMax;
        }
        public function getPoidsVide(){
            return $this->_poidsVide;
        }
        public function getChargeActuelle(){
            return $this->_chargeActuelle;
        } 

        public function setChargeMax($chargeMax){
            try{
                $chargeMax = intval($chargeMax);
            }finally{}
            if(is_integer($chargeMax) && $chargeMax >= 30 && $chargeMax <= 70){
                $this->_chargeMax = $chargeMax;
            }
        }
        public function setPoidsVide($poidsVide){
            try{
                $poidsVide = intval($poidsVide);
            }finally{}
            if(is_integer($poidsVide) && $poidsVide >= 5 && $poidsVide <= 15){
                $this->_poidsVide = $poidsVide;
            }
        }
        public function setChargeActuelle($chargeActuelle){
            try{
                $chargeActuelle = intval($chargeActuelle);
            }finally{}
            if(is_integer($chargeActuelle) && $chargeActuelle >= 0 && $chargeActuelle <= 70){
                $this->_chargeActuelle = $chargeActuelle;
            }
        }
    }
?>