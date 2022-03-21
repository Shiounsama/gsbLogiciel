<?php if ($cookie != 1){?>
<div class="modal" id="les_cookies">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hey, c'est nous les cookies !</h4>
                    </div>
                        <p class="modal-body">Bonjour, pour votre confort nous vous propons d'accepter les cookies.</p>
                    <div class="modal-footer">
                        <a data-dismiss="modal" class="btn btn-secondary">Uniquement ceux nécessaire</a>
                        <a href="index.php?uc=cookie&action=cookies_accepter" class="btn btn-success">Accepter tout les cookies</a>
                    </div>
                </div>
            </div>
        </div>

<?php } ?>


<?php $laMaintenancePrevention = $pdo->maintenancePrevention(); 
    if($laMaintenancePrevention['actif'] == 1)
    { ?>

<marquee style="background-color: #c12e2a; color: #fff; padding: 2em;" scrollamount="25" ><font size="5px">
    <?php echo $laMaintenancePrevention['informations'] ?> Du 
    <?php $dateDebut = new DateTime($laMaintenancePrevention['dateDebut']);
        echo $dateDebut->Format('d-m-Y'); ?> au
    <?php $dateFin = new DateTime($laMaintenancePrevention['dateFin']);
    echo $dateFin->Format('d-m-Y'); ?> .</font>
</marquee>
      
<?php }?>
