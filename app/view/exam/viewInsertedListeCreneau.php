<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <table class = "table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope = "col">projet</th>
                    <th scope = "col">créneau</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($liste_creneaux); $i++) {
                    $projet = htmlspecialchars($liste_creneaux[$i]['projet']);
                    $creneau = htmlspecialchars($liste_creneaux[$i]['creneau']);
                    echo "<tr><td>$projet</td><td>$creneau</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>  

