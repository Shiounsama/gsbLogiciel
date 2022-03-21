<div class="card">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0">Liste des visioconférences</h3>
                            <?php if(isset($validation_list)){ echo "<font style='color: green'>",$validation_list,"</font>"; }?>
                            <?php if(isset($erreur_list)){ echo "<font style='color: red'>",$erreur_list,"</font>"; }?>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Titre de la visioconférences</th>
                                <th>Date de debut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php 
                            foreach($lesVisios as $uneVisio){ 
                        ?> 
                        <tbody>
                            <tr>
                                <td></td>
                                <td class="table-user">
                                    <b><?php echo $uneVisio['nomVisio']; ?></b>
                                </td>
                                <td>
                                    <a><?php $dateDebut = new DateTime($uneVisio['dateVisio']);
                                        echo $dateDebut->Format('d-m-Y'); ?> </a>
                                </td>
                                <td>
                                    <center>
                                        <div class="row">
                                            <?php if ($uneVisio['actif'] == 1){ ?>
                                                <div class="col-2">
                                                   <form method="post" action="index.php?uc=gestion&gestion=desactivation_visio">
                                                        <button type="submit" name="desactivation_visio" value="<?php echo $uneVisio['id']; ?>" 
                                                                class="btn btn-danger align-items-center" data-toggle="tooltip" data-original-title="Désactivation">
                                                            <i class="fas fa-lock"></i>
                                                        </button>
                                                    </form> 
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-2">
                                                   <form method="post" action="index.php?uc=gestion&gestion=activation_visio">
                                                        <button type="submit" name="activation_visio" value="<?php echo $uneVisio['id']; ?>" 
                                                                class="btn btn-success align-items-center" data-toggle="tooltip" data-original-title="Activation">
                                                            <i class="fas fa-lock-open"></i>
                                                        </button>
                                                    </form> 
                                                </div>
                                            <?php } ?>
                                            <div class="col-2">
                                                <form method="post" action="index.php?uc=gestion&gestion=modification_visio">
                                                    <button type="submit" name="modification_visio" value="<?php echo $uneVisio['id']; ?>" 
                                                            class="btn btn-info align-items-center" data-toggle="tooltip" data-original-title="Modification">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </form> 
                                            </div>
                                            <div class="col-2">
                                                <form method="post" action="index.php?uc=gestion&gestion=supprimer_visio">
                                                    <button type="submit" name="supprimer_visio" value="<?php echo $uneVisio['id']; ?>" 
                                                            class="btn btn-danger align-items-center" data-toggle="tooltip" data-original-title="Suppression">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form> 
                                            </div>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>
                </div>
            </div>