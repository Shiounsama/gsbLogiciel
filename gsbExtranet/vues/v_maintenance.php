<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <title>GSB -extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/profilcss/profil.css" rel="stylesheet">
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
      <div class="page-content container">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  <div class="login-wrapper">
                      <div class="box" style="background-color: #c12e2a; color: #fff">
                            <?php echo $laMaintenance['informations'] ?><br /><br />
                            Du 
                            <?php $dateDebut = new DateTime($laMaintenance['dateDebut']);
                            echo $dateDebut->Format('d-m-Y'); ?> 
                            au
                            <?php $dateFin = new DateTime($laMaintenance['dateFin']);
                            echo $dateFin->Format('d-m-Y'); ?>
                            <br /><br />
                            Merci de réessayer ultérieurement. L'équipe GSB.
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </body>
</html>
