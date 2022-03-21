<?php

if(!isset($_GET['action'])){
	$_GET['action'] = 'mes_informations';
}

$action = $_GET['action'];
switch($action){
	
	case 'mes_informations':{
            include("vues/v_profil.php");
                
            break;
	}
        case 'modifier':{
            
            $nom = trim(htmlspecialchars($_POST['nom']));
            $prenom = trim(htmlspecialchars($_POST['prenom']));
            $password = trim(htmlspecialchars($_POST['password']));
            $passwordVerif = trim(htmlspecialchars($_POST['passwordVerif']));
            
            if(strlen($nom) == 0 || strlen($prenom) == 0){
                
                $erreur = "Indiquez votre nom et votre prénom";
                include("vues/v_profil.php");
                
            } else {
                if(strlen($password) == 0){
                    
                    $pdo->modificationNomPrenom($nom, $prenom, $_SESSION['id']);
                
                    $_SESSION['nom']= $nom;
                    $_SESSION['prenom']= $prenom;
                    
                    $validation = "Vos informations on été enregistrées";
                    include("vues/v_profil.php");
                    
                } else {
                    
                    if ($password == $passwordVerif){
                        
                        $patternPassword='#^(?=.[A-Z])(?=.[a-z])(?=.\d)(?=.[-+!$@%_])([-+!$@%_\w]{12,})$#';
                        if (preg_match($patternPassword, $password) == false){

                            $erreur = "Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule et un caractère spécial";
                            include("vues/v_profil.php");

                        } else {

                            $password = md5(sha1($password));

                            $pdo->modificationDonnee($nom, $prenom, $password, $_SESSION['id']);

                            $_SESSION['nom']= $nom;
                            $_SESSION['prenom']= $prenom;

                            $validation = "Vos informations on été enregistrées";
                            include("vues/v_profil.php");

                        }
                        
                    } else {
                        
                        $erreur = "Les mots de passes ne correspondent pas";
                        include("vues/v_profil.php");
                        
                    }
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