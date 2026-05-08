<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <!-- ===================================================== -->
        <?php
        if ($results) {
            echo ("<h3>Le nouvel utilisateur a été ajouté </h3>");
            echo("<ul>");
            echo ("<li>id = " . $results . "</li>");
            echo ("<li>nom = " . $_GET['nom'] . "</li>");
            echo ("<li>prenom = " . $_GET['prenom'] . "</li>");
            echo ("<li>login = " . $_GET['login'] . "</li>");
            echo ("<li>role_responsable = " . (isset($_GET['role_responsable']) ? "1" : "0") . "</li>");
            echo ("<li>role_examinateur = " . (isset($_GET['role_examinateur']) ? "1" : "0") . "</li>");
            echo ("<li>role_etudiant = " . (isset($_GET['role_etudiant']) ? "1" : "0") . "</li>");
            echo("</ul>");
        } else {
            echo ("<h3>Problème d'insertion de l'utilisateur</h3>");
            echo ("nom = " . $_GET['nom']);
        }

        echo("</div>");

        include $root . '/app/view/fragment/fragmentFooter.html';
        ?>


