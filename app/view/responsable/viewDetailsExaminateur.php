<?php
require_once '../view/fragment/fragmentHeader.html';
require_once '../view/fragment/fragmentMenu.php';
require_once '../view/fragment/fragmentJumbotron.html';
?>

<div class="container mt-4">
    <h3>Examinateur ajouté avec succès</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>ID :</strong> <?= htmlspecialchars($examinateur['id']) ?></li>
        <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($examinateur['nom']) ?></li>
        <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($examinateur['prenom']) ?></li>
    </ul>
</div>

<?php require_once '../view/fragment/fragmentFooter.html'; ?>
