<?php 
    class VoituresManager{

        //attribut privé _pdo : permet de stocker les informations de connexion à la BDD.
        private $_pdo;

        //constructeur qui initialise le _pdo
        public function __construct()
        {
            //on essaie de se connecter
            try{
                $this->_pdo = new PDO('mysql:host=localhost;dbname=voitures;charset=utf8', 'root', '');
            }

            //si erreur : on l'affiche
            catch (Exception $e)
            {
                echo 'Erreur : ' . $e->getMessage();
            }
        }
        
        //fonction qui permet de sélectionner une voiture à partir de son ID
        public function selectionner($id){
            //requête SQL
            $resultat = $this->_pdo->query("SELECT * FROM voiture WHERE id_voiture = $id;");
            //transformation du résultat en tableau
            $resultat = $resultat->fetchAll();
            //return du résultat
            return $resultat;
        }

        //fonction qui va créer une nouvelle voiture dans la base de données, à partir d'un objet de la classe Voiture
        public function creer(Voiture $voiture){

        }
    }
?>