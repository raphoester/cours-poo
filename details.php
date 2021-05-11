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
    $vm = new VehiculesManager($pdo);
    $voiture33 = $vm->selectionner(33);
    var_dump($voiture33);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>