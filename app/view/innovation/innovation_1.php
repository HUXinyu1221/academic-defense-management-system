<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?> 
        <br/>
        <div class="mt-4 p-5 bg-dark text-white rounded">
            <h1>Innovation 1 : Téléchargement d'un iCalendar</h1>
        </div>
        <div class="mt-4 p-5 bg-dark text-white rounded">

            <h2>Qu'est ce qu'un iCalendar ?</h2>
            <p>iCalendar est un format de données utilisé par la plupart des calendriers en ligne.
                Ainsi télécharger le fichier que nous vous proposons vous permettra de rajouter sur votre calendrier personnel
                les créneaux des soutenances.</p>
            <h2>Où peut-on utiliser la fonctionnalité ?</h2>
            <p>La fonctionnalité est utilisable par :</p>
            <ul>
                <li>Les Étudiants dans la rubrique "Liste de mes rendez-vous"</li>
                <li>Les Examinateurs dans la rubrique "Liste complète de mes créneaux"</li>
            </ul>
        </div>
        <div class="mt-4 p-5 bg-dark text-white rounded">

            <h2>Tutoriel</h2>
            <p>Tout d'abord, en tant qu'étudiant je me rends dans la section "Liste de mes rendez-vous"</p>
            <img src="https://i.imgur.com/2UuQ1WB.png" alt=""/>
            <p>Ensuite, je peux consulter la liste des créneaux où j'ai un rendez-vous, mais je peux également cliquer sur le bouton en bas
                pour télécharger le fichier iCalendar qui me permettra de rajouter mes rendez-vous sur mon calendrier personnel</p>
            <img src="https://i.imgur.com/aGDbxRY.png" alt=""/>
            <p>Enfin, je peux ouvrir le fichier iCalendar dans mon calendrier personnel et constater que le créneau de la soutenance qui m'attend est ajouté.</p>
            <img src="https://i.imgur.com/D0Rspnh.png" height="500" alt=""/>
            <img src="https://i.imgur.com/hK29ZJ1.png" height="500" alt=""/>


        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>




