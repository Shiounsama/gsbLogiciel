<?php


if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeCreation';
}
$action = $_GET['action'];
switch($action){
	
	case 'demandeCreation':{
            include("vues/v_creation.php");
            break;
	}
        
	case 'valideCreation':{
            
            $leLogin = htmlspecialchars($_POST['login']);
            $lePassword = htmlspecialchars($_POST['mdp']);
                
        if ($leLogin == $_POST['login'])
        {
            $loginOk = true;
            $passwordOk=true;
        }
        else{
            echo 'tentative d\'injection javascript - login refusé';
                $loginOk = false;
                $passwordOk=false;
        }
        
        //test validation protection
        if(isset($_POST['valideProtection'])){
            
            //test récup données
            //echo $leLogin.' '.$lePassword;
            $rempli=false;
            
            if ($loginOk && $passwordOk){
            //obliger l'utilisateur à saisir login/mdp
            $rempli=true; 
            
                if (empty($leLogin)==true) {
                    $erreur = 'Le login n\'a pas été saisi<br/>';
                    $rempli=false;
                    include("vues/v_creation.php");
                    break;
                }

                if (empty($lePassword)==true){
                    $erreur = 'Le mot de passe n\'a pas été saisi<br/>';
                    $rempli=false;
                    include("vues/v_creation.php");
                    break;
                }

                //si le login et le mdp contiennent quelque chose
                // on continue les vérifications
                if ($rempli){
                    //supprimer les espaces avant/après saisie
                    $leLogin = trim($leLogin);
                    $lePassword = trim($lePassword);

                    //vérification de la taille du champs
                    $nbCarMaxLogin = $pdo->tailleChampsMail();

                    if(strlen($leLogin)>$nbCarMaxLogin){
                        $erreur = 'Le login ne peut contenir plus de '.$nbCarMaxLogin.'<br/>';
                        $loginOk=false;
                        include("vues/v_creation.php");
                        break;
                    }

                    //vérification du format du login
                    if (!filter_var($leLogin, FILTER_VALIDATE_EMAIL)) {
                        $erreur = 'le mail n\'a pas un format correct<br/>';
                        $loginOk=false;
                        include("vues/v_creation.php");
                        break;
                    }


                    $patternPassword='#^(?=.[A-Z])(?=.[a-z])(?=.\d)(?=.[-+!$@%_])([-+!$@%_\w]{12,})$#';
                    if (1!=1){
                       if (preg_match($patternPassword, $lePassword)==false){
                        $erreur = 'Le mot de passe doit contenir au moins 12 caractères, une majuscule,'
                        . ' une minuscule et un caractère spécial<br/>';
                        $passwordOk=false;
                        include("vues/v_creation.php");
                        break;
                    }
                }
            }
            if($rempli && $loginOk && $passwordOk){
                    
                
                
                    $passwordCrypt = md5(sha1($lePassword));
                    
                    
                    
                    $executionOK = $pdo->creeMedecin($leLogin,$passwordCrypt);       

                    if ($executionOK==true){
                        $validation = "c'est bon, votre compte a bien été créé ;-)";
                        $pdo->connexionInitiale($leLogin);
                        include("vues/v_creation.php");
                        break;
                    }
                    else
                        $erreur = "ce login existe déjà, veuillez en choisir un autre";
                        include("vues/v_creation.php");
                        break;
                }
        }
    }
    
        }  
    default :{
        
        include("vues/v_creation.php");
        break;
        
    }
}
?>