<?php require_once '../view/fragment/fragmentHeader.html'; ?>
<?php require_once '../view/fragment/fragmentMenu.php'; ?>
<?php require_once '../view/fragment/fragmentJumbotron.html'; ?>

<div class="container mt-4">
    <h3 style="color: red;">Voir le planning d’un projet</h3>
    <form method="post" action="router1.php?action=planningProjet">
        <div class="row mb-3">
            <label for="id_projet" class="col-sm-3 col-form-label fw-bold">Sélectionnez un projet :</label>
            <div class="col-sm-6">
                <select name="id_projet" id="id_projet" class="form-select" required>
                    <option value="">-- Choisir un projet --</option>
                    <?php foreach ($projets as $projet): ?>
                        <option value="<?= $projet['id'] ?>"><?= htmlspecialchars($projet['label']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-success">Voir le planning</button>
            </div>
        </div>
    </form>
</div>

<?php require_once '../view/fragment/fragmentFooter.html'; ?>
