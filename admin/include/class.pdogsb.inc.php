<?php
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
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom, mail, access FROM medecin WHERE mail= :login");
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
   
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO medecin(id,mail, motDePasse,dateCreation,dateConsentement) "
            . "VALUES (null, :leMail, :leMdp, now(),now())");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
   
    $bv2 = $pdoStatement->bindValue(':leMdp', $mdp);
    $execution = $pdoStatement->execute();
    return $execution;
    
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

function recupererMaxIdProduit(){
    $pdo = PdoGsb::$monPdo->prepare("SELECT MAX(id) FROM produit");
    $pdo->execute();
    $lIdMAx = $pdo->fetch();
    
    return $lIdMAx;
}

function ajouterMaintenance($nom, $messagePrevention, $messageMaintenance, $DateDeDebut, $DateDeFin){
    $pdo = PdoGsb::$monPdo->prepare("INSERT INTO maintenance(nom, informations, dateDebut, dateFin) VALUES (?,?,?,?)");
    $pdo->execute(array($nom, $messageMaintenance, $DateDeDebut, $DateDeFin));
    
    $pdo = PdoGsb::$monPdo->prepare("INSERT INTO maintenanceprevention(nom, informations, dateDebut, dateFin) VALUES (?,?,?,?)");
    $pdo->execute(array($nom, $messageMaintenance, $DateDeDebut, $DateDeFin));
}

function ajouterProduit($nom, $objectif, $information, $effetIndesirable){
    $id = $this->recupererMaxIdProduit()[0] +1;
    $pdo = PdoGsb::$monPdo->prepare("INSERT INTO produit(id, nom, objectif, information, effetIndesirable) VALUES (?,?,?,?,?)");
    $pdo->execute(array($id, $nom, $objectif, $information, $effetIndesirable));
}

function ajouterVisio($nom, $url, $objectif, $dateDeDebut){
    $pdo = PdoGsb::$monPdo->prepare("INSERT INTO visioconference(nomVisio, objectif, url, dateVisio) VALUES (?,?,?,?)");
    $pdo->execute(array($nom, $objectif, $url, $dateDeDebut));
}

function modificationProduit($nom, $objectif, $information, $effetIndesirable, $id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE produit SET nom = ?, objectif = ?, information = ?, effetIndesirable = ? WHERE id = ?");
    $pdo->execute(array($nom, $objectif, $information, $effetIndesirable, $id));   
}

function modificationVisio($nomVisio, $objectif, $url, $dateVisio, $id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE visioconference SET nomVisio = ?, objectif = ?, url = ?, dateVisio = ? WHERE id = ?");
    $pdo->execute(array($nomVisio, $objectif,$url, $dateVisio, $id));   
}

function modificationMaintenance($nom, $messagePrevention, $messageMaintenance, $dateDeDebut, $dateDeFin, $id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE maintenance SET nom = ?, informations = ?, dateDebut = ?, dateFin = ? WHERE id = ?");
    $pdo->execute(array($nom, $messageMaintenance, $dateDeDebut, $dateDeFin, $id));
    
    $pdo = PdoGsb::$monPdo->prepare("UPDATE maintenanceprevention SET nom = ?, informations = ?, dateDebut = ?, dateFin = ? WHERE id = ?");
    $pdo->execute(array($nom, $messagePrevention, $dateDeDebut, $dateDeFin, $id));
}

function supprimerProduit($id){
    $pdo = PdoGsb::$monPdo->prepare("DELETE FROM produit WHERE id = ?");
    $pdo->execute(array($id));
}

