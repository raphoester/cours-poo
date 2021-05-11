<?php
    class marque{
        private $_id;
        private $_nom;

        public function __construct($nom="", $id=""){
            $this->setId($id);
            $this->setNom($nom);
        }

        public function hydrate(array $donnees){
            foreach ($donnees as $cle => $valeur){
                $methode = 'set'.ucfirst($cle);
                if(method_exists($this, $methode)){
                    $this->$methode($valeur);
                }
            }
        }

        public function getId(){
            return $this->_id;
        }
        public function getNom(){
            return $this->_nom;
        }

        public function setId($id){
            try{
                $id = intval($id);
            }
            finally{}
            if (is_integer($id) && $id > 0){
                $this->_id = $id;
            }
        }
        public function setNom($nom){
            try{
                $id = strval($nom);
            }finally{}
            $this->_nom = $nom;
        }

        
        public function listeVehicules(){
            //renvoie tous les véhicules appartenant à la marque
        }
    }

?>