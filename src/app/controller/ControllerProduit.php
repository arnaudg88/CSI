<?php

namespace app\controller;


use app\model\Produits;
use app\view\VueProduit;

class ControllerProduit
{

    function afficheProduit($id) {
        $p = Produits::getProduit($id);
        $v = new VueProduit();

        $v->render(0, $p);
    }

    function afficheAddProduit() {
        $v = new VueProduit();
        $v->render(1);
    }

    function afficheMesProduits() {
        $p = Produits::getMesProduits();
        $v = new VueProduit();
        $v->render(2, $p);
    }

    function getMesProduits() {
        $produits = Produits::getMesProduits($_POST['etat'], $_POST['motCle']);

        $v = new VueProduit();
        foreach ($produits as $p) {
            echo $v->divProduit($p);
        }
    }

    function ajoutProduit() {
        $p = new Produits(0, $_SESSION['util']->id, $_POST['description'], $_POST['libelle'], '', $_POST['dateF'], $_POST['prixD'], $_POST['prixMax'], 0, 'en cours');
        $p->mot = explode('#', $_POST['motCle']);
        return $p->ajout();
    }
}