<?php 

    class Voiture{
        private $_marque;
        private $_puissance;
        private $_modele;
        private $_km;
        private $_img;
        private $_boite;

        //constructeur
        //permet d'initialiser chaque instance de l'objet créé
        public function __construct($marque, $puissance, $modele, $km, $img, $boite){
            $this->setMarque($marque);
            $this->setPuissance($puissance);
            $this->setModele($modele);
            $this->setKm($km);
            $this->setImg($img);
            $this->setBoite($boite);
        }
        
        //constantes de classe
        const TRANSMISSION_AUTO = 0;
        const TRANSMISSION_MAN = 1;
        //ERR_DATA : code d'erreur générique qui servira à chaque fois 
        //qu'une erreur survient dans un getter
        const ERR_DATA = "Null";

        //GETTERS (accesseurs)
        //permet d'accéder à la donnée de manière sécurisée
        public function getMarque(){
            return $this->_marque;
        }
        public function getPuissance(){
            return $this->_puissance;
        }
        public function getModele(){
            return $this->_modele;
        }
        public function getKm(){
            return $this->_km;
        }
        public function getImg(){
            return $this->_img;
        }

        //self : permettre d'accéder à une constante de classe,
        //à l'intérieur de cette même classe.
        //Ici, c'est l'équivalent de Voiture::CONSTANTE
        public function getBoite(){
            if($this->_boite == self::TRANSMISSION_AUTO){
                return "Automatique";
            }
            else if ($this->_boite == self::TRANSMISSION_MAN) {
                return "Manuelle";
            }
            else{
                return self::ERR_DATA;
            }
        }


        //SETTER (définisseurs)
        public function setMarque($marque){
            if($marque != "")
            {
                $this->_marque = $marque;
            }
        }
        public function setPuissance($puissance){
            if(str_ends_with($puissance, "CV"))
            {
                $this->_puissance = $puissance;
            }
        }
        public function setModele($modele){
            if($modele != "")
            {
                $this->_modele = $modele;
            }
        }
        public function setKm($km){
            if(is_integer($km) && $km >= 0)
            {
                $this->_km = $km;
            }
        }
        public function setImg($img){
            if($img != "")
            {
                $this->_img = $img;
            }
        }
        //on vérifie dans le setter que le paramètre (la boîte) correspond bien 
        //à une des constantes définies à cet effet.
        public function setBoite($boite){
            if(in_array($boite, [self::TRANSMISSION_MAN, self::TRANSMISSION_AUTO]))
            {
                $this->_boite = $boite;
            }
        }
    }