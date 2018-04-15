<?php

namespace app\view;


class VueProduit
{

    function render($methode, $produit) {
        switch ($methode) {
            case 0:
                include('elements/header.php'); ?>
                <section id="content">
                <div class="container_12">
                    <h2>liste des enchères</h2>

                    <!--<div class="clear"></div>-->
                </div>
                <?php include('elements/footer.php');
                break;
        }
    }
}