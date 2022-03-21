<?php
session_start();
include_once ("include/class.pdogsb.inc.php");
include_once("include/fct.inc.php");

$cookie=0;
$heure_connexion;
$heure_deconnexion;
date_default_timezone_set('Europe/Paris');


$pdo = PdoGsb::getPdoGsb();

$estConnecte = estConnecte();
if(!isset($_GET['uc'])){
     $_GET['uc'] = 'connexion';
}
else {
    if($_GET['uc']=="connexion" && !estConnecte()){
        $_GET['uc'] = 'connexion';
    }
        
}

$laMaintenance = $pdo->maintenance();

if($laMaintenance['actif'] == 0)
{
    $uc = $_GET['uc'];
    switch($uc){
        case 'cookie':{
            include("controleurs/c_connexion.php");break;
        }
            case 'connexion':{
                    include("controleurs/c_connexion.php");break;
            }
            case 'creation':{
                    include("controleurs/c_creation.php");break;
            }
            case 'profil':{
                    include("controleurs/c_droit.php");break;
            }
            
            case 'produit':{
                    include("controleurs/c_produit.php");break;
            }
            case 'visio':{
                    include("controleurs/c_visio.php");break;
            }

            }  
}else{
  include("vues/v_maintenance.php");  
}	
include("vues/v_footer.html");

?>







