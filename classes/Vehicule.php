<?php 
    abstract class Vehicule{
        private $_id;
        private $_marque;
        private $_puissance;
        private $_modele;
        private $_km;
        private $_img;
        private $_boite;
        private $_typeVehicule;

        //constructeur
        //permet d'initialiser chaque instance de l'objet créé
        public function __construct($id="", $marque="", $puissance="", $modele="", $km="", $img="", $boite="", $typeVehicule=""){
            $this->setId($id);
            $this->setMarque($marque);
            $this->setPuissance($puissance);
            $this->setModele($modele);
            $this->setKm($km);
            $this->setImg($img);
            $this->setBoite($boite);
            $this->setTypeVehicule($typeVehicule);
        }

        public function hydrate(array $donnees){
            foreach ($donnees as $cle => $valeur){
                $methode = 'set'.ucfirst($cle);
                if(method_exists($this, $methode)){
                    $this->$methode($valeur);
                }
            }
        }
        
        //constantes de classe
        const TRANSMISSION_AUTO = 0;
        const TRANSMISSION_MAN = 1;
        //ERR_DATA : code d'erreur générique qui servira à chaque fois 
        //qu'une erreur survient dans un getter
        const ERR_DATA = "Null";

        //GETTERS (accesseurs)
        //permet d'accéder à la donnée de manière sécurisée
        public function getId(){
            return $this->_id;
        }
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
        public function getTypeVehicule(){
            return $this->_typeVehicule;
        }

        //self : permettre d'accéder à une constante de classe,
        //à l'intérieur de cette même classe.
        //Ici, c'est l'équivalent de Vehicule::CONSTANTE
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
        public function getBoiteBool(){
            return $this->_boite;
        }


        //SETTER (définisseurs)
        public function setId($id){
            if(!is_integer($id)){
                try{
                    $id = intval($id);
                }
                finally{}
            } 
            if($id > 0){
                $this->_id = $id;
            }
        }

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
            if(!is_integer($km)){
                try{
                    $km = intval($km);
                }
                finally{}
            } 
            if($km > 0){
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
            if(!is_bool($boite)){
                try{
                    $boite = boolval($boite);
                }
                finally{}
            }
            if(in_array($boite, [self::TRANSMISSION_MAN, self::TRANSMISSION_AUTO]))
            {
                $this->_boite = $boite;
            }
        }

        public function setTypeVehicule($typeVehicule){
            if($typeVehicule != "")
            {
                $this->_typeVehicule = $typeVehicule;
            }
        }
    }