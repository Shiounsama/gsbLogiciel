<?php

if(!isset($_GET['gestion'])){
    $_GET['gestion'] = 'erreur';
}

$gestion = $_GET['gestion'];
switch($gestion){
	
    
    /*  GESTION DES PRODUITS  */
    case 'ajouter_produit':{
        
        $nom = htmlspecialchars($_POST['titreProduit']);
        $objectif = htmlspecialchars($_POST['objectif']);
        $information = htmlspecialchars($_POST['information']);
        $effet = htmlspecialchars($_POST['effetIndesirable']);
        
        if(!empty($_POST['titreProduit']) AND !empty($_POST['objectif']) AND !empty($_POST['information']) AND !empty($_POST['effetIndesirable'])   ){
            
            $pdo->ajouterProduit($nom, $objectif, $information, $effet);
            $lesProduits=$pdo->donneLesProduits();
            $validation = "Votre produit a été ajouté avec success.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_produits.php");
            break;
            
        } else {
            $erreur = "Merci d'indiquer tous les champs s'il vous plaît.";
            $lesProduits=$pdo->donneLesProduits();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_produits.php");
            break;
        }
    }
    
    case 'modification_produit':{
        $id = htmlspecialchars($_POST['modification_produit']);
        $leProduit=$pdo->afficheLeProduit($id); 
        $lesProduits=$pdo->donneLesProduits();
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_gestion_modification_produits.php");
        break;
    }
    
    case 'modifier_produit':{
        
        $nom = htmlspecialchars($_POST['titreProduit']);
        $objectif = htmlspecialchars($_POST['objectif']);
        $information = htmlspecialchars($_POST['information']);
        $effet = htmlspecialchars($_POST['effetIndesirable']);
        $id = htmlspecialchars($_POST['id']);
        
        if(!empty($_POST['titreProduit']) AND !empty($_POST['objectif']) AND !empty($_POST['information']) AND !empty($_POST['effetIndesirable']) AND !empty($_POST['id'])){
            
            $pdo->modificationProduit($nom, $objectif, $information, $effet, $id);
            $validation = "Votre produit a été modifié avec success.";
            $lesProduits=$pdo->donneLesProduits();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_produits.php");
            break;
            
        } else {
            $erreur = "Merci d'indiquer tous les champs s'il vous plaît.";
            $leProduit=$pdo->afficheLeProduit($id); 
            $lesProduits=$pdo->donneLesProduits();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_modification_produits.php");
            break;
        }
    }
    
    case 'supprimer_produit':{
        
        $id = htmlspecialchars($_POST['supprimer_produit']);
        
        if(!empty($_POST['supprimer_produit'])){
            
            $pdo->supprimerProduit($id);
            $lesProduits=$pdo->donneLesProduits();
            $validation_list = "Votre produit a été supprimé avec success.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_produits.php");
            break;
            
        } else {
            $lesProduits=$pdo->donneLesProduits();
            $erreur_list = "Merci de selectionner un produit s'il vous plaît.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_produits.php");
            break;
        }
    }
    
    /*  GESTION DE LA MAINTENANCE  */
    
    case 'activation_maintenance':{
        
        $id = htmlspecialchars($_POST['activation_maintenance']);
        
        if(!empty($_POST['activation_maintenance'])){
            
            $validation = "Votre maintenance a été activé avec success.";
            $pdo->activationMaintenance($id);
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");;
            break;
            
        } else {
            
            $erreur = "Merci de selectionner une maintenance s'il vous plaît.";
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");;
            break;
        }
    }
    
    case 'desactivation_maintenance':{
        
        $id = htmlspecialchars($_POST['desactivation_maintenance']);
        
        if(!empty($_POST['desactivation_maintenance'])){
            
            $validation = "Votre maintenance a été desactivé avec success.";
            $pdo->desactivationMaintenance($id);
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");;
            break;
            
        } else {
            
            $erreur = "Merci de selectionner une maintenance s'il vous plaît.";
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");;
            break;
        }
    }
    
    case 'activation_maintenancePrevention':{
        
        $id = htmlspecialchars($_POST['activation_maintenancePrevention']);
        
        if(!empty($_POST['activation_maintenancePrevention'])){
            
            $validation = "Votre prévention a été activé avec success.";
            $pdo->activationMaintenancePrevention($id);
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");;
            break;
            
        } else {
            
            $erreur = "Merci de selectionner une prévention s'il vous plaît.";
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");;
            break;
        }
    }
    
    case 'desactivation_maintenancePrevention':{
        
        $id = htmlspecialchars($_POST['desactivation_maintenancePrevention']);
        
        if(!empty($_POST['desactivation_maintenancePrevention'])){
            
            $validation = "Votre prévention a été activé avec success.";
            $pdo->desactivationMaintenancePrevention($id);
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");
            break;
            
        } else {
            
            $erreur = "Merci de selectionner une prévention s'il vous plaît.";
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");
            break;
        }
    }
    
    case 'modification_maintenance':{
        $id = htmlspecialchars($_POST['modification_maintenance']);
        $laMaintenance=$pdo->afficheLaMaintenance($id);
        $laMaintenancePrevention=$pdo->afficheLaMaintenancePrevention($id);
        $lesMaintenances=$pdo->donneLesMaintenances();
        $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_gestion_modification_maintenance.php");
        break;
    }
    
    case 'modifier_maintenance':{
        
        $nom = htmlspecialchars($_POST['nomMaintenance']);
        $messagePrevention = htmlspecialchars($_POST['messagePrevention']);
        $messageMaintenance = htmlspecialchars($_POST['messageMaintenance']);
        $dateDeDebut = htmlspecialchars($_POST['dateDeDebut']);
        $dateDeFin = htmlspecialchars($_POST['dateDeFin']);
        $id = htmlspecialchars($_POST['id']);
        
        if(!empty($_POST['nomMaintenance']) AND !empty($_POST['messagePrevention']) AND !empty($_POST['messageMaintenance']) AND !empty($_POST['dateDeDebut']) 
                AND !empty($_POST['dateDeFin']) AND !empty($_POST['id'])){
            
            $pdo->modificationMaintenance($nom, $messagePrevention, $messageMaintenance, $dateDeDebut, $dateDeFin, $id);
            $validation = "Votre maintenance a été modifié avec success.";
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_maintenance.php");
            break;
            
        } else {
            $erreur = "Merci d'indiquer tous les champs s'il vous plaît.";
            $laMaintenance=$pdo->afficheLaMaintenance($id);
            $laMaintenancePrevention=$pdo->afficheLaMaintenancePrevention($id);
            $lesMaintenances=$pdo->donneLesMaintenances();
            $lesMaintenancesPrevention=$pdo->donneLesMaintenancesPrevention();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_modification_maintenance.php");
            break;
        }
    }
    
    /*  GESTION DES VISIOS  */
    
    case 'ajouter_visio':{
        
        $nom = htmlspecialchars($_POST['nom']);
        $url = htmlspecialchars($_POST['url']);
        $objectif = htmlspecialchars($_POST['objectif']);
        $dateDeDebut = htmlspecialchars($_POST['dateDeDebut']);
        
        if(!empty($_POST['nom']) AND !empty($_POST['url']) AND !empty($_POST['objectif']) AND !empty($_POST['dateDeDebut'])){
            
            $pdo->ajouterVisio($nom, $url, $objectif, $dateDeDebut);
            $lesVisios=$pdo->donneLesVisios();
            $validation = "Votre visioconférence a été ajouté avec success.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
            
        } else {
            $erreur = "Merci d'indiquer tous les champs s'il vous plaît.";
            $lesVisios=$pdo->donneLesVisios();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
        }
    }
    
    case 'activation_visio':{
        
        $id = htmlspecialchars($_POST['activation_visio']);
        
        if(!empty($_POST['activation_visio'])){
            
            $validation_list = "Votre visioconférence a été activé avec success.";
            $pdo->activationVisio($id);
            $lesVisios=$pdo->donneLesVisios();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
            
        } else {
            
            $erreur_list = "Merci de selectionner une visioconférence s'il vous plaît.";
            $lesVisios=$pdo->donneLesVisios();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
        }
    }
    
    case 'desactivation_visio':{
        
        $id = htmlspecialchars($_POST['desactivation_visio']);
        
        if(!empty($_POST['desactivation_visio'])){
            
            $validation_list = "Votre visioconférence a été desactivé avec success.";
            $pdo->desactivationVisio($id);
            $lesVisios=$pdo->donneLesVisios();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
            
        } else {
            
            $erreur_list = "Merci de selectionner une visioconférence s'il vous plaît.";
            $lesVisios=$pdo->donneLesVisios();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
        }
    }
    
    case 'modification_visio':{
        $id = htmlspecialchars($_POST['modification_visio']);
        $laVisio=$pdo->afficheLaVisio($id); 
        $lesVisios=$pdo->donneLesVisios();
        include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
        include("vues/v_gestion_modification_visios.php");
        break;
    }
    
    case 'modifier_visio':{
        
        $nom = htmlspecialchars($_POST['nom']);
        $url = htmlspecialchars($_POST['url']);
        $objectif = htmlspecialchars($_POST['objectif']);
        $dateDeDebut = htmlspecialchars($_POST['dateDeDebut']);
        $id = htmlspecialchars($_POST['id']);
        
        if(!empty($_POST['nom']) AND !empty($_POST['url']) AND !empty($_POST['objectif']) AND !empty($_POST['dateDeDebut']) AND !empty($_POST['id'])){
            
            $pdo->modificationVisio($nom, $objectif, $url, $dateDeDebut, $id);
            $validation = "Votre visioconférence a été modifié avec success.";
            $lesVisios=$pdo->donneLesVisios();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
            
        } else {
            $erreur = "Merci d'indiquer tous les champs s'il vous plaît.";
            $lesVisios=$pdo->donneLesVisios();
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_modification_visios.php");
            break;
        }
    }
    
    case 'supprimer_visio':{
        
        $id = htmlspecialchars($_POST['supprimer_visio']);
        
        if(!empty($_POST['supprimer_visio'])){
            
            $pdo->supprimerVisio($id);
            $lesVisios=$pdo->donneLesVisios();
            $validation_list = "Votre visioconférence a été supprimé avec success.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
            
        } else {
            $lesVisios=$pdo->donneLesVisios();
            $erreur_list = "Merci de selectionner une visioconférence s'il vous plaît.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_visios.php");
            break;
        }
    }
    
    case 'supprimer_compte':{
        
        $id = htmlspecialchars($_POST['supprimer_compte']);
        
        if(!empty($_POST['supprimer_compte'])){
            
            $pdo->supprimerCompte($id);
            $lesComptes=$pdo->donneLesComptes();
            $validation = "Le compte a été supprimé avec success.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_comptes.php");
            break;
            
        } else {
            $lesComptes=$pdo->donneLesComptes();
            $erreur = "Merci de selectionner un compte s'il vous plaît.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_comptes.php");
            break;
        }
    }
    
    case 'archivage_compte':{
        
        $id = htmlspecialchars($_POST['archivage_compte']);
        
        if(!empty($_POST['archivage_compte'])){
            
            $pdo->archiverMedecin($id);
            $lesComptes=$pdo->donneLesComptes();
            $validation = "Le compte a été archivé avec success.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_comptes.php");
            break;
            
        } else {
            $lesComptes=$pdo->donneLesComptes();
            $erreur = "Merci de selectionner un compte s'il vous plaît.";
            include("vues/defaut/v_defaut_a_copier.php"); /*toujours copier cette vue pour un meilleur rendu :)*/
            include("vues/v_gestion_comptes.php");
            break;
        }
    }
    
}
?>