<?php
require_once '../view/fragment/fragmentHeader.html';
require_once '../view/fragment/fragmentMenu.php';
require_once '../view/fragment/fragmentJumbotron.html';
?>

<div class="container mt-4">
    <h3>Ajout d’un examinateur</h3>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info mt-3"><?= $message ?></div>
    <?php endif; ?>

    <form method="post" action="router1.php?action=insertResponsableExaminateur">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php require_once '../view/fragment/fragmentFooter.html'; ?>
