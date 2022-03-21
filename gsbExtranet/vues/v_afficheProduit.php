<?php 
    include("vues/v_sommaire.php");
   
?>
        <div class="col-md-8 col-md-offset-2">
            <div class="login-wrapper">
                <div class="box">
                    <div class="content-wrap">
                        <legend>Liste des médicaments</legend>
                        <p>
                            <?php 
                            foreach($leProduit as $unProduit){
                                $nom = $unProduit['nom'];
                                echo "Nom du médicament :".'<br>';
                                echo "-".$unProduit['nom'].'<br>';
                                echo "    ".'<br>';
                                echo "Objectif du médicament :".'<br>';
                                echo "-".$unProduit['objectif'].'<br>';
                                echo "    ".'<br>';
                                echo "Information sur le médicament :".'<br>';
                                echo "-".$unProduit['information'].'<br>';
                                echo "    ".'<br>'; 
                                echo "Effets indésirable du médicament :".'<br>';
                                echo "-".$unProduit['effetIndesirable'].'<br>';
                                echo "    ".'<br>';
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
