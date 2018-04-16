<?php

namespace app\view;

use Slim\Slim;

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

                                <?php
                                if($produit->idUtil == $_SESSION['util']->id) {
                                    if($produit->etat == 'en cours') {
                                        $s = Slim::getInstance();
                                        echo '
                                        <form action="' . $s->urlFor('finEncherePOST') . '" method="post">
                                            <input type="hidden" name="idProd" value="' . $produit->id . '">
                                            <button class="link-1 black" id="finEnch">Mettre fin enchère</button>
                                        </form>';
                                    } else {
                                        echo '<h3>Vendu</h3>';
                                    }
                                }else {
                                ?>
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
                                    <?php } ?>
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
                                <label class="pseudo">
                                    <input type="text" name="motCle" placeholder="Mots clés: (un # entre chaque motclé)" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid username.</span>
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

            case 2:
                include('elements/header.php'); ?>
                <section id="content">
                    <div class="container_3">
                        <h3>Options</h3>
                        <input class="inputSpe" type="text" id="etatProd" placeholder="Etat du produit:">
                        <input class="inputSpe" type="text" id="motCle" placeholder="Mots clés:">
                    </div>
                    <div class="container_12" id="produits">
                        <?php
                        foreach ($produit as $v) {
                            echo $this->divProduit($v);
                        }

                        ?>
                        <div class="clear"></div>
                    </div>
                </section>

            <script>
                $('#etatProd, #motCle').on('input', function () {
                    $.ajax({
                        url:'/projetcsi/mesProduits',
                        type:'post',
                        data: {
                            'etat': $('#etatProd').val(),
                            'motCle': $('#motCle').val()
                        },
                        success:function(data){
                            $('#produits').html(data+'<div class="clear"></div>');
                        },
                        error: function (e) {
                            console.log(e.responseText);
                        }
                    });
                });
            </script>
                <?php include('elements/footer.php');
                break;
        }
    }

    function divProduit($p) {
        $s = Slim::getInstance();
        $res = '<div class="grid_12">
            <div class="extra_wrapper">
                <img src="'.dirname($_SERVER['SCRIPT_NAME']).'/images/'.$p->lienImg.'" alt="" class="img_inner fleft"/>
                <div class="text1 tx__2"><a href="'.$s->urlFor('produit', array('id' => $p->id)).'">'.$p->libelle.'</a> ('.$p->etat.')</div>
                    <p> '.$p->description.' </p>
                    <p>';

        foreach ($p->mot as $k=>$m) {
            if($k == 0)
                $res .= '#'.$m;
            else
                $res .= ', #'.$m;
        }

        $res .='</p>
                    <a href="'.$s->urlFor('produit', array('id' => $p->id)).'" class="link-1">Mettre fin enchère</a>
            </div>
        </div>';
        return $res;
    }
}
