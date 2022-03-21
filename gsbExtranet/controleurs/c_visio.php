<?php

if(!isset($_GET['action'])){
    $_GET['action'] = 'demandeVisio';
}
$action = $_GET['action'];
switch($action){

    case 'demandeVisio':{
        include("vues/v_produit.php");
        break;
    }

    case 'valideVisio':{

        $pdo= PdoGsb::getPdoGsb();
        $lesVisios=$pdo->donneLesVisios(); 
        include("vues/v_visio.php");
        break;
    }

      case 'selectVisio' :{
        $id = $_GET['id'];
        $pdo= PdoGsb::getPdoGsb();
        $laVisio=$pdo->afficheLaVisio($id); 
        include("vues/v_afficheVisio.php");
        break;
    }




default :{
        include("vues/v_visio.php");
        break;
    }
}
?>