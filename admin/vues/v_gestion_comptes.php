<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0">Gestion de maintenance</h3>
                            <?php if(isset($validation)){ echo "<font style='color: green'>",$validation,"</font>"; }?>
                            <?php if(isset($erreur)){ echo "<font style='color: red'>",$erreur,"</font>"; }?>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Compte</th>
                                <th>Date de dernière connexion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php 
                            foreach($lesComptes as $unCompte){
                                $lesInfoComptes=$pdo->donneLeCompteInformations($unCompte['id']);
                                foreach ($lesInfoComptes as $infoComptes){
                        ?> 
                        <tbody>
                            <tr>
                                <td></td>
                                <td class="table-user">
                                    <b><?php echo $unCompte['nom']; ?></b> - <b><?php echo $unCompte['prenom']; ?></b> 
                                    <br /><?php echo $unCompte['mail']; ?>
                                </td>
                                <td>
                                    <a><?php $dateFin = new DateTime($infoComptes['dateFinLog']);
                                        echo $dateFin->Format('d-m-Y'); ?> </a>
                                </td>
                                <td>
                                    <center>
                                    <div class="row">
                                        
                                            <div class="col-2">
                                               <form method="post" action="index.php?uc=gestion&gestion=supprimer_compte">
                                                    <button type="submit" name="supprimer_compte" value="<?php echo $unCompte['id']; ?>" 
                                                            class="btn btn-success align-items-center" data-toggle="tooltip" data-original-title="Suppression">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form> 
                                            </div>
                                        
                                            <div class="col-2">
                                               <form method="post" action="index.php?uc=gestion&gestion=archivage_compte">
                                                    <button type="submit" name="archivage_compte" value="<?php echo $unCompte['id']; ?>" 
                                                            class="btn btn-danger align-items-center" data-toggle="tooltip" data-original-title="Archivage">
                                                        <i class="fas fa-lock"></i>
                                                    </button>
                                                </form> 
                                            </div>
                                    </div>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                            <?php } }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>