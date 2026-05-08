<?php

session_start();
require_once '../model/ModelPersonne.php';

class ControllerConnexion {

    public static function Inscription() {

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/connexion/viewInscription.php';
        require ($vue);
    }

    public static function inscriptionConfirmation() {
        $results = ModelPersonne::insert(
                htmlspecialchars($_GET['nom']),
                htmlspecialchars($_GET['prenom']),
                isset($_GET['role_responsable']) ? 1 : 0,
                isset($_GET['role_examinateur']) ? 1 : 0,
                isset($_GET['role_etudiant']) ? 1 : 0,
                htmlspecialchars($_GET['login']),
                htmlspecialchars($_GET['password'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/connexion/viewInscriptionConfirmee.php';
        require ($vue);
    }

    public static function Deconnexion() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: router1.php?action=accueil");
        exit();
    }

    public static function Login() {

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/connexion/viewLogin.php';
        require ($vue);
    }

    public static function loginConfirmation() {

        $login = $_GET['login'];
        $password = $_GET['password'];
        $results = ModelPersonne::loginPersonne($login, $password);

        if ($results && count($results) > 0) {
            session_start();
            $_SESSION['login_id'] = $results[0]->getId();
            $_SESSION['id'] = $results[0]->getId(); 
            $_SESSION['nom'] = $results[0]->getNom();
            $_SESSION['prenom'] = $results[0]->getPrenom();
            $_SESSION['role_responsable'] = $results[0]->getRole_responsable();
            $_SESSION['role_examinateur'] = $results[0]->getRole_examinateur();
            $_SESSION['role_etudiant'] = $results[0]->getRole_etudiant();

            header("Location: router1.php?action=accueil");
        } else {
            echo "<p>Problème de connexion !</p>";
            echo "<a href='router1.php?action=Login'>Retour</a>";
        }
    }

    public static function estConnecté() {
        return isset($_SESSION['login_id']);
    }
}
?>