function supprimerVisio($id){
    $pdo = PdoGsb::$monPdo->prepare("DELETE FROM visioconference WHERE id = ?");
    $pdo->execute(array($id));
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

function donneLesVisios(){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT * FROM visioconference");
    
    if ($monObjPdoStatement->execute()) {
        $lesVisios =$monObjPdoStatement->fetchall();
        return $lesVisios;
    }
    else
        throw new Exception("erreur");   
}

function donneLesMaintenances(){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT * FROM maintenance");
    
    if ($monObjPdoStatement->execute()) {
        $lesMaintenances =$monObjPdoStatement->fetchall();
        return $lesMaintenances;
    }
    else
        throw new Exception("erreur");   
}


function donneLesMaintenancesPrevention(){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT * FROM maintenanceprevention");
    
    if ($monObjPdoStatement->execute()) {
        $lesMaintenancesPrevention =$monObjPdoStatement->fetchall();
        return $lesMaintenancesPrevention;
    }
    else
        throw new Exception("erreur");   
}

function donneLesComptes(){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id,nom,prenom,mail FROM medecin");
    
    if ($monObjPdoStatement->execute()) {
        $lesComptes =$monObjPdoStatement->fetchall();
        return $lesComptes;
    }
    else
        throw new Exception("erreur");
}

function donneLeCompteInformations($id){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT dateFinLog FROM historiqueconnexion WHERE idMedecin=$id ORDER BY dateFinLog DESC LIMIT 1");
    
    if ($monObjPdoStatement->execute()) {
        $lesInformationsCompte =$monObjPdoStatement->fetchall();
        return $lesInformationsCompte;
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

function afficheLaVisio($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT * FROM visioconference WHERE id=$id");
    
    if ($monObjPdoStatement->execute()) {
        $laVisio =$monObjPdoStatement->fetchall();
        return $laVisio;
    }
    else
        throw new Exception("erreur");
           
    
}

function afficheLaMaintenance($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT * FROM maintenance WHERE id=$id");
    
    if ($monObjPdoStatement->execute()) {
        $laMaintenance =$monObjPdoStatement->fetchall();
        return $laMaintenance;
    }
    else
        throw new Exception("erreur");

}

function afficheLaMaintenancePrevention($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT * FROM maintenanceprevention WHERE id=$id");
    
    if ($monObjPdoStatement->execute()) {
        $laMaintenancePrevention =$monObjPdoStatement->fetchall();
        return $laMaintenancePrevention;
    }
    else
        throw new Exception("erreur");

}

function activationMaintenance($id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE maintenance SET actif = ? WHERE id = ?");
    $pdo->execute(array("1", $id));
}

function desactivationMaintenance($id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE maintenance SET actif = ? WHERE id = ?");
    $pdo->execute(array("0", $id));
}

function activationMaintenancePrevention($id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE maintenanceprevention SET actif = ? WHERE id = ?");
    $pdo->execute(array("1", $id));
}

function desactivationMaintenancePrevention($id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE maintenanceprevention SET actif = ? WHERE id = ?");
    $pdo->execute(array("0", $id));
}

function activationVisio($id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE visioconference SET actif = ? WHERE id = ?");
    $pdo->execute(array("1", $id));
}

function desactivationVisio($id){
    $pdo = PdoGsb::$monPdo->prepare("UPDATE visioconference SET actif = ? WHERE id = ?");
    $pdo->execute(array("0", $id));
}

function supprimerCompte($id){
    $pdo = PdoGsb::$monPdo->prepare("DELETE FROM medecinproduit WHERE idMedecin = ?");
    $pdo->execute(array($id));
    $pdo = PdoGsb::$monPdo->prepare("DELETE FROM medecinvisio WHERE idMedecin = ?");
    $pdo->execute(array($id));
    $pdo = PdoGsb::$monPdo->prepare("DELETE FROM historiqueconnexion WHERE idMedecin = ?");
    $pdo->execute(array($id));
    $pdo = PdoGsb::$monPdo->prepare("DELETE FROM medecin WHERE id = ?");
    $pdo->execute(array($id));
    $pdo = PdoGsb::$monPdo->prepare("DELETE FROM medecinaeffacer WHERE idMedecin = ?");
    $pdo->execute(array($id));
}

function recupMedecinAArchiver($id){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT dateNaissance,dateCreation FROM medecin WHERE id = ?");
    
    if ($monObjPdoStatement->execute(array($id))) {
        $lesComptes =$monObjPdoStatement->fetch();
        return $lesComptes;
    }
    else
        throw new Exception("erreur");
    
   
}

function recupHistoriqueAArchiver($id){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT dateDebutLog, dateFinLog FROM historiqueconnexion WHERE idMedecin= ? ");
    
    if ($monObjPdoStatement->execute(array($id))) {
        $lesInformationsCompte =$monObjPdoStatement->fetchall();
        return $lesInformationsCompte;
    }
    else
        throw new Exception("erreur");
}


function donneLesProduitsMedecin($id){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT idProduit,Date,Heure FROM medecinproduit WHERE idMedecin=?");
    
    if ($monObjPdoStatement->execute(array($id))) {
        $lesProduits =$monObjPdoStatement->fetchall();
        return $lesProduits;
    }
    else
        throw new Exception("erreur");
}

function donneLesVisiosMedecin($id){
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT idVisio,dateInscription FROM medecinvisio WHERE idMedecin = ? ");
    
    if ($monObjPdoStatement->execute(array($id))) {
        $lesVisios =$monObjPdoStatement->fetchall();
        return $lesVisios;
    }
    else
        throw new Exception("erreur");   
}




function archiverMedecin($id){
    $leMedecin= $this->recupMedecinAArchiver($id);
    $pdo = PdoGsb::$monPdo;
    $lHitoriqueMedecin=$this->recupHistoriqueAArchiver($id);
    $lesProduits=$this->donneLesProduitsMedecin($id);
    $lesVisioMedecin=$this->donneLesVisiosMedecin($id);
    $pdoStement= $pdo->prepare("INSERT INTO archivagemedecin(id_medecin,anneeNaissance,dateCreation) VALUES(null,?,?)");
    if ( $pdoStement->execute(array($leMedecin[0],$leMedecin[1]))){
        $monObjPdoStatement=$pdo->prepare("SELECT MAX(id_medecin) FROM archivagemedecin");
        $monObjPdoStatement->execute();
        $lIdMedecin = $monObjPdoStatement->fetch();
        foreach($lHitoriqueMedecin as $unHisto){
        $pdoStement2= $pdo->prepare("INSERT INTO archivagehistoriqueconnexion(id_medecin,dateDebutLog,dateFinLog) VALUES(?,?,?)");
        $pdoStement2->execute(array($lIdMedecin[0],$unHisto[0],$unHisto[1]));
        }
        foreach($lesProduits as $unProduit){
            $pdoStement3= $pdo->prepare("INSERT INTO archivagemedecinproduit(id_medecin,id_produit,date,heure) VALUES(?,?,?,?)");
            $pdoStement3->execute(array($lIdMedecin[0],$unProduit[0],$unProduit[1],$unProduit[2]));
        }
        foreach($lesVisioMedecin as $uneVisio){
            $pdoStement4=$pdo->prepare("INSERT INTO archivagemedecinvisio(idMedecin, idVisio, dateInscription) VALUES(?,?,?)");
            $pdoStement4->execute(array($lIdMedecin[0],$uneVisio[0],$uneVisio[1]));
        }
        $compteSupprimer=$this->supprimerCompte($id);
        return $compteSupprimer;
    }
    else 
        throw  new Exception ("Erreur archiver médecin");
}

}
?>