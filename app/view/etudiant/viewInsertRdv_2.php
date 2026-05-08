<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?> 

        <?php if (!empty($results)) { ?>
            <form role="form" method='get' action='router1.php'>
                <div class="form-group">
                    <input type="hidden" name='action' value='rdvCreated'>

                    <label for="id">Quel créneau pour ce projet ? </label> <select class="form-control" id='id' name='creneau'>
                        <?php
                        foreach ($results as $creneau) {
                            $id = htmlspecialchars($creneau->getId());
                            $timing = htmlspecialchars($creneau->getCreneau());
                            echo ("<option value='$id'>$timing</option>");
                        }
                        ?>
                    </select>
                </div>
                <p/>
                <br/> 
                <button class="btn btn-primary" type="submit">Valider</button>
            </form>
        <?php } else { ?>
            <p>Aucun créneau disponiblez, veuillez retourner en arrière.</p>
        <?php } ?>

        <p/>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>




