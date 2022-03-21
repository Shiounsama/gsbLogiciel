<?php
    require_once ("include/class.pdogsb.inc.php");
    require_once ("include/fct.inc.php");
    session_start();

    date_default_timezone_set('Europe/Paris');

    $pdo = PdoGsb::getPdoGsb();
    $estConnecte = estConnecte();

    if(!isset($_GET['uc'])){
        $_GET['uc'] = 'navigation';
    }
    
    $uc = $_GET['uc'];
    switch($uc){
        
        case 'navigation':{
            include("controleurs/c_navigation.php");
            break;
        }
        
        case 'session':{
            include("controleurs/c_session.php");
            break;
        }
        
        case 'gestion':{
            include("controleurs/c_gestion.php");
            break;
        }   
    }

    if($_GET['uc'] != 'session')
    { 
        if (!isset($_SESSION['id'])) {
            
            ?>
            <meta http-equiv="Refresh" content="0.01; url=index.php?uc=session&action=connexion">
            <?php 
        
        }
        
        if ($_SESSION['access'] == 0) {
            
            ?>
            <meta http-equiv="Refresh" content="0.01; url=index.php?uc=session&action=erreur">
            <?php 
        
        }
        
?>

    <footer class="footer pt-0">
        
    <?php include("vues/footer/v_footer.php"); ?>

    </footer>

<?php 
    }
    
    include("vues/js/v_js.php");
?>







