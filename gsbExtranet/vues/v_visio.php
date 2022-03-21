<!DOCTYPE html>

<?php
    include("vues/v_sommaire.php");
?>

	<div class="col-md-4 col-md-offset-4">
            <div class="login-wrapper">
                <div class="box">
                    <div class="content-wrap">
                        <legend>Liste des Visio conférences</legend>
                        <p>
                            <?php
                            foreach($lesVisios as $unVisio){
                                $nom = $unVisio['nomVisio'];
                                $id = $unVisio['id'];
                                echo "<a href=index.php?uc=visio&action=selectVisio&id=$id>$nom</a><br>";
                                echo '<br>';
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
