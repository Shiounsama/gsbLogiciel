<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB - extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body background="assets/img/laboratoire.jpg">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<?php
    include("vues/v_maintenancePrevention.php");
?>

      
<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<div class="box">
					<div class="content-wrap">
						<legend>Se connecter</legend>
                                                    <p style="color: red;">
                                                        <?php if(isset($erreur)){ echo $erreur; }?>
                                                    </p>
                                                    <?php if (isset($temps)){
                                                        echo "Vous avez passé : ".$temps." seconde sur le site.";
                                                    }
?>
							<form method="post" action="index.php?uc=connexion&action=valideConnexion">
								<input name="login" class="form-control" type="text" placeholder="Login">
								<input name="mdp" class="form-control" type="password" placeholder="Password">
								</br>
								<input type="submit" class="btn btn-primary signup" value="Se connecter">
							</form>
							</br>
                                                        Vous n'avez pas de compte, <a href="index.php?uc=creation&action=demandeCreation">Inscrivez-vous</a> !
                                                <br/>
                                                
                                        </div>	
                                     
                                    
				</div>
			</div>
		</div>
	</div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    
<?php if(!isset($_COOKIE["Accepter"]) AND !isset($_COOKIE["Refuser"])){ ?>
    <script>$('#les_cookies').modal({backdrop: 'static', keyboard: false, show: true});</script>
<?php } else { $cookie == 1;?>
    <script>$('#les_cookies').modal({show: false});</script>
<?php } ?>
  </body>
</html>