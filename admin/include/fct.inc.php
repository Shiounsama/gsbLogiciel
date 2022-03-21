<?php
    
function estConnecte(){
    return isset($_SESSION['id']);
}

function connecter($id, $nom, $prenom, $access, $dateDebutLog){
        $_SESSION['id']= $id; 
        $_SESSION['nom']= $nom;
        $_SESSION['prenom']= $prenom;
        $_SESSION['access']= $access;
        $_SESSION['dateDebutLog']= $dateDebutLog;
}


function estEntierPositif($valeur) {
    return preg_match("/[^0-9]/", $valeur) == 0;
}


    function estTableauEntiers($tabEntiers) {
        $ok = true;
        if (isset($unEntier) ){
            foreach($tabEntiers as $unEntier){
                if(!estEntierPositif($unEntier)){
                    $ok=false; 
                }
            }	
        }
        return $ok;
    }


    function ajouterErreur($msg){
        if (! isset($_REQUEST['erreurs'])){
            $_REQUEST['erreurs']=array();
        } 
        $_REQUEST['erreurs'][]=$msg;
    }

    function nbErreurs(){
        if (!isset($_REQUEST['erreurs'])){
                return 0;
        } else{
            return count($_REQUEST['erreurs']);
        }
    }

    function input_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function generateCode(){
	$numbytes = 3;
	$bytes = openssl_random_pseudo_bytes($numbytes); 
        $hex = bin2hex($bytes);
        return $hex;
    }
?>