<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Gestion des produits </h3>
                                <?php if(isset($validation)){ echo "<font style='color: green'>",$validation,"</font>"; }?>
                                <?php if(isset($erreur)){ echo "<font style='color: red'>",$erreur,"</font>"; }?>
                        </div>
                    </div>
                </div>
                <?php 
                    foreach($leProduit as $unProduit){ 
                ?> 
                <div class="card-body">
                    <form method="post" action="index.php?uc=gestion&gestion=modifier_produit">
                        <h6 class="heading-small text-muted mb-4">Informations sur le produits </h6>
                        <div class="pl-lg-4">  
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nom-produit">Nom du produit</label>
                                        <input type="text" id="nom-produit" name="titreProduit" class="form-control" 
                                               placeholder="Indiquez le nom de votre produit" autofocus="" value="<?php echo $unProduit['nom']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Les objectifs</label>
                                <textarea rows="4" class="form-control" name="objectif" 
                                          placeholder="Indiquez les différents objectifs de votre produit"><?php echo $unProduit['objectif']; ?> </textarea>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Les informations</label>
                                <textarea rows="4" class="form-control" name="information" 
                                          placeholder="Indiquez les différents informations de votre produit"><?php echo $unProduit['information']; ?></textarea>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Les effets indésirables</label>
                                <textarea rows="4" class="form-control" name="effetIndesirable" 
                                          placeholder="Indiquez les différents effets indésirables de votre produit"><?php echo $unProduit['effetIndesirable']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <button type="submit" name="id" value="<?php echo $unProduit['id']; ?>" class="btn btn-success align-items-center">Enregistrer le produit</button>
                        </div>
                    </form>
                </div>
                <?php }?>
            </div>
            
            <?php include 'vues/v_produits_list.php'; ?>
            
        </div>
    </div>
</div>