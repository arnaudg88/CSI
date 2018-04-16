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

    function faireEnchere($id, $montant) {
        Encheres::faireEnchere($id, $montant);
    }
}