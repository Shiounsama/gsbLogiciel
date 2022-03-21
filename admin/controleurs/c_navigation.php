<?php

if(!isset($_GET['action'])){
    $_GET['action'] = 'defaut';
}

$action = $_GET['action'];
switch($action){
	
    case 'defaut':{
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        break;
    }
    
    case 'dashboard':{
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_dashboard.php");
        break;
    }
    
    case 'gestion_produits':{
        $lesProduits=$pdo->donneLesProduits();
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_gestion_produits.php");
        break;
    }
 
    case 'gestion_visios':{
        $lesVisios=$pdo->donneLesVisios();
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_gestion_visios.php");
        //include("vues/defaut/v_defaut.php");
        break;
    }
    
    case 'gestion_comptes':{
        $lesComptes=$pdo->donneLesComptes();
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_gestion_comptes.php");
        break;
    }
    
    case 'gestion_maintenance':{
        $lesMaintenances=$pdo->donneLesMaintenances();
        $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_gestion_maintenance.php");
        //include("vues/defaut/v_defaut.php");
        break;
    }
    
    case 'documentation':{
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_documentation.php");
        //include("vues/defaut/v_defaut.php");
        break;
    }
}
?>
