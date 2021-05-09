<?php 
    class VoituresManager{

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
            $voitureObjet = new Voiture();
            $voitureObjet->hydrate($resultat);
            //return du résultat
            return $voitureObjet;
        }

        public function selectionnerTout(){
            $resultat = $this->_pdo->query("SELECT * FROM voiture;");
            $resultat = $resultat->fetchAll();

            $retour = array();
            foreach ($resultat as $voiture){
                $voitureObjet = new Voiture();
                $voitureObjet->hydrate($voiture);
                array_push($retour, $voitureObjet);
            }
            return $retour;
        }

        //fonction qui va créer une nouvelle voiture dans la base de données, à partir d'un objet de la classe Voiture
        public function creer(Voiture $voiture){
            $sql = "INSERT INTO voiture (marque, puissance, modele, km, img, transmission)
            VALUES(
                '".$voiture->getMarque()."',".
                (!empty($voiture->getPuissance()) ? "'".$voiture->getPuissance()."'": 'NULL').",".
                (!empty($voiture->getModele()) ? "'".$voiture->getModele()."'": "NULL").",".
                (!empty($voiture->getKm()) ? $voiture->getKm(): "NULL").",".
                (!empty($voiture->getImg()) ? "'".$voiture->getImg()."'": "NULL").",".
                (!empty($voiture->getBoiteBool()) ? $voiture->getBoiteBool(): "NULL")."
            );";
            // echo $sql;
            $this->getPdo()->exec($sql);
        }
    }
?>