<?php 

    require("voiture.php");

    $voiture1 = new Voiture("audi", "50CV", "A3", -5000);

    echo $voiture1->getMarque();
    echo $voiture1->_marque;

?>