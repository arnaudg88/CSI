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
                    <div class="grid_12">
                        <img src="images/slide1.jpg" alt="" class="img_inner fleft">
                        <div class="extra_wrapper">
                            <div class="text1 tx__2"><a href="#"><?php $produit->$libelle ?></a></div>
                            <?php echo '<ul>
                              <li>Date de début d\'enchères ' . $produit->dateMV . '</li>
                               <li>Date de fin d\'enchères ' . $produit->dateFE . '</li>
                               <li>Prix de début d\'enchères ' . $produit->prixDep . '</li>
                               <li>Prix de fin d\'enchères ' . $produit->prixFin . '</li>
                               <li>Enchere maximale : ' . $produit->enchereMax . '</li>
                               <li>Etat de la vente : ' . $produit->etat . '</li>
                             </ul>'
                             ?>
                            <?php $produit->description ?> <br>
                            <a href="#" class="link-1">Enchérir</a>
                            <a href="#" class="link-1">Annuler enchère</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php include('elements/footer.php');
                break;
        }
    }
}
