<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Gestion de la maintenance </h3>
                            <?php if(isset($validation)){ echo "<font style='color: green'>",$validation,"</font>"; }?>
                            <?php if(isset($erreur)){ echo "<font style='color: red'>",$erreur,"</font>"; }?>
                        </div>
                    </div>
                </div>
                <?php 
                    foreach($laMaintenance as $uneMaintenance){ 
                    foreach($laMaintenancePrevention as $uneMaintenancePrevention){ 
                ?> 
                <div class="card-body">
                    <form method="post" action="index.php?uc=gestion&gestion=modifier_maintenance">
                        <h6 class="heading-small text-muted mb-4">Informations sur la maintenance</h6>
                        
                        <div class="pl-lg-4">  
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Titre de la maintenance</label>
                                        <input type="text" id="input-username" name="nomMaintenance" class="form-control" placeholder="Indiquez le titre de votre maintenance" 
                                               autofocus="" value="<?php echo $uneMaintenance['nom']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Message de prevention</label>
                                <textarea rows="4" class="form-control" name="messagePrevention" placeholder="Indiquez le message de prévention"><?php echo $uneMaintenancePrevention['informations']; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Message de maintenance</label>
                                <textarea rows="4" class="form-control" name="messageMaintenance" placeholder="Indiquez le message de maintenance"><?php echo $uneMaintenance['informations']; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="pl-lg-4">                           
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="dateDeDebut">Date de début</label>
                                        <input type="date" id="dateDeDebut" name="dateDeDebut" class="form-control" value="<?php echo $uneMaintenance['dateDebut']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="dateDeFin">Date de fin</label>
                                        <input type="date" id="dateDeFin" name="dateDeFin" class="form-control" value="<?php echo $uneMaintenance['dateFin']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" name="id" value="<?php echo $uneMaintenance['id']; ?>" class="btn btn-success align-items-center">Enregistrer les modification</button>
                        </div>
                    </form>
                </div>
                <?php } }?>
            </div>

            <div class="card">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0">Gestion de maintenance</h3>
                            <?php if(isset($validation_list_maintenance)){ echo "<font style='color: green'>",$validation_list_maintenance,"</font>"; }?>
                            <?php if(isset($erreur_list_maintenance)){ echo "<font style='color: red'>",$erreur_list_maintenance,"</font>"; }?>
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
                                    <a><?php $dateDebut = new DateTime($uneMaintenance['dateDebut']);
                                        echo $dateDebut->Format('d-m-Y'); ?> </a>
                                </td>
                                <td>
                                    <a><?php $dateDebut = new DateTime($uneMaintenance['dateFin']);
                                        echo $dateDebut->Format('d-m-Y'); ?> </a>
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
        </div>
    </div>
</div>