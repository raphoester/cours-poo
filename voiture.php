<?php 

    class Voiture{
        private $_marque;
        private $_puissance;
        private $_modele;
        private $_km;

        //constructeur
        public function __construct($marque, $puissance, $modele, $km){
            $this->_marque=$marque;
            $this->_puissance=$puissance;
            $this->_modele=$modele;
            $this->_km=$km;
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


    }