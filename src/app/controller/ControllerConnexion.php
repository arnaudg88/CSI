<?php

namespace app\controller;


use app\model\Utilisateur;
use app\view\VueConnexion;

class ControllerConnexion
{

    function connexionUtil($pseudo, $mdp) {
        $u = Utilisateur::getUtilisateur($pseudo);
        if(!is_null($u) && password_verify($mdp, $u->mdp)) {
            $_SESSION['util'] = $u;
        }
    }

    function afficheInscription() {
        $v = new VueConnexion();
        $v->render(0);
    }

    function afficheConnexion() {
        $v = new VueConnexion();
        $v->render(1);
    }

    function afficheProfil() {
        $v = new VueConnexion();
        $v->render(2);
    }

    function ajouterSoldeDispo($montant) {
        $pseudo = $_SESSION['util']->pseudo;
        $u = Utilisateur::getUtilisateur($pseudo);
        $u->ajouterSolde($montant);
        $_SESSION['util'] = Utilisateur::getUtilisateur($pseudo);
    }

    function inscription() {
        if($_POST['mdp'] == $_POST['mdpconfirm']) {
            $u = new Utilisateur(null, $_POST['nom'], $_POST['prenom'], $_POST['dateN'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['pays'], $_POST['pseudo'], $_POST['mdp'], 0.00, 0.00);
            return $u->inscription();
        } else {
            return false;
        }
    }

    function connexion() {
        $u = Utilisateur::getUtilisateur($_POST['pseudo']);
        $s = \Slim\Slim::getInstance();
        if(isset($u)) {
            if (password_verify($_POST['mdp'], $u->mdp)) {
                $_SESSION['util'] = $u;
                return true;
            } else {
                echo '<h1>Mauvais mot de passe</h1>
                <a href="'.$s->urlFor('connexion').'">Retour</a>';
                return false;
            }
        }else {
            echo '<h1>Nom de compte existe pas</h1>
                <a href="'.$s->urlFor('connexion').'">Retour</a>';
        }
    }

    function deconnexion() {
        unset($_SESSION['util']);
    }
}