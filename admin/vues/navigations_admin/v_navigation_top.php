<!--
=========================================================
* GSB Extranet - NAVIGATION TOP
=========================================================
-->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

<!--
            <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search" type="text">
                    </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </form>
-->

            <ul class="navbar-nav align-items-center  ml-md-auto ">
                
                <!-- Mobile -->
                
                <li class="nav-item d-xl-none">
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>                
            </ul>
          
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                
                <!-- Profil -->
                
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="assets/img/profil/User_Icon.png">
                            </span>
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">
                                    <?php if(isset($_SESSION['prenom'])){ echo  $_SESSION['prenom']."  ".$_SESSION['nom']; } else { echo "Nom Prénom";}?>
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Bienvenue <?php if(isset($_SESSION)){ echo  $_SESSION['prenom']; } else { echo "Prénom";}?> !</h6>
                        </div>
<!--                        <a href="index.php?uc=navigation&action=profil" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>Mon Profil <sup>DEV</sup></span>
                        </a>
                        <a href="index.php?uc=navigation&action=reglage" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>Mes Reglages <sup>DEV</sup></span>
                        </a>
                        <a href="index.php?uc=navigation&action=historique" class="dropdown-item">
                            <i class="ni ni-calendar-grid-58"></i>
                            <span>Mon Activité <sup>DEV</sup></span>
                        </a>
-->
                        <div class="dropdown-divider"></div>
                        <a href="index.php?uc=session&action=deconnexion" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>
                </li>
                
                <!-- END Profil -->
                
            </ul>
        </div>
    </div>
</nav>
