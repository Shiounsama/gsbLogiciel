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
                                <th>Titre de la maintenance</th>
                                <th>Date de debut</th>
                                <th>Date de fin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php 
                            foreach($lesMaintenances as $uneMaintenance){ 
                        ?> 
                        <tbody>
                            <tr>
                                <td></td>
                                <td class="table-user">
                                    <b><?php echo $uneMaintenance['nom']; ?></b>
                                </td>
                                <td>
                                    <a><a><?php $dateDebut = new DateTime($uneMaintenance['dateDebut']);
                                        echo $dateDebut->Format('d-m-Y'); ?> </a></a>
                                </td>
                                <td>
                                    <a><a><?php $dateDebut = new DateTime($uneMaintenance['dateFin']);
                                        echo $dateDebut->Format('d-m-Y'); ?> </a></a>
                                </td>
                                <td>
                                    <center>
                                    <div class="row">
                                        <?php if ($uneMaintenance['actif'] == 1){ ?>
                                            <div class="col-2">
                                               <form method="post" action="index.php?uc=gestion&gestion=desactivation_maintenance">
                                                    <button type="submit" name="desactivation_maintenance" value="<?php echo $uneMaintenance['id']; ?>" 
                                                            class="btn btn-success align-items-center" data-toggle="tooltip" data-original-title="Désactivation">
                                                        <i class="fas fa-lock-open"></i>
                                                    </button>
                                                </form> 
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-2">
                                               <form method="post" action="index.php?uc=gestion&gestion=activation_maintenance">
                                                    <button type="submit" name="activation_maintenance" value="<?php echo $uneMaintenance['id']; ?>" 
                                                            class="btn btn-danger align-items-center" data-toggle="tooltip" data-original-title="Activation">
                                                        <i class="fas fa-lock"></i>
                                                    </button>
                                                </form> 
                                            </div>
                                        <?php } ?>
                                    </div>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0">Gestion de prévention</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Titre de la maintenance</th>
                                <th>Date de debut</th>
                                 <th>Date de fin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php 
                            foreach($lesMaintenancesPrevention as $uneMaintenancePrevention){ 
                        ?> 
                        <tbody>
                            <tr>
                                <td></td>
                                <td class="table-user">
                                    <b><?php echo $uneMaintenancePrevention['nom']; ?></b>
                                </td>
                                <td>
                                    <a><?php $dateDebut = new DateTime($uneMaintenancePrevention['dateDebut']);
                                    echo $dateDebut->Format('d-m-Y'); ?> </a>
                                </td>
                                <td>
                                    <a><?php $dateDebut = new DateTime($uneMaintenancePrevention['dateFin']);
                                    echo $dateDebut->Format('d-m-Y'); ?> </a>
                                </td>
                                <td>
                                    <div class="row">
                                        <?php if ($uneMaintenancePrevention['actif'] == 1){ ?>
                                            <div class="col-2">
                                                <form method="post" action="index.php?uc=gestion&gestion=desactivation_maintenancePrevention">
                                                    <button type="submit" name="desactivation_maintenancePrevention" value="<?php echo $uneMaintenancePrevention['id']; ?>" 
                                                        class="btn btn-success align-items-center" data-toggle="tooltip" data-original-title="Desactivation">
                                                        <i class="fas fa-lock-open"></i>
                                                    </button>
                                                </form> 
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-2">
                                                <form method="post" action="index.php?uc=gestion&gestion=activation_maintenancePrevention">
                                                    <button type="submit" name="activation_maintenancePrevention" value="<?php echo $uneMaintenancePrevention['id']; ?>" 
                                                        class="btn btn-danger align-items-center" data-toggle="tooltip" data-original-title="Activation">
                                                        <i class="fas fa-lock"></i>
                                                    </button>
                                                </form> 
                                            </div>
                                        <?php } ?>
                                    </div>  
                                </td>
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <form method="post" action="index.php?uc=gestion&gestion=modification_maintenance">
                        <button type="submit" name="modification_maintenance" value="<?php echo $uneMaintenance['id']; ?>" 
                            class="btn btn-success   align-items-center" data-toggle="tooltip" data-original-title="Modification">
                            Modifier votre maintenance
                        </button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>