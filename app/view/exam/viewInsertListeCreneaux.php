<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?> 

        <form role="form" method='get' action='router1.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='creneauListeCreated'>
                <label for="id">Sélectionnez un projet : </label> <select class="form-control" id='id' name='projet'>
                    <?php
                    foreach ($results as $projet) {
                        $id = htmlspecialchars($projet['id']);
                        $label = htmlspecialchars($projet['label']);
                        echo ("<option value='$id'>$label</option>");
                    }
                    ?>
                </select>
                <label class='w-25' for="id">Quel créneau ? </label><input type="datetime-local" name='creneau'> <br/>
                <label for="id">Nombre de créneaux consécutifs ?</label><select class="form-control" id='id' name='consecutif'>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <p/>
            <br/> 
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
        <p/>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>