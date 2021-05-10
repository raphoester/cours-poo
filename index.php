<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 

    //fonction qui charge les classes,
    //appelée par le PHP grâce à spl_autoload_register
    function chargerClasse($classe){
        require('classes/'.$classe.'.php');
    }

    //indique au PHP quelle est la fonction qui charge les classes.
    //cette fonction est ensuite appelée à chaque fois qu'une classe est manquante
    //on évite ainsi de spammer la fonction require().
    spl_autoload_register('chargerClasse');

    //on essaie de se connecter à la BDD
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=voitures;charset=utf8', 'root', '');
    }
    //si erreur : on l'affiche
    catch (Exception $e)
    {
        echo 'Erreur : ' . $e->getMessage();
    }

    //créer un manager de voitures
    $vm = new VehiculesManager($pdo);
    // $vm->creerMoto();
    // $vm->creerCamion();

    $voiture = new Voiture(5, Voiture::DECAPOTABLE, "", "Lamborghini", "170CV", "Aventador", 20000, "", Vehicule::TRANSMISSION_AUTO);
    $vm->creerVoiture($voiture);
    
    

    //récupérer un tableau de voitures
    // $vehicules = $vm->selectionnerTout();

    // $camion = new Camion(40, 10, "", "Volvo", "250CV", "FH", 10000, "", Vehicule::TRANSMISSION_AUTO);
    // $voiture = new Voiture(5, Voiture::DECAPOTABLE, "", "Lamborghini", "170CV", "Aventador", 20000, "", Vehicule::TRANSMISSION_AUTO);
    // $moto = new Moto(2, "Motocross", "", "Yamaha", "10CV", "Super", 15000, "", Vehicule::TRANSMISSION_MAN);
    
    
    // var_dump($camion);
    // var_dump($voiture);
    // var_dump($moto);



    ?>

    <div class="container">
        <div class="title mt-5 mb-4">
            <h1>Liste des véhicules<a href="creation_vehicule.php">+</a></h1> 
            
        </div>
        <div class="row g-2">
            <?php
            foreach ($vehicules as $vehicule) {
                ?>
                    <div class="col-6 mb-1" style="width: 100px;">
                        <div class="p-3 border bg-light" style="display: flex;">
                            <div style="margin-right: 100px;">
                                <img style="width: 200px; object-fit: cover; height: 200px;" class="d-flex align-self-start img-fluid" src="<?php echo $vehicule->getImg()?>">
                            </div>
                            <div style="margin-top : 30px;">
                                <h4><?php echo $vehicule->getMarque()." ".$vehicule->getModele()?></h4>
                                <p> <?php echo $vehicule->getPuissance()?> </p>
                                <p> <?php echo $vehicule->getKm() ?> KM </p>
                                <p> Transmission : <?php echo $vehicule->getBoite() ?> <p>
                                <p><a href="<?php echo $vehicule->getImg()?>">Détails</a></p>
                            </div>
                        </div>
                    </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>
    <script src="assets/main.js"></script>
</html>

