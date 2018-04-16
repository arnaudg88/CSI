<?php

namespace app\view;


class VueConnexion
{

    function render($methode) {
        switch ($methode) {
            case 0: include('elements/header.php');
                ?>
                <article class="block-1 contacts ">
                    <div class="container_12">
                        <div class="grid_12">
                            <h3 class="white ta__center">Formulaire d'inscription</h3>
                        </div>
                        <div class="clear"></div>
                        <form id="contact-form" method="post">
                            <div class="contact-form-loader"></div>
                            <div class="grid_12">
                                <label class="pseudo">
                                    <input type="text" name="pseudo" placeholder="Nom utilisateur:" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid username.</span>
                                </label>
                                <label class="mdp">
                                    <input type="password" name="mdp" placeholder="Mot de passe:" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid password.</span>
                                </label>
                                <label class="mdp">
                                    <input type="password" name="mdpconfirm" placeholder="Confirmer mot de passe:" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid password.</span>
                                </label>
                                <br>
                                <label class="name">
                                    <input type="text" name="nom" placeholder="Nom:" value="" data-constraints="@Required @JustLetters"  />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid name.</span>
                                </label>
                                <label class="name">
                                    <input type="text" name="prenom" placeholder="Prenom:" value="" data-constraints="@Required @JustLetters"  />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid name.</span>
                                </label>
                                <label class="dateN">
                                    <input type="text" name="dateN" placeholder="Date de naissance: (JJ/MM/AAAA)" value="" data-constraints="@Required"  />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid date.</span>
                                </label>

                                <label class="tel">
                                    <input type="text" name="tel" placeholder="Numéro de téléphone: " value="" data-constraints="@Required @JustNumbers"  />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid number.</span>
                                </label>

                                <label class="adresse">
                                    <input type="text" name="adresse" placeholder="Adresse:" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid adress.</span>
                                </label>
                                <label class="ville">
                                    <input type="text" name="ville" placeholder="Ville:" value="" data-constraints="@Required @JustLetters" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid city.</span>
                                </label>
                                <label class="pays">
                                    <input type="text" name="pays" placeholder="Pays:" value="" data-constraints="@Required @JustLetters" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid country.</span>
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

            case 1:
                include('elements/header.php');
                ?>
                <article class="block-1 contacts ">
                    <div class="container_12">
                        <div class="grid_12">
                            <h3 class="white ta__center">Formulaire de connexion</h3>
                        </div>
                        <div class="clear"></div>
                        <form id="contact-form" method="post">
                            <div class="contact-form-loader"></div>
                            <div class="grid_12">
                                <label class="pseudo">
                                    <input type="text" name="pseudo" placeholder="Nom utilisateur:" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid pseudo.</span>
                                </label>
                                <label class="mdp">
                                    <input type="password" name="mdp" placeholder="Mot de passe:" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid mot de passe.</span>
                                </label>
                            </div>
                        </form>
                        <div class="ta__right">
                            <button href="#" class="link-1 white" type="submit" form="contact-form" data-type="submit">Send</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </article>
                <div class="clear"></div>
                <?php
                include('elements/footer.php');
                break;


            case 2:
                include('elements/header.php');
                ?>
                <section class="block-1">
                    <div class="container_12">
                        <div class="grid_12">
                            <h3 class="white ta__center">Mon profil</h3>
                        </div>
                        <div class="clear"></div>
                        <form id="contact-form" method="post">
                            <div class="contact-form-loader"></div>
                            <div class="grid_12">
                                <label class="pseudo">
                                    <input type="text" name="montant" placeholder="Ajouter solde dispo:" value="" data-constraints="@Required" />
                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid pseudo.</span>
                                </label>
                            </div>
                        </form>
                        <div class="ta__right">
                            <button href="#" class="link-1 white" type="submit" form="contact-form" data-type="submit">Send</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </section>
                <div class="clear"></div>
                <?php
                include('elements/footer.php');
                break;
        }
    }
}