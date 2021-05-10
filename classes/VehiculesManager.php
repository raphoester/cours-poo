<?php 
    class VehiculesManager{

        //attribut privé _pdo : permet de stocker les informations de connexion à la BDD.
        private $_pdo;

        //constructeur qui initialise le _pdo
        public function __construct($pdo)
        {
            $this->setPdo($pdo);
        }

        public function getPdo(){
            return $this->_pdo;
        }

        public function setPdo($pdo){
            $this->_pdo = $pdo;
        }
        
        //fonction qui permet de sélectionner une voiture à partir de son ID
        public function selectionner($id){
            //requête SQL
            $resultat = $this->_pdo->query("SELECT * FROM vehicule WHERE id = $id;");
            //transformation du résultat en tableau
            $resultat = $resultat->fetch();
            //hydratation
            $vehiculeObjet = new Vehicule();
            $vehiculeObjet->hydrate($resultat);
            //return du résultat
            return $vehiculeObjet;
        }

        public function selectionnerTout(){
            $resultat = $this->_pdo->query("SELECT * FROM vehicule;");
            $resultat = $resultat->fetchAll();

            $retour = array();
            foreach ($resultat as $vehicule){

                $vehiculeInvalide = false;

                if($vehicule["typeVehicule"] == "Voiture"){
                    $vehiculeObjet = new Voiture();
                }
                else if($vehicule["typeVehicule"] == "Moto"){
                    $vehiculeObjet = new Moto();
                }
                else if($vehicule["typeVehicule"] == "Camion"){
                    $vehiculeObjet = new Camion();
                }
                else{
                    $vehiculeInvalide = true;
                }

                if(!$vehiculeInvalide){
                    $vehiculeObjet->hydrate($vehicule);
                    array_push($retour, $vehiculeObjet);
                }
            }
            return $retour;
        }

        //fonction qui va créer une nouvelle voiture dans la base de données, à partir d'un objet de la classe Voiture
        private function creerDebutRequete(){
            return "INSERT INTO vehicule (marque, puissance, modele, km, img, transmission, ";
        }

        private function creerFinRequete(Vehicule $vehicule){
            $sql = " VALUES(
                '".$vehicule->getMarque()."',".
                (!empty($vehicule->getPuissance()) ? "'".$vehicule->getPuissance()."'": 'NULL').",".
                (!empty($vehicule->getModele()) ? "'".$vehicule->getModele()."'": "NULL").",".
                (!empty($vehicule->getKm()) ? $vehicule->getKm(): "NULL").",".
                (!empty($vehicule->getImg()) ? "'".$vehicule->getImg()."'": "NULL").",".
                (!empty($vehicule->getBoiteBool()) ? $vehicule->getBoiteBool(): "NULL").",";
            return $sql;
        }

        public function creerVoiture(Voiture $voiture){
            $sql = $this->creerDebutRequete();
            $sql .= "nbrePortes, decapotable)";
            $sql .= $this->creerFinRequete($voiture);
            //ajout des champs spécifiques à la voiture
            $sql .= (!empty($voiture->getNbrePortes()) ? $voiture->getNbrePortes(): "NULL").",".
            (!empty($voiture->getDecapotableBool()) ? $voiture->getDecapotableBool(): "NULL").
            ");";
            $this->getPdo()->exec($sql);
        }

        public function creerMoto(Moto $moto){
            $sql = $this->creerDebutRequete();
            $sql .= "nbreRoues, type)";
            $sql .= $this->creerFinRequete($moto);
            $sql .= (!empty($moto->getNbreRoues()) ? $moto->getNbreRoues(): "NULL").",".
            (!empty($moto->getType()) ? "'".$moto->getType()."'" : "NULL").
            ");";
            $this->getPdo()->exec($sql);
        }

        public function creerCamion(Camion $camion){
            $sql = $this->creerDebutRequete();
            $sql .= "chargeMax, poidsVide, chargeActuelle)";
            $sql .= $this->creerFinRequete($camion);
            $sql .= (!empty($camion->getChargeMax()) ? $camion->getChargeMax(): "NULL").",".
            (!empty($camion->getPoidsVide()) ? $camion->getPoidsVide(): "NULL").",".
            (!empty($camion->getChargeActuelle()) || $camion->getChargeActuelle() == 0 ? $camion->getChargeActuelle(): "NULL").
            ");";
            $this->getPdo()->exec($sql);
        }
    }
?>