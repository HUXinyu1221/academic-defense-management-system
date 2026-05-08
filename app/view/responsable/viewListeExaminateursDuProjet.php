<?php
require_once '../view/fragment/fragmentHeader.html';
require_once '../view/fragment/fragmentMenu.php';
require_once '../view/fragment/fragmentJumbotron.html';
?>

<div class="container mt-4">
    <h3 style="color: red;">Voir les examinateurs d’un projet</h3>

    <!-- Formulaire de sélection de projet -->
    <form method="get" action="router1.php" class="mb-4">
        <input type="hidden" name="action" value="listeExaminateursDuProjet">

        <div class="mb-3 row">
            <label for="id_projet" class="col-sm-3 col-form-label fw-bold">Sélectionnez un projet :</label>
            <div class="col-sm-6">
                <select name="id_projet" id="id_projet" class="form-select" required>
                    <option value="">-- Choisir un projet --</option>
                    <?php foreach ($projets as $projet): ?>
                        <option value="<?= $projet['id'] ?>">
                            <?= htmlspecialchars($projet['label']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary">Afficher les examinateurs</button>
            </div>
        </div>
    </form>

    <!-- Résultat (si examinateurs sont disponibles) -->
    <?php if (isset($examinateurs) && count($examinateurs) > 0): ?>
        <table class="table table-bordered table-hover mt-4">
            <thead style="background-color: #1976d2; color: white;">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Créneau</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 0; ?>
                <?php foreach ($examinateurs as $exam): ?>
                    <?php $rowColor = $index % 2 === 0 ? '#e3f2fd' : '#bbdefb'; $index++; ?>
                    <tr style="background-color: <?= $rowColor ?>;">
                        <td><?= htmlspecialchars($exam['nom']) ?></td>
                        <td><?= htmlspecialchars($exam['prenom']) ?></td>
                        <td><?= htmlspecialchars($exam['creneau']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (isset($examinateurs)): ?>
        <div class="alert alert-warning mt-4">Aucun examinateur affecté à ce projet.</div>
    <?php endif; ?>
</div>

<?php require_once '../view/fragment/fragmentFooter.html'; ?>
