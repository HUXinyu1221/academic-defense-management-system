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
            <h1>Innovation 2</h1>
        </div>
        <div class="mt-4 p-5 bg-dark text-white rounded">
            <h2>1. Utilisation de fonctions pour écrire du code</h2>

            <p>
                Lors de ce projet, on réutilise beaucoup les mêmes procédés à chaque fois.  
                Ainsi, au lieu de tout le temps réécrire la même chose, il serait intéressant de faire un fichier contenant des fonctions  
                permettant d'économiser du temps d'écriture. Ce serait par exemple un fichier :
            </p>

            <p>
                <img src="https://i.imgur.com/qgmevIh.png">
            </p>

            <p>
                On remarque par exemple que toutes les méthodes dans les contrôleurs se ressemblent.  
                Il serait judicieux de faire une même fonction qui change uniquement la fonction appelée et le lien de sa vue.  
                On pourrait y gagner un code plus aéré, plus agréable à lire.
            </p>

            <p>
                Pareil pour les vues : pour afficher les tableaux,  
                le tout pourrait être fait selon une fonction au lieu d’à chaque fois devoir adapter par rapport aux données qu’on reçoit.  
                Cela pourrait nous faire gagner du temps pour refaire des vues.
            </p>
        </div>

    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>


