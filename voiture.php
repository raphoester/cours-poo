<?php 

    class Voiture{
        private $_marque;
        private $_puissance;
        private $_modele;
        private $_km;

        //constructeur
        //permet d'initialiser chaque instance de l'objet créé
        public function __construct($marque, $puissance, $modele, $km){
            $this->setMarque($marque);
            $this->setPuissance($puissance);
            $this->setModele($modele);
            $this->setKm($km);
        }

        //GETTERS (accesseurs)
        //permet d'accéder à la donnée de manière sécurisée
        public function getMarque(){
            return $this->_marque;
        }
        public function getPuissance(){
            return $this->_Puissance;
        }
        public function getModele(){
            return $this->_Modele;
        }
        public function getKm(){
            return $this->_Km;
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
    }