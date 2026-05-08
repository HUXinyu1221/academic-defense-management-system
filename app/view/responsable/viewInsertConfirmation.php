<?php require '../view/fragment/fragmentHeader.html'; ?>
<?php require '../view/fragment/fragmentMenu.php'; ?>
<?php require '../view/fragment/fragmentJumbotron.html'; ?>

<div class="container mt-4">
    <h3 class="text-success">✅ Le nouveau projet a été ajouté avec succès !</h3>

    <ul class="list-group mt-4">
        <li class="list-group-item"><strong>ID du projet :</strong> <?= htmlspecialchars($projet['id']) ?></li>
        <li class="list-group-item"><strong>Label du projet :</strong> <?= htmlspecialchars($projet['label']) ?></li>
        <li class="list-group-item"><strong>Responsable :</strong> <?= htmlspecialchars($projet['nom']) . ' ' . htmlspecialchars($projet['prenom']) ?></li>
        <li class="list-group-item"><strong>Taille du groupe :</strong> <?= htmlspecialchars($projet['groupe']) ?> étudiant(s)</li>
    </ul>

    <a class="btn btn-primary mt-3" href="index.php?controller=responsable&action=mesProjets">🔙 Retour à mes projets</a>
</div>

<?php require '../view/fragment/fragmentFooter.html'; ?>
