<?php

namespace app\view;

class View
{

    function render($methode) {
        switch ($methode) {
            case 0 :
                ?>
                <!DOCTYPE HTML>
                <html lang="fr">
                <head>
                    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                    <title>Accueil</title>
                </head>
                <body>
                    <h1>Bonjour</h1>
                </body>
                </html>
                <?php
                break;
        }
    }
}