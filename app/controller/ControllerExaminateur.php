<?php

require_once '../model/ModelProjet.php';
require_once '../model/ModelCreneau.php';

class ControllerExaminateur {

    //Accueil
    public static function accueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewAccueil.php';
        if (DEBUG)
            echo ("ControllerExaminateur : accueil : vue = $vue");
        require ($vue);
    }

    //Listes des actions de l'examinateur
    public static function examListeProjet() {
        $results = ModelProjet::getProjetExaminateur();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/exam/viewListeProjets.php';
        require ($vue);
    }

    public static function examListeCreneaux() {
        $results = ModelCreneau::getCreneauExaminateur();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/exam/viewListeCreneaux.php';
        require ($vue);
    }

    public static function examAllProjet() {
        $results = ModelProjet::getAllNames();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/exam/viewProjet.php';
        require ($vue);
    }

    public static function examListeCreneauxPourProjet() {
        $project_name = $_GET['id'];
        $results = ModelCreneau::getCreneauExaminateurProjet($project_name);

        include 'config.php';
        $vue = $root . '/app/view/exam/viewListeCreneaux.php';
        require ($vue);
    }

    public static function creneauCreate() {
        $results = ModelProjet::getAllNamesWithId();

        include 'config.php';
        $vue = $root . '/app/view/exam/viewInsertCreneau.php';
        require ($vue);
    }

    public static function creneauCreated() {
        $results = ModelCreneau::insert(
                htmlspecialchars($_GET['projet']), htmlspecialchars($_GET['examinateur']), htmlspecialchars($_GET['creneau'])
        );

        include 'config.php';
        $vue = $root . '/app/view/exam/viewInsertedCreneau.php';
        require ($vue);
    }

    public static function creneauListeCreate() {
        $results = ModelProjet::getAllNamesWithId();

        include 'config.php';
        $vue = $root . '/app/view/exam/viewInsertListeCreneaux.php';
        require ($vue);
    }

    public static function creneauListeCreated() {
        $creneau = htmlspecialchars($_GET['creneau']);
        $iterations = $_GET['consecutif'];
        $liste_creneaux = [];
        for ($i = 1; $i <= $iterations; $i++) {
            $results = ModelCreneau::insert(
                    htmlspecialchars($_GET['projet']),
                    htmlspecialchars($_SESSION['login_id']),
                    $creneau
            );
            $liste_creneaux[] = [
                'projet' => $_GET['projet'],
                'creneau' => $creneau
            ];
            $creneau = self::ajouterUneHeure($creneau);
        }

        include 'config.php';
        $vue = $root . '/app/view/exam/viewInsertedListeCreneau.php';
        require ($vue);
    }

    public static function ajouterUneHeure($creneau) {
        $post_creneau = new DateTime($creneau);
        $post_creneau->modify('+1 hour');
        return $post_creneau->format('Y-m-d H:i:s');
    }
}
?>

