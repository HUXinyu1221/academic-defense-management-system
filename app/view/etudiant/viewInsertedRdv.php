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
            echo ("<h3>Le nouveau rendez-vous a été fixé </h3>");
            echo("<ul>");
            echo ("<li>id = " . $results . "</li>");
            echo ("<li>creneau = " . $_GET['creneau'] . "</li>");
            echo ("<li>étudiant = " . $_SESSION['login_id'] . "</li>");
            echo("</ul>");
        } else {
            echo ("<h3>Problème d'insertion du Créneau</h3>");
            echo ("id = " . $_GET['creneau']);
        }

        echo("</div>");

        include $root . '/app/view/fragment/fragmentFooter.html';
        ?>


