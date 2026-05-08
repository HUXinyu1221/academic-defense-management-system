<?php
require '../view/fragment/fragmentHeader.html';
require '../view/fragment/fragmentMenu.php';
require '../view/fragment/fragmentJumbotron.html';
?>

<div class="container mt-4">
    <h3 style="color: red;">Liste des projets de <?= htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']) ?></h3>

    <table class="table table-bordered table-hover mt-3">
        <thead style="background-color: #1976d2; color: white;">
            <tr>
                <th>Label</th>
                <th>Responsable</th>
                <th>Taille du groupe</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 0; ?>
            <?php foreach ($projets as $projet): ?>
                <?php
                    $rowColor = $index % 2 === 0 ? '#e3f2fd' : '#bbdefb';
                    $index++;
                ?>
                <tr style="background-color: <?= $rowColor ?>;">
                    <td><?= htmlspecialchars($projet['label']) ?></td>
                    <td><?= htmlspecialchars($projet['nom']) . ' ' . htmlspecialchars($projet['prenom']) ?></td>
                    <td><?= htmlspecialchars($projet['groupe']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../view/fragment/fragmentFooter.html'; ?>
