<!DOCTYPE html>
   
<?php
    include("vues/v_sommaire.php");
?>
        <div class="col-md-4 col-md-offset-4">
            <div class="login-wrapper">
                <div class="box">
                    <div class="content-wrap">
                        <legend>Liste des médicaments</legend>
                        <p>
                            <?php
                            foreach($lesProduits as $unProduit){
                                $nom = $unProduit['nom'];
                                $id = $unProduit['id'];
                                echo "<a href=index.php?uc=produit&action=selectProduit&id=$id>$nom</a><br>";
                                echo '    '.'<br>';
                            }
                            ?>
                        </p>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
