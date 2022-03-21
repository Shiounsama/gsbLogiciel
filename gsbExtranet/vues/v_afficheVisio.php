<!DOCTYPE html>

<?php
    include("vues/v_sommaire.php");
?>

	<div class="col-md-8 col-md-offset-2">
            <div class="login-wrapper">
                <div class="box">
                    <div class="content-wrap">
                        <legend>Détails de la visio conférence</legend>
                        <p>
                            <?php 
                            foreach($laVisio as $uneVisio){
                                
                                $dateDebut = new DateTime($uneVisio['dateVisio']);
                                echo "Nom de la visio conférence :".'<br>';
                                echo "-".$uneVisio['nomVisio'].'<br>';
                                echo "    ".'<br>';
                                echo "Objectif de la visio conférence :".'<br>';
                                echo "-".$uneVisio['objectif'].'<br>';
                                echo "    ".'<br>';
                                echo "URL de la visio conférence :".'<br>';
                                echo "-".$uneVisio['url'].'<br>';
                                echo "    ".'<br>';
                                echo "La date de ce visio :".'<br>';
                                echo "-".$dateDebut->Format('d-m-Y').'<br>';
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
