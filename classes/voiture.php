<?php 

    class Voiture{
        private $_marque;
        private $_puissance;
        private $_modele;
        private $_km;
        private $_img;

        //constructeur
        //permet d'initialiser chaque instance de l'objet créé
        public function __construct($marque, $puissance, $modele, $km, $img){
            $this->setMarque($marque);
            $this->setPuissance($puissance);
            $this->setModele($modele);
            $this->setKm($km);
            $this->setImg($img);
        }

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
    }