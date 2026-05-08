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
                <input type="hidden" name='action' value='inscriptionConfirmation'>
                <label><input type="checkbox" name="role_responsable"> Responsable</label><br/>
                <label><input type="checkbox" name="role_examinateur"> Examinateur</label><br/>
                <label><input type="checkbox" name="role_etudiant"> Etudiant</label><br/>
                <label class='w-25' for="id">Nom : </label><input type="text" name='nom'><br/>
                <label class='w-25' for="id">Prénom : </label><input type="text" name='prenom'><br/>
                <label class='w-25' for="id">Login : </label><input type="text" name='login'><br/>
                <label class='w-25' for="id">Password : </label><input type="password" name='password'><br/>
                <br/>
            </div>
            <p/>
            <br/> 
            <button class="btn btn-primary" type="submit">S'inscrire</button>
        </form>
        <p/>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>




