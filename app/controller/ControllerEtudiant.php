<?php

require_once '../model/ModelRdv.php';
require_once '../model/ModelProjet.php';

class ControllerEtudiant {

    //Listes des actions de l'étudiant
    public static function rdvSoutenance() {
        $results = ModelRdv::getRdvEtudiant();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/etudiant/viewRdv.php';
        require ($vue);
    }

    public static function creneauChercher() {
        $results = ModelProjet::getAllNamesWithId();

        include 'config.php';
        $vue = $root . '/app/view/etudiant/viewInsertRdv_1.php';
        require ($vue);
    }

    public static function rdvProjet() {
        $project = $_GET['projet'];
        $results = ModelCreneau::getCreneauProjet($project);

        include 'config.php';
        $vue = $root . '/app/view/etudiant/viewInsertRdv_2.php';
        require ($vue);
    }

    public static function rdvCreated() {
        $results = ModelRdv::insert(
                htmlspecialchars($_GET['creneau']),
                htmlspecialchars($_SESSION['login_id'])
        );

        include 'config.php';
        $vue = $root . '/app/view/etudiant/viewInsertedRdv.php';
        require ($vue);
    }
}
?>

