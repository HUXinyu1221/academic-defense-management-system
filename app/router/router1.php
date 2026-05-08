<?php

require ('../controller/ControllerExaminateur.php');
require ('../controller/ControllerConnexion.php');
require ('../controller/ControllerEtudiant.php');
require ('../controller/ControlleriCalendar.php');
require ('../controller/ControllerResponsable.php');
require_once '../controller/ControllerOptimisation.php';

$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $param);
$action = isset($param["action"]) ? htmlspecialchars($param["action"]) : "accueil";

// --- Liste des méthodes autorisées
switch ($action) {

    // Actions liées au Responsable
    case "listeResponsableProjets":
    case "insertResponsableProjet":
        ControllerResponsable::$action();
        break;

    case "insertResponsableExaminateur":
        ControllerResponsable::insertResponsableExaminateur();
        break;

    case "detailsExaminateur":
        ControllerResponsable::detailsExaminateur();
        break;

    case "listeResponsableExaminateurs":
        ControllerResponsable::listeResponsableExaminateurs();
        break;

    case "listeExaminateursDuProjet":
        ControllerResponsable::listeExaminateursDuProjet();
        break;

    case "planningProjet":

        ControllerResponsable::planningProjet();
        break;
    case "innovation1":
        ControlleriCalendar::$action();
        break;
    case "innovation2":
        ControllerOptimisation::innovation2();
        break;

    //Action innovante
    case "telecharger":
        ControlleriCalendar::$action();
        break;
    case "telechargerExam":
        ControlleriCalendar::$action();
        break;

    //Actions de l'Étudiant
    case "rdvSoutenance" :
        ControllerEtudiant::$action();
        break;
    case "creneauChercher" :
        ControllerEtudiant::$action();
        break;
    case "rdvProjet" :
        ControllerEtudiant::$action();
        break;

    case "rdvCreated" :
        ControllerEtudiant::$action();
        break;
    //Actions de Connexion
    case "Inscription" :
        ControllerConnexion::$action();
        break;
    case "inscriptionConfirmation" :
        ControllerConnexion::$action();
        break;
    case "Deconnexion" :
        ControllerConnexion::$action();
        break;
    case "Login" :
        ControllerConnexion::$action();
        break;
    case "loginConfirmation" :
        ControllerConnexion::$action();
        break;
    //Actions liées à l'examinateur
    case "examListeProjet" :
        ControllerExaminateur::$action();
        break;
    case "examListeCreneaux" :
        ControllerExaminateur::$action();
        break;
    case "examListeCreneauxPourProjet" :
        ControllerExaminateur::$action();
        break;
    case "examAllProjet" :
        ControllerExaminateur::$action();
        break;
    case "creneauCreate" :
        ControllerExaminateur::$action();
        break;
    case "creneauCreated" :
        ControllerExaminateur::$action();
        break;
    case "examCreneauxConsecutifs" :
        ControllerExaminateur::$action();
        break;
    case "creneauListeCreate" :
        ControllerExaminateur::$action();
        break;
    case "creneauListeCreated" :
        ControllerExaminateur::$action();
        break;

    //Action par défaut
    default:
        $action = "accueil";
        ControllerExaminateur::$action();
}
?>