<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
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

    $voiture1 = new Voiture("Audi", "50CV", "A3", 4000, 'img/audi_a3.jpg', Voiture::TRANSMISSION_MAN);
    $voiture2 = new Voiture("Opel", "70CV", "1900GT", 70000, 'img/opel_1900GT.jpg', Voiture::TRANSMISSION_MAN);
    $voiture3 = new Voiture("Chevrolet", "250CV", "Camaro", 35000, 'img/chevrolet_camaro.jpg', Voiture::TRANSMISSION_AUTO);

    $voitures = array($voiture1, $voiture2, $voiture3);
    ?>

    <div style="display:flex;">
    <?php
    foreach ($voitures as $voiture) {
        ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo $voiture->getImg()?>" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text"><strong><?php echo $voiture->getMarque()." ".$voiture->getModele()?></strong></p>
                    <p> <?php echo $voiture->getPuissance()?> </p>
                    <p> <?php echo $voiture->getKm() ?> KM </p>
                    <p> Transmission : <?php echo $voiture->getBoite() ?> <p>
                </div>
            </div>
        <?php
    }
    ?>
    </div>
</body>
</html>
