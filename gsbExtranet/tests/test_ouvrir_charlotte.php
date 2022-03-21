<?php

require_once ("../include/class.pdogsb.inc.php");

$fichier = file("../css/Charlote_aux_fraise.txt"); // Nom du fichier à afficher, son adresse de localisation
    echo $total = count($fichier); // Nombre total des lignes du fichier
    for($i = 0; $i < $total; $i++)
    { // Départ de la boucle
    $cle = $fichier[$i]; // On affiche ligne par ligne le contenu du fichier
    }

