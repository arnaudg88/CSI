<?php

namespace app\view;


use app\model\Produits;

class VueListeEnchere
{
    function render($methode, $encheres=null)
    {
        switch ($methode) {
            case 0 :
                ?>
                <?php include('elements/header.php'); ?>
                <section id="content">
                <div class="container_12">
                    <h2>liste des enchères</h2>


                        <?php
                        foreach ($encheres as $v) {
                            echo $this->divProduit($v);
                        }

                        ?>

                    <!--<div class="clear"></div>-->
                </div>
                <?php include('elements/footer.php'); ?>

                <?php
                break;
        }
    }

    /**
     * @param Produits $produit
     */
    function divProduit($produit) {
        return '<div class="grid_12">
            <div class="extra_wrapper">
                <img src="images/'.$produit->lienImg.'" alt="" class="img_inner fleft"/>
                <div class="text1 tx__2"><a href="#">'.$produit->libelle.'</a></div>
                    <p> '.$produit->description.' </p><br>
                    <a href="#" class="link-1">Enchérir</a>
                    <a href="#" class="link-1">Annuler enchère</a>
            </div>
        </div>';
    }
}