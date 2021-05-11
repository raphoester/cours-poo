<?php
    class MarquesManager{
        private $pdo;
        
        public function __construct($pdo){
            $this->setPdo($pdo);
        }

        public function getPdo(){
            return $this->_pdo;
        }
        public function setPdo($pdo){
            $this->_pdo = $pdo;
        }

        public function vehiculesDeMarque($id_marque){
            //renvoie tous les véhicules qui appartiennent à une marque donnée
        }

        public function selectionnerMarque($id_marque){
            //renvoie le nom d'une marque 
            $sql = "SELECT * FROM marque WHERE id = '".$id_marque."';";
            $resultat = $this->getPdo()->query($sql)->fetch();
            $marque = new Marque();
            $marque->hydrate($resultat);
            return $marque;
        }

        public function selectionnerTout(){
            //renvoie toutes les marques existantes
            $sql = "SELECT * FROM marque ;";
            $resultat = $this->getPdo()->query($sql)->fetchAll();
            
            $retour = array();
            foreach ($resultat as $marque){
                $m = new Marque();
                $m->hydrate($marque);
                array_push($retour, $m);
            }
            return $retour;
        }

        public function creerMarque(Marque $marque){
            //crée une nouvelle marque
            $sql = "INSERT INTO marque (nom) VALUES('".$marque->getNom()."');";
            $this->getPdo()->exec($sql);
            $sql2 = "SELECT id FROM marque where nom = '".$marque->getNom()."';";
            //echo $sql2;
            $idMarque = $this->getPdo()->query($sql2)->fetch()["id"];
            return $idMarque;
        }
    }
?>