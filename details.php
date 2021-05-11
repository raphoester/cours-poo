<?php 
    if(!isset($_GET["id"])){
        header("Location: index.php");
    }

    function chargerClasse($classe){
        require('classes/'.$classe.'.php');
    }
    spl_autoload_register('chargerClasse');

    try{
        $pdo = new PDO('mysql:host=localhost;dbname=voitures;charset=utf8', 'root', '');
    }
    finally{}


    $vm = new VehiculesManager($pdo);
    $vehicule = $vm->selectionner($_GET['id']);
    if($vehicule == false){
        header("Location: 404.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Détails du véhicule</title>
</head>
<body>
<div class="container">
    <div class="mt-5" >
        <a href="index.php"><<<</a>
        <h1>Détails sur le véhicule #<?php echo $vehicule->getId(); ?></h1>
    </div>
    <div class="row">
        <div class="col-md-6 row-img">
            <a href="<?php echo $vehicule->getImg()?>"><img src="<?php echo $vehicule->getImg()?>" class="img-fluid" style="object-fit: cover;" alt=""/></a>
        </div>
        <div class="col-md-4">
            <br>
            <ul class="list-group" style="float: left; min-width: 500px;">
                <li class="list-group-item">Marque : <?php echo $vehicule->getMarque() ;?></li>
                <li class="list-group-item">Modèle : <?php echo $vehicule->getModele() ;?></li>
                <li class="list-group-item">Puissance : <?php echo $vehicule->getPuissance() ;?></li>
                <li class="list-group-item">KM : <?php echo $vehicule->getKm() ;?></li>
                <li class="list-group-item">Transmission : <?php echo $vehicule->getBoite() ;?></li>
                <li class="list-group-item">Type de véhicule : <?php echo $vehicule->getTypeVehicule() ;?></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>