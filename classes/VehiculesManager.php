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
        public function creer(Vehicule $vehicule){
            $sql = "INSERT INTO voiture (marque, puissance, modele, km, img, transmission)
            VALUES(
                '".$vehicule->getMarque()."',".
                (!empty($vehicule->getPuissance()) ? "'".$vehicule->getPuissance()."'": 'NULL').",".
                (!empty($vehicule->getModele()) ? "'".$vehicule->getModele()."'": "NULL").",".
                (!empty($vehicule->getKm()) ? $vehicule->getKm(): "NULL").",".
                (!empty($vehicule->getImg()) ? "'".$vehicule->getImg()."'": "NULL").",".
                (!empty($vehicule->getBoiteBool()) ? $vehicule->getBoiteBool(): "NULL")."
            );";
            // echo $sql;
            $this->getPdo()->exec($sql);
        }
    }
?>