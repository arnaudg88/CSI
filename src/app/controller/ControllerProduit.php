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
}