<?php

    function chargerClasse($classe){
        require('classes/'.$classe.'.php');
    }

    spl_autoload_register("chargerClasse");

    //on essaie de se connecter à la BDD
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=voitures;charset=utf8', 'root', '');
    }
    //si erreur : on l'affiche
    catch (Exception $e)
    {
        echo 'Erreur : ' . $e->getMessage();
    }

    $vm = new VehiculesManager($pdo);

    if(isset($_POST["marque"])){
        if(isset($_FILES)){
            $nom = $_FILES['image']['name'];
            $ext = substr(strrchr($nom, '.'), 1);
            $cible = "img/".microtime(true).".".$ext;
            
            move_uploaded_file($_FILES['image']["tmp_name"], $cible);
            $_POST["img"] = $cible;
        }
        if($_POST['typeVehicule'] == 'Voiture'){
            $vehicule = new Voiture();
            $vehicule->hydrate($_POST);
            $vm->creerVoiture($vehicule);
        }
        else if ($_POST['typeVehicule'] == 'Moto'){
            $vehicule = new Moto();
            $vehicule->hydrate($_POST);
            var_dump($vehicule);
            $vm->creerMoto($vehicule);
        }
        else if ($_POST['typeVehicule'] == 'Camion'){
            $vehicule = new Camion();
            $vehicule->hydrate($_POST);
            $vm->creerCamion($vehicule);
        }
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
    <script src="assets/main.js"></script>
</head>
<body>
<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-8 mx-auto ">
            <div class="card">
                <div class="card-header">
                    <h1>Nouveau véhicule</h1>
                    <a href="./"><<<</a>
                </div>

                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="marque">Marque</label><br>
                            <input type="text" id="marque" name="marque"><br>
                        </div>
                        <div class="form-group">
                            <label for="selecteur_marque">Marque</label><br>
                            <select name="marque" id="selecteur_marque">
                                <?php 
                                $marques = array(1, 2, 3, 4, 5);
                                foreach ($marques as $marque)
                                {
                                    ?>
                                    <option value="<?php echo $marque; ?>"> <?php echo $marque; ?></option>
                                    <?php 
                                }
                                ?>
                                <option id='nouvelle_marque' value="__NOUVELLE__">Ajouter une nouvelle marque...</option>
                            </select>
                            
                            <div id="nom_nouvelle_marque" class="form-group">
                                <br>
                                <label for="champ_nouvelle_marque">Nom de la nouvelle marque</label><br>
                                <input type="text" id="champ_nouvelle_marque" name="nomNouvMarque"><br>
                            </div>
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
                            <label for="selecteur_type">Catégorie de véhicule</label>
                            <select name="typeVehicule" id="selecteur_type">
                                <option selected="selected" value="Voiture">Voiture</option>
                                <option value="Camion">Camion</option>
                                <option value="Moto">Moto</option>
                            </select>
                        </div>
                        <div id="opt-voiture">
                            <div class="form-group">
                                <label for="nbrePortes">Nombre de portes</label><br>
                                <input type="number" id="nbrePortes" name="nbrePortes"><br>
                            </div>
                            <div class='form-group'>
                                <label for="decapotable">Décapotable ?</label>
                                <div class="form-check" id="decapotable" name="decapotable">
                                    <input class="form-check-input" type="radio" name="decapotable" id="flexRadioDefault1" value="1" checked>
                                    <label class="form-check-label" for="decapotable">Oui</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="decapotable" id="flexRadioDefault2" value="0">
                                    <label class="form-check-label" for="pasdecapotable">Non</label>
                                </div>
                            </div>
                        </div>

                        <div id="opt-moto">
                            <div class="form-group">
                                <label for="nbreRoues">Nombre de roues</label><br>
                                <input type="number" id="nbreRoues" name="nbreRoues"><br>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label><br>
                                <input type="text" id="type" name="type"><br>
                            </div>
                        </div>

                        <div id="opt-camion">
                            <div class="form-group">
                                <label for="nbrePortes">Poids à vide</label><br>
                                <input type="number" id="nbrePortes" name="nbrePortes"><br>
                            </div>
                            <div class="form-group">
                                <label for="nbrePortes">Poids maximal de charge</label><br>
                                <input type="number" id="nbrePortes" name="nbrePortes"><br>
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

<script>
    $(function() {
        $('#opt-camion').hide();
        $('#opt-moto').hide();
        $('#nom_nouvelle_marque').hide();

        $('#selecteur_type').change(function(){

            $('#opt-camion').hide();
            $('#opt-voiture').hide();
            $('#opt-moto').hide();
            console.log($( "#selecteur_type").val());
            
            if($( "#selecteur_type").val() == 'Camion'){
                $('#opt-camion').show();
            }
            else if ($( "#selecteur_type").val() == 'Voiture'){
                $('#opt-voiture').show();
            }
            else if ($( "#selecteur_type").val() == 'Moto'){
                $('#opt-moto').show();
            }
        });

        $('#selecteur_marque').change(function(){
            $('#nom_nouvelle_marque').hide();
            if($( "#selecteur_marque" ).val() == '__NOUVELLE__'){
                $('#nom_nouvelle_marque').show();
            }
        });
    });

</script>

</body>
</html>

