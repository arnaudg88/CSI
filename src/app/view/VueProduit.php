<?php

namespace app\view;


class VueProduit
{

    function render($methode, $produit=null) {
        switch ($methode) {
            case 0:
                include('elements/header.php'); ?>
                <section id="content">
                <div class="container_12">
                    <div class="grid_12">
                        <img src="images/slide1.jpg" alt="" class="img_inner fleft">
                        <div class="extra_wrapper">
                            <div class="text1 tx__2"><a href="#"><?php echo $produit->libelle ?></a></div>
                            <?php echo '<ul>
                              <li>Date de début d\'enchères ' . $produit->dateMV . '</li>
                               <li>Date de fin d\'enchères ' . $produit->dateFE . '</li>
                               <li>Prix de début d\'enchères ' . $produit->prixDep . '</li>
                               <li>Prix de fin d\'enchères ' . $produit->prixFin . '</li>
                               <li>Enchere maximale : ' . $produit->enchereMax . '</li>
                               <li>Etat de la vente : ' . $produit->etat . '</li>
                             </ul>'
                             ?>
                            <?php echo $produit->description ?> <br>

                            <div class="grid_6">
                                <form id="contact-form" method="post">
                                <div class="contact-form-loader"></div>
                                <div class="grid_12">
                                <?php $i = $produit->enchereMax+1;
                                    echo '<input type="number" id="prixEnch" name="montant" placeholder="00.00€" min="'.$i.'"data-constraints="@JustNumbers">';
                                ?></div>
                                </form>
                                <div class="ta__right">
                                    <button href="#" class="link-1 white" type="submit" form="contact-form" data-type="submit">Enchérir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                </section>
                <?php include('elements/footer.php');
                break;

            case 1:
                include('elements/header.php');
                ?>
                <article class="block-1 contacts ">
                    <div class="container_12">
                        <div class="grid_12">
                            <h2 class="white ta__center">Ajout d'un produit</h2>
                        </div>
                        <div class="clear"></div>
                        <form id="contact-form" method="post">
                            <div class="contact-form-loader"></div>
                            <div class="grid_12">
                                <label class="pseudo">
                                    <input type="text" name="libelle" placeholder="Nom du produit:" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid username.</span>
                                </label>
                                <label class="message">
                                    <textarea name="description" placeholder="Description:" data-constraints='@Required @Length(min=20,max=999999)'></textarea>
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*The message is too short.</span>
                                </label>
                                <label class="name">
                                    <input type="text" name="prixD" placeholder="Prix de départ de l'enchère:" value="" data-constraints="@Required @JustNumbers"  />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid name.</span>
                                </label>
                                <label class="name">
                                    <input type="text" name="prixMax" placeholder="Prix max de l'enchère:" value="" data-constraints="@Required @JustNumbers"  />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid name.</span>
                                </label>
                                <label class="dateN">
                                    <input type="text" name="dateF" placeholder="Date de fin de l'enchère: (JJ/MM/AAAA)" value="" data-constraints="@Required"  />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid date.</span>
                                </label>
                            </div>

                        </form>
                        <div class="ta__right">
                            <button href="#" class="link-1 white" type="submit" form="contact-form" data-type="submit">Send</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </article>
                <?php
                include('elements/footer.php');
                break;
        }
    }
}
