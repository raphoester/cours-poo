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

    //créer un manager de voitures
    $vm = new VoituresManager();
    //récupérer un tableau de voitures
    $voitures = $vm->selectionner(1)
    //l'afficher en brut (provisoire)
    echo "<pre>";
    print_r($voitures);
    echo "</pre>";

    //création artificielle de plusieurs instances d'objets de la classe voiture, pour l'affichage
    $voiture1 = new Voiture(1, "Audi", "50CV", "A3", 4000, 'img/audi_a3.jpg', Voiture::TRANSMISSION_MAN);
    $voiture2 = new Voiture(2, "Opel", "70CV", "1900GT", 70000, 'img/opel_1900GT.jpg', Voiture::TRANSMISSION_MAN);
    $voiture3 = new Voiture(3, "Chevrolet", "250CV", "Camaro", 35000, 'img/chevrolet_camaro.jpg', Voiture::TRANSMISSION_AUTO);
    
    //transformation en tableau pour utiliser foreach
    $voitures = array($voiture1, $voiture2, $voiture3);

    ?>

    <div class="container">
        <div class="title" style='margin-top: 100px; margin-bottom: 50px;'>
            <h1>Liste des voitures<a href="creation_voiture">+</a></h1> 
        </div>
        <div class="row g-2">
            <?php
            foreach ($voitures as $voiture) {
                ?>
                    <div class="col-6" style="width: 100px; margin-bottom: 20px;">
                        <div class="p-3 border bg-light" style="display: flex;">
                            <div style="margin-right: 100px;">
                                <img style="width: 200px; object-fit: cover; height: 200px;" class="d-flex align-self-start" src="<?php echo $voiture->getImg()?>">
                            </div>
                            <div style="margin-top : 30px;">
                                <h4><?php echo $voiture->getMarque()." ".$voiture->getModele()?></h4>
                                <p> <?php echo $voiture->getPuissance()?> </p>
                                <p> <?php echo $voiture->getKm() ?> KM </p>
                                <p> Transmission : <?php echo $voiture->getBoite() ?> <p>
                                <p><a href="<?php echo $voiture->getImg()?>">Détails</a></p>
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

