<?php

/** 
 * Classe d'accÃ¨s aux donnÃ©es. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=127.0.0.1';
      	private static $bdd='dbname=gsbextranet';   		
      	private static $user='gsb' ;    		
      	private static $mdp='Wrh0mMTosQXz4nUV' ;	
	private static $monPdo;
	private static $monPdoGsb=null;
		
/**
 * Constructeur privÃ©, crÃ©e l'instance de PDO qui sera sollicitÃ©e
 * pour toutes les mÃ©thodes de la classe
 */				
	private function __construct(){
          
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crÃ©e l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * vÃ©rifie si le login et le mot de passe sont corrects
 * renvoie true si les 2 sont corrects
 * @param type $lePDO
 * @param type $login
 * @param type $pwd
 * @return bool
 * @throws Exception
 */
function checkUser($login,$pwd):bool {
    //AJOUTER TEST SUR TOKEN POUR ACTIVATION DU COMPTE
    $user=false;
    
    $pdo = PdoGsb::$monPdo;
    
    $monObjPdoStatement=$pdo->prepare("SELECT motDePasse FROM medecin WHERE mail= :login AND token IS NULL");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
        if (is_array($unUser)){
           if ($pwd==$unUser['motDePasse'])
                $user=true;
        }
    }
    else
        throw new Exception("erreur dans la requÃªte");
    
return $user;   
}


function donneLeMedecinByMail($login) {
    
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail,access FROM medecin WHERE mail= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
return $unUser;   
}


public function tailleChampsMail(){
    
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS "
            . "WHERE table_name = 'medecin' AND COLUMN_NAME = 'mail'");
    $execution = $pdoStatement->execute();
    $leResultat = $pdoStatement->fetch();
      
      return $leResultat[0];
    
       
       
}
public function creeMedecin($email, $mdp)
{
    $lePdo = PdoGsb::getPdoGsb();
    $cle = $lePdo->recupCleChiffrement();
    $nonce = $lePdo->recupNonce();
    $mail = sodium_crypto_secretbox($email, $nonce, $cle);
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO medecin(id,mail, motDePasse,dateCreation,dateConsentement) "
            . "VALUES (null, :leMail, :leMdp, now(),now())");
    $bv1 = $pdoStatement->bindValue(':leMail', $mail);
   
    $bv2 = $pdoStatement->bindValue(':leMdp', $mdp);
    $execution = $pdoStatement->execute();
    return $execution;
    
}


function testMail($email){
    $pdo = PdoGsb::$monPdo;
    $pdoStatement = $pdo->prepare("SELECT count(*) as nbMail FROM medecin WHERE mail = :leMail");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $execution = $pdoStatement->execute();
    $resultatRequete = $pdoStatement->fetch();
    if ($resultatRequete['nbMail']==0)
        $mailTrouve = false;
    else
        $mailTrouve=true;
    
    return $mailTrouve;
}

function connexion($id){
    $dateDebut = date("y-m-d H:i:s");
    $pdo = PdoGsb::$monPdo->prepare('INSERT INTO historiqueconnexion(idMedecin, dateDebutLog) VALUES(?, ?)');
    $pdo->execute(array($id, $dateDebut)); 
    return $dateDebut;
}

function deConnexion($dateDebut, $id){
    $pdo = PdoGsb::$monPdo->prepare('UPDATE historiqueconnexion SET dateFinLog = ? WHERE dateDebutLog = ? AND idMedecin = ?');
    $pdo->execute(array(date("y-m-d H:i:s") ,$dateDebut, $id));
}


function connexionInitiale($mail){
    $pdo = PdoGsb::$monPdo;
    $medecin= $this->donneLeMedecinByMail($mail);
    $id = $medecin['id'];
    $this->ajouteConnexionInitiale($id);
    
}

function ajouteConnexionInitiale($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion "
            . "VALUES (:leMedecin, now(), now())");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function donneinfosmedecin($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT id,nom,prenom FROM medecin WHERE id= :lId");
    $bvc1=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
   
    }
    else
        throw new Exception("erreur");
           
    
}

function modificationNomPrenom($nom, $prenom, $id){
    
    $pdo = PdoGsb::$monPdo->prepare("UPDATE medecin SET nom = ?, prenom = ? WHERE id = ?");
    $pdo->execute(array($nom, $prenom, $id));   
}

function modificationDonnee($nom, $prenom, $password, $id){
    
    $pdo = PdoGsb::$monPdo->prepare("UPDATE medecin SET nom = ?, prenom = ?, motDePasse = ? WHERE id = ?");
    $pdo->execute(array($nom, $prenom, $password, $id));
    
}

function maintenance(){
    
    $pdo = PdoGsb::$monPdo->prepare("SELECT * FROM maintenance");
    $execution = $pdo->execute();
    $laMaintenance = $pdo->fetch();
    
    return $laMaintenance;
}

function maintenancePrevention(){
    
    $pdo = PdoGsb::$monPdo->prepare("SELECT * FROM maintenanceprevention");
    $execution = $pdo->execute();
    $laMaintenancePrevention = $pdo->fetch();
    
    return $laMaintenancePrevention;
}

function donneLesProduits(){
    
    $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT * FROM produit");

    if ($monObjPdoStatement->execute()) {
        $lesProduits =$monObjPdoStatement->fetchall();
        return $lesProduits;
    }
    else
        throw new Exception("erreur");


}

function afficheLeProduit($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT * FROM produit WHERE id=$id");
    
    if ($monObjPdoStatement->execute()) {
        $leProduit =$monObjPdoStatement->fetchall();
        return $leProduit;
    }
    else
        throw new Exception("erreur");
           
    
}

function donneLesVisios(){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT * FROM visioconference WHERE actif = 1");
    
    if ($monObjPdoStatement->execute()) {
        $lesVisios =$monObjPdoStatement->fetchall();
        return $lesVisios;
    }
    else
        throw new Exception("erreur");   
}

function afficheLaVisio($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT * FROM visioconference WHERE id=$id and actif = 1");
    
    if ($monObjPdoStatement->execute()) {
        $laVisio =$monObjPdoStatement->fetchall();
        return $laVisio;
    }
    else
        throw new Exception("erreur");
}

function recupCleChiffrement(){
    $fichier = file("css/Charlote_aux_fraise.txt"); // Nom du fichier à afficher, son adresse de localisation
    $total = count($fichier); // Nombre total des lignes du fichier
    for($i = 0; $i < $total; $i++)
    { // Départ de la boucle
    $cle = $fichier[$i]; // On affiche ligne par ligne le contenu du fichier
    }
    return $cle;
    }

function recupNonce(){
    $fichier = file("css/Charlote_aux_fraise_nonce.txt"); // Nom du fichier à afficher, son adresse de localisation
    $total = count($fichier); // Nombre total des lignes du fichier
    for($i = 0; $i < $total; $i++)
    { // Départ de la boucle
    $nonce = $fichier[$i]; // On affiche ligne par ligne le contenu du fichier
    }
    return $nonce;
    }
    
    
}
?>