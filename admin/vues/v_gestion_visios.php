<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Gestion des visioconférences </h3>
                            <?php if(isset($validation)){ echo "<font style='color: green'>",$validation,"</font>"; }?>
                            <?php if(isset($erreur)){ echo "<font style='color: red'>",$erreur,"</font>"; }?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php?uc=gestion&gestion=ajouter_visio">
                        <h6 class="heading-small text-muted mb-4">Informations sur la visioconférence</h6>
                        
                        <div class="pl-lg-4">  
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Titre de la visioconférence</label>
                                        <input type="text" id="input-username" name="nom" class="form-control" placeholder="Indiquez le titre de votre visioconférence">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">  
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Url de la visioconférence</label>
                                        <input type="text" id="input-username" name="url" class="form-control" placeholder="Indiquez l'url de votre visioconférence">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Objectif de la visioconférences</label>
                                <textarea rows="4" class="form-control" name="objectif" placeholder="Indiquez l'objectif de votre visioconférences">Bonjour, bienvenue sur notre nouvelle visioconférence</textarea>
                            </div>
                        </div>

                        <div class="pl-lg-4">                           
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="dateDeDebut">Date de conférence</label>
                                        <input type="date" id="dateDeDebut" name="dateDeDebut" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-success align-items-center">Enregistrer la conférence</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php include 'vues/v_visios_list.php'; ?>
            
        </div>
    </div>
</div>