<?php

namespace app\controller;


use app\model\Encheres;
use app\model\Produits;
use app\view\VueListeEnchere;

class ControllerEnchere
{

    function afficheListeEnchere() {
        $prod = Produits::getProduitsEncheres();

        $v = new VueListeEnchere();
        $v->render(0, $prod);
    }

    function afficheJusteEnchere() {
        $ench = Produits::getProduitsEncheres($_POST['motCle']);

        $v = new VueListeEnchere();
        foreach ($ench as $e) {
            echo $v->divProduit($e);
        }
    }

    function faireEnchere($id, $montant) {
        Encheres::faireEnchere($id, $montant);
    }

    function finEnchere($id) {
        Encheres::finEnchere($id);
    }
}