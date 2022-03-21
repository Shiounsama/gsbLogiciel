<div class="card">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0">Liste des produits</h3>
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
                                <th>Nom</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        
                        <?php 
                            foreach($lesProduits as $unProduit){ 
                        ?> 
                        <tbody>
                            <tr>
                                <td></td>
                                <td class="table-user">
                                    <b> <?php echo $unProduit['nom']; ?> </b>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-2">
                                            <form method="post" action="index.php?uc=gestion&gestion=modification_produit">
                                                <button type="submit" name="modification_produit" value="<?php echo $unProduit['id']; ?>" 
                                                        class="btn btn-info align-items-center" data-toggle="tooltip" data-original-title="Modification">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-2">
                                            <form method="post" action="index.php?uc=gestion&gestion=supprimer_produit">
                                                <button type="submit" name="supprimer_produit" value="<?php echo $unProduit['id']; ?>" 
                                                        class="btn btn-danger align-items-center" data-toggle="tooltip" data-original-title="Suppression">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>
                </div>
            </div>