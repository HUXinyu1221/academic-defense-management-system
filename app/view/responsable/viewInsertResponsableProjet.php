<?php
require_once '../view/fragment/fragmentHeader.html';
require_once '../view/fragment/fragmentMenu.php';
require_once '../view/fragment/fragmentJumbotron.html';
?>

<div class="container mt-5">
    <h3>Ajout d’un projet</h3>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-danger"><?= $message ?></div>
    <?php endif; ?>

    <form method="post" action="router1.php?action=insertResponsableProjet">
        <div class="mb-3">
            <label for="label" class="form-label">Nom du projet</label>
            <input type="text" class="form-control" id="label" name="label" placeholder="Entrez le nom du projet" required>
        </div>

        <div class="mb-3">
            <label for="groupe" class="form-label">Taille du groupe</label>
            <select class="form-select" id="groupe" name="groupe" required>
                <option value="">-- Sélectionnez une taille --</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> étudiant<?= $i > 1 ? 's' : '' ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter le projet</button>
    </form>
</div>

<?php
require_once '../view/fragment/fragmentFooter.html';
?>
