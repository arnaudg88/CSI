<?php

namespace app\view;

class View
{

    function render($methode) {
        switch ($methode) {
            case 0 :
                ?>
                  <?php include('elements/header.php');?>
                <body>
                    <h1>Bonjour</h1>
                    <?php include('elements/footer.php');?>
                    <h1>Voici le second titre</h1>
                <?php
                break;
        }
    }
}
