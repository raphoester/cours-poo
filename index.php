<?php 

    require("voiture.php");

    $voiture1 = new Voiture("audi", "50CV", "A3", 4000);

    echo $voiture1->getMarque();
    var_dump($voiture1);

?>