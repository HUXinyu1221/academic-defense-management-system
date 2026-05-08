<?php require_once '../view/fragment/fragmentHeader.html'; ?>
<?php require_once '../view/fragment/fragmentMenu.php'; ?>
<?php require_once '../view/fragment/fragmentJumbotron.html'; ?>

<div class="container mt-4">
    <h3 style="color: green;">Planning du projet</h3>
    <?php if (empty($plannings)): ?>
        <p>Aucun créneau trouvé pour ce projet.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Creneau</th>
                    <th>Examinateur</th>
                    <th>Étudiants</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plannings as $row): ?>
                    <tr>
                        <td><?= $row['creneau'] ?></td>
                        <td><?= $row['exam_nom'] . ' ' . $row['exam_prenom'] ?></td>
                        <td><?= $row['etudiants'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once '../view/fragment/fragmentFooter.html'; ?>
