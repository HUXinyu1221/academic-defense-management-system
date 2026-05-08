<?php
require_once '../view/fragment/fragmentHeader.html';
require_once '../view/fragment/fragmentMenu.php';
require_once '../view/fragment/fragmentJumbotron.html';
?>

<div class="container mt-4">
    <h3 style="color: red;">Liste des examinateurs enregistrés dans la base</h3>

    <table class="table table-bordered table-hover mt-3">
        <thead style="background-color: #1976d2; color: white;">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 0; ?>
            <?php foreach ($examinateurs as $exam): ?>
                <?php
                    $rowColor = $index % 2 === 0 ? '#e3f2fd' : '#bbdefb';
                    $index++;
                ?>
                <tr style="background-color: <?= $rowColor ?>;">
                    <td><?= htmlspecialchars($exam['nom']) ?></td>
                    <td><?= htmlspecialchars($exam['prenom']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../view/fragment/fragmentFooter.html'; ?>
