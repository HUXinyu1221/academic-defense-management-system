<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <table class = "table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope = "col">projet</th>
                    <th scope = "col">créneau</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $element) {
                    printf("<tr><td>%s</td><td>%s</td></tr>",
                            $element->getLabel(), $element->getCreneau());
                }
                ?>
            </tbody>
        </table>
        <form method="get" action='router1.php'>
            <input type="hidden" name='action' value='telechargerExam'>
            <button type="submit" name="download" value="1" class="btn btn-primary">Télécharger votre iCalendar</button>
        </form>

    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>  

