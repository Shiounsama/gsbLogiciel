<?php
    include("vues/v_sommaire.php");
?>
        <div class="col-md-4 col-md-offset-4">
            <div class="login-wrapper">
                <div class="box">
                    <div class="content-wrap">
                        <legend>Mes Informations</legend>
                        <p style="color: red;">
                            <?php if(isset($erreur)){ echo $erreur; }?>
                        </p>
                        <p style="color: green;">
                            <?php if(isset($validation)){ echo $validation; }?>
                        </p>
                        <form method="post" action="index.php?uc=profil&action=modifier">
                            <input name="nom" class="form-control" type="text" placeholder="Nom" value="<?php echo $_SESSION['nom'] ?>">
                            <input name="prenom" class="form-control" type="text" placeholder="Prénom" value="<?php echo $_SESSION['prenom'] ?>">
                            <input name="password" class="form-control" type="password" placeholder="Mot de passe">
                            <input name="passwordVerif" class="form-control" type="password" placeholder="Confirmation du mot de passe">
                            </br>
                            <input type="submit" class="btn btn-primary signup" value="Enregister les modifications">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
