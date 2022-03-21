<?php

if(!isset($_GET['action'])){
    $_GET['action'] = 'demandeProduit';
}
$action = $_GET['action'];
switch($action){

    case 'demandeProduit':{
        include("vues/v_produit.php");
        break;
    }

    case 'valideProduit':{

        $pdo= PdoGsb::getPdoGsb();
        $lesProduits=$pdo->donneLesProduits();
        include("vues/v_produit.php");
        break;
    }

    case 'selectProduit' :{
        $id = $_GET['id'];
        $pdo= PdoGsb::getPdoGsb();
        $leProduit=$pdo->afficheLeProduit($id); 
        include("vues/v_afficheProduit.php");
        break;
    }


default :{
        include("vues/v_produit.php");
        break;
    }
}
?>