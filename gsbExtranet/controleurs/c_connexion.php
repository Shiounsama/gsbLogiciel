<?php


if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
$action = $_GET['action'];
$heure_connexion=date("y-m-d H:i:s");
switch($action){
    
    case 'cookies_accepter':{
            setcookie("Accepter","email", time()+15768000);
            $cookie = 1;
            include("vues/v_connexion.php");
            break;
        }

        case 'cookies_refuser':{
            setcookie("Temps_sur_site", $heure_connexion, time()+15768000);
            $cookie = 2;
            include("vues/v_sommaire.php");
            break;
        }
        
	case 'demandeConnexion':{
            include("vues/v_connexion.php");
            break;
	}
        
        case 'deConnexion':{
            $finlog = strtotime(date("y-m-d H:i:s"));
            $debutlog= strtotime($_SESSION['dateDebutLog']);
            setcookie("Temps_sur_site");
            $temps = $finlog-$debutlog;
            $pdo->deConnexion($_SESSION['dateDebutLog'], $_SESSION['id']);
            $_SESSION = array();
            session_destroy();
            include("vues/v_connexion.php");
            break;	
	}
        
	case 'valideConnexion':{
            
            $cle = $pdo->recupCleChiffrement();
            $nonce = $pdo->recupNonce();
            $login = sodium_crypto_secretbox($_POST['login'], $nonce, $cle);
            $mdp= $_POST['mdp'];
            setcookie("Temps_sur_site",$heure_connexion, time()+15768000);
            $password = md5(sha1($mdp));
            
            $connexionOk = $pdo->checkUser($login,$password);
            
            if(!$connexionOk){
                
                $erreur = "Login ou mot de passe incorrect";
                include("vues/v_connexion.php");
                break;
                
            } else {
                
                $infosMedecin = $pdo->donneLeMedecinByMail($login);
                $email = $login;
                $id = $infosMedecin['id'];
                $nom =  $infosMedecin['nom'];
                $prenom = $infosMedecin['prenom'];
                $access = $infosMedecin['access'];
                
                if ($access == 0){
                    $dateDebutLog = $pdo->connexion($id);
                    connecter($id,$nom,$email,$prenom,$access,$dateDebutLog);
                    include("vues/v_sommaire.php");
                    break;
                    
                } else {
                    $dateDebutLog = $pdo->connexion($id);
                    connecter($id,$nom,$email,$prenom,$access,$dateDebutLog);
                    header("Location: ../admin/index.php?uc=navigation&action=dashboard");
                }
                
            }

            
            break;	
	}
       
        
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>