<?php

    function chargerClasse($classe){
        require('classes/'.$classe.'.php');
    }

    spl_autoload_register("chargerClasse");


    if(isset($_POST["marque"])){
        if(isset($_FILES)){
            $nom = $_FILES['image']['name'];
            $ext = substr(strrchr($nom, '.'), 1);
            $cible = "img/".microtime(true).".".$ext;
            
            move_uploaded_file($_FILES['image']["tmp_name"], $cible);
            $_POST["img"] = $cible;
        }
        $voiture = new Voiture();
        $voiture->hydrate($_POST);

        //on essaie de se connecter à la BDD
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=voitures;charset=utf8', 'root', '');
        }
        //si erreur : on l'affiche
        catch (Exception $e)
        {
            echo 'Erreur : ' . $e->getMessage();
        }

        $vm = new VoituresManager($pdo);
        $vm->creer($voiture);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-8 mx-auto ">
            <div class="card">
                <div class="card-header">
                    <h1>Nouvelle voiture</h1>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="marque">Marque</label><br>
                            <input type="text" id="marque" name="marque"><br>
                        </div>
                        <div class="form-group">
                            <label for="modele">Modèle</label><br>
                            <input type="text" id="modele" name="modele"><br>
                        </div>
                        <div class="form-group">
                            <label for="puissance">Puissance</label><br>
                            <input type="text" id="puissance" name="puissance"><br>
                        </div>
                        <div class="form-group">
                            <label for="km">Kilomètres</label><br>
                            <input type="number" id="km" name="km"><br>
                        </div>
                        <div class='form-group'>
                            <label for="boite">Transmission</label>
                            <div class="form-check" id="boite" name="boite">
                                <input class="form-check-input" type="radio" name="boite" id="flexRadioDefault1" value="1" checked>
                                <label class="form-check-label" for="manu">Manuelle</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="boite" id="flexRadioDefault2" value="0">
                                <label class="form-check-label" for="auto">Automatique</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label><br>
                            <input type="file" id="image" name="image" accept="image/*"><br>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Valider">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>