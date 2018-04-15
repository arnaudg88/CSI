<?php

namespace app\view;

class LesEncheres
{

    function render($methode)
    {
        switch ($methode) {
            case 0 :
                ?>
                <?php include('elements/header.php'); ?>
                <section id="content">
                <div class="container_12">
                    <div class="grid_12">
                        <h2>liste des enchères</h2>
                        <img src="images/slide1.jpg" alt="" class="img_inner fleft">
                        <div class="extra_wrapper">
                            <div class="text1 tx__2"><a href="#">Nom produit</a></div>
                            <p>Lorem ipsum dolor sit tetur dipiscing elit. In mollis erat mattis neque facilisisultries
                                wertolio dasererat rutrum. </p>
                            Horem ipsum dolor sit tetur dipiscing elit.Vivamus at magna non nunc thyrhoncus. Aliquam
                            nibh ante, egestas id dictum a, commodo luctus libero. Praesent faucibus malesuada faucibus.
                            Donec laoreet metus id laoreet malesuada. Lorem ipsum <br>
                            <a href="#" class="link-1">Enchérir</a>
                            <a href="#" class="link-1">Annuler enchère</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php include('elements/footer.php'); ?>

                <?php
                break;
        }
    }
}
