<?php

if(!isset($_GET['action'])){
    $_GET['action'] = 'connexion';
}

$action = $_GET['action'];
switch($action){
	
    case 'connexion':{
        include("vues/defaut/v_defaut_session_top.php");
        include("vues/session/v_connexion.php");
        include("vues/defaut/v_defaut_session_low.php");
        break;
    }
    
    case 'inscription':{
        include("vues/defaut/v_defaut_session_top.php");
        include("vues/session/v_inscription.php");
        include("vues/defaut/v_defaut_session_low.php");
        break;
    }
    
    case 'erreur':{
        include("vues/defaut/v_defaut_session_top.php");
        include("vues/session/v_erreur.php");
        include("vues/defaut/v_defaut_session_low.php");
        break;
    }
    case 'validationConnexion':{
        
        $login = htmlspecialchars($_POST['login']);
        $mdp= htmlspecialchars($_POST['mdp']);
            
        $password = md5(sha1($mdp));
        
        $connexionOk = $pdo->checkUser($login,$password);
            
        if(!$connexionOk){
                
            $erreur = "Login ou mot de passe incorrect";
            include("vues/defaut/v_defaut_session_top.php");
            include("vues/session/v_connexion.php");
            include("vues/defaut/v_defaut_session_low.php");
            break;
                
        } else {
                
            $infosMedecin = $pdo->donneLeMedecinByMail($login);
            $id = $infosMedecin['id'];
            $nom =  $infosMedecin['nom'];
            $prenom = $infosMedecin['prenom'];
            $access = $infosMedecin['access'];
            
            if ($access == 0){
                $erreur = "Vous n'avez pas les autorisations d'accès administrateur"; 
                include("vues/defaut/v_defaut_session_top.php");
                include("vues/session/v_connexion.php");
                include("vues/defaut/v_defaut_session_low.php");
                
            } else {   
                $dateDebutLog = $pdo->connexion($id);
                connecter($id,$nom,$prenom,$access,$dateDebutLog);
                header("Location: index.php?uc=navigation&action=dashboard");
                break;
            }
                
        }
        break;
    }
    
    case 'deconnexion':{
        $pdo->deConnexion($_SESSION['dateDebutLog'], $_SESSION['id']);
        $_SESSION = array();
        session_destroy();
        include("vues/defaut/v_defaut_session_top.php");
        include("vues/session/v_connexion.php");
        include("vues/defaut/v_defaut_session_low.php");
        break;
    }
}
?>
