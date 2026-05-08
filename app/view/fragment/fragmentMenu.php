<nav class="navbar navbar-expand-lg bg-info fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="router1.php?action=accueil">VERCOUTRE-HU | </a> 
        <?php
        if (ControllerConnexion::estConnecté()) {
            if (isset($_SESSION['nom'])) {
                echo '<span class="navbar-text ms-2">' . htmlspecialchars($_SESSION['nom']) . " " . htmlspecialchars($_SESSION['prenom']) . '</span>';
            }
        }
        ?>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Menu Responsable -->
                <?php
                if (!empty($_SESSION['role_responsable'])) {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Responsable</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="router1.php?action=listeResponsableProjets">Liste de mes projets</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=insertResponsableProjet">Ajouter un projet</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="router1.php?action=listeResponsableExaminateurs">Liste des examinateurs</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=insertResponsableExaminateur">Ajouter un examinateur</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=listeExaminateursDuProjet">Examinateurs d’un projet</a></li>
                            <li><hr class="dropdown-divider"></li> 
                            <li><a class="dropdown-item" href="router1.php?action=planningProjet">Planning d’un projet</a></li>
                        </ul>
                    </li>
                    <?php
                }

                if (!empty($_SESSION['role_examinateur'])) {
                    ?>
                    <!-- Menu Examinateur -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Examinateur</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="router1.php?action=examListeProjet">Liste des projets</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=examListeCreneaux">Liste complète de mes créneaux</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=examAllProjet">Liste de mes créneaux pour un projet</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=creneauCreate">Ajouter un créneau à un projet</a></li> 
                            <li><a class="dropdown-item" href="router1.php?action=creneauListeCreate">Ajouter des créneaux consécutifs</a></li>
                        </ul>
                    </li>
                    <?php
                }
                if (!empty($_SESSION['role_etudiant'])) {
                    ?>
                    <!-- Menu Etudiant -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Étudiant</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="router1.php?action=rdvSoutenance">Liste de mes rendez-vous</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=creneauChercher">Prendre un RDV pour un projet</a></li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <!-- Menu des Innovations -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router1.php?action=innovation1">Innovation 1 : Téléchargement d'un iCalendar</a></li>
                        <li><a class="dropdown-item" href="router1.php?action=innovation2">Innovation 2 : Usage de fonctions</a></li>
                    </ul>
                </li>
                <!-- Menu de Connexion -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se Connecter</a>
                    <ul class="dropdown-menu">
                        <?php
                        if (!ControllerConnexion::estConnecté()) {
                            echo '<li><a class="dropdown-item" href="router1.php?action=Login">Login</a></li>';
                            echo '<li><a class="dropdown-item" href="router1.php?action=Inscription">S\'inscrire</a></li>';
                        }

                        if (ControllerConnexion::estConnecté()) {
                            echo '<li><a class="dropdown-item" href="router1.php?action=Deconnexion">Déconnexion</a></li>';
                        }
                        ?>
                    </ul>
                </li>
        </ul>
    </div>
</div>
</nav>
