<?php

namespace app\controller;

use app\view\View;

class Controller
{

    function afficheAccueil() {
        $v = new View();
        $v->render(0);
    }
}