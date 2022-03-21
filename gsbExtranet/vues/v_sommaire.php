<?php
if (!$_SESSION['id'])
    header('Location: ../index.php');
else {
    
    if (isset($_COOKIE["Accepter"])){
        setcookie("Accepter",$_SESSION['email'], time()+15768000);
    }
    $heure_connexion=date("y-m-d H:i:s");
    setcookie("Temps_sur_site", $heure_connexion, time()+15768000);
    
?>
﻿<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <title>GSB -extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/profilcss/profil.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body background="assets/img/laboratoire.jpg">
      
      
      
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Galaxy Swiss Bourdin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php?uc=produit&action=valideProduit">Voir les médicaments</a></li>
                <li class="active"><a href="index.php?uc=visio&action=valideVisio">Voir les visio</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.php?uc=profil&action=mes_informations" ><?php echo $_SESSION['nom']."  ".$_SESSION['prenom']?></a></li>
                <li><a href="index.php?uc=connexion&action=deConnexion">Déconnexion</a></li>
           </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
</nav>
      
    <?php
        include("vues/v_maintenancePrevention.php");
    ?>
      
    <div class="page-content">
        <div class="row">
<?php }?>
