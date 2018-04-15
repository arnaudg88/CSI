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
        if(password_verify($_POST['mdp'], $u->mdp)) {
            $_SESSION['util'] = $u;
            return true;
        }else {
            var_dump($u);
            return false;
        }
    }

    function deconnexion() {
        unset($_SESSION['util']);
    }
}