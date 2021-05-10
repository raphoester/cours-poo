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
            $resultat = $this->_pdo->query("SELECT * FROM voiture WHERE id = $id;");
            //transformation du résultat en tableau
            $resultat = $resultat->fetch();
            //hydratation
            $vehiculeObjet = new Vehicule();
            $vehiculeObjet->hydrate($resultat);
            //return du résultat
            return $vehiculeObjet;
        }

        public function selectionnerTout(){
            $resultat = $this->_pdo->query("SELECT * FROM voiture;");
            $resultat = $resultat->fetchAll();

            $retour = array();
            foreach ($resultat as $vehicule){
                $vehiculeObjet = new Vehicule();
                $vehiculeObjet->hydrate($vehicule);
                array_push($retour, $vehiculeObjet);
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
            //INSERT INTO voiture (marque, puissance, modele, km, img, transmission, nbrePortes, decapotable)
            //VALUES("volvo", '50CV', 'super', 5000, "", 1, 1);
            $sql = $this->creerDebutRequete();
            $sql .= "nbrePortes, decapotable)";
            $sql .= $this->creerFinRequete($voiture);
            $sql .= (!empty($voiture->getnbrePortes()) ? $voiture->getnbrePortes(): "NULL").",".
            (!empty($voiture->getDecapotableBool()) ? $voiture->getDecapotableBool(): "NULL").
            ");";
            echo $sql."<br>";

            // $this->getPdo()->exec($sql);
        }

        public function creerMoto(){
            $sql = $this->creerDebutRequete();
            // echo $sql."<br>";
            $sql .= "nbreRoues, types)";
            // $this->getPdo()->exec($sql);
        }

        public function creerCamion(){
            $sql = $this->creerDebutRequete();
            // echo $sql."<br>";
            // $this->getPdo()->exec($sql);
        }

    }
?>