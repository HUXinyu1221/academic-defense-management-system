<?php

require_once '../model/ModelProjet.php';
require_once '../model/ModelPersonne.php';
require_once '../model/ModelRdv.php';

class ControllerResponsable {

// 1. Afficher tous les projets dont il/elle est responsable
    public static function listeResponsableProjets() {
        self::checkResponsable();
        $id = $_SESSION['id'];
        $projets = ModelProjet::getProjetsByResponsable($id);
        require_once '../view/responsable/viewListeResponsableProjets.php';
    }

    public static function insertResponsableProjet() {
        self::checkResponsable();
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $label = $_POST['label'] ?? '';
            $groupe = (int) ($_POST['groupe'] ?? 0);
            $id_responsable = $_SESSION['id'];

            if ($label && $groupe >= 1 && $groupe <= 5) {
                ModelProjet::ajouterProjet($label, $groupe, $id_responsable);

                $projet = ModelProjet::getProjetByLabelAndResponsable($label, $id_responsable);

                include 'config.php';
                $vue = $root . '/app/view/responsable/viewInsertConfirmation.php';
                require($vue);
                return;
            } else {
                $message = "Veuillez remplir tous les champs. Groupe entre 1 et 5.";
            }
        }

        require_once '../view/responsable/viewInsertResponsableProjet.php';
    }

    public static function listeResponsableExaminateurs() {
        self::checkResponsable(); 
        require_once '../model/ModelPersonne.php';
        $examinateurs = ModelPersonne::getAllExaminateurs();
        require '../view/responsable/viewListeResponsableExaminateurs.php';
    }

    public static function insertResponsableExaminateur() {
        self::checkResponsable();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');

            if ($nom !== '' && $prenom !== '') {
                require_once '../model/ModelPersonne.php';
                $examinateur = ModelPersonne::ajouterExaminateur($nom, $prenom);
                header('Location: router1.php?action=detailsExaminateur&id=' . $examinateur['id']);
                exit;
            } else {
                $message = "❌ Veuillez remplir tous les champs.";
                require '../view/responsable/viewInsertResponsableExaminateur.php';
            }
        } else {
            require '../view/responsable/viewInsertResponsableExaminateur.php';
        }
    }

    public static function detailsExaminateur() {
        self::checkResponsable();

        $id = $_GET['id'] ?? null;

        if ($id) {
            require_once '../model/ModelPersonne.php';
            $examinateur = ModelPersonne::getById($id);
            require '../view/responsable/viewDetailsExaminateur.php';
        } else {
            echo "Aucun examinateur spécifié.";
        }
    }

    public static function listeExaminateursDuProjet() {
        $id_responsable = $_SESSION['id'];
        $projets = ModelProjet::getProjetsByResponsable($id_responsable);

        if (isset($_GET['id_projet'])) {
            $id_projet = $_GET['id_projet'];
            $examinateurs = ModelCreneau::getExaminateursByProjet($id_projet);
        } else {
            $id_projet = null;
            $examinateurs = [];
        }

        include '../view/responsable/viewListeExaminateursDuProjet.php';
    }

public static function planningProjet() {

    self::checkResponsable();
    $id_responsable = $_SESSION['id'];


    $projets = ModelProjet::getProjetsByResponsable($id_responsable);


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_projet'])) {
        $id_projet = $_POST['id_projet'];

        $plannings = ModelRdv::getPlanningByProjet($id_projet);

        require('../view/responsable/viewPlanningProjet.php');
    } else {

        require('../view/responsable/viewSelectPlanningProjet.php');
    }
}

    private static function checkResponsable() {
        if (!isset($_SESSION['id']) || $_SESSION['role_responsable'] != 1) {
            die("Accès interdit. Vous devez être responsable.");
        }
    }
}
