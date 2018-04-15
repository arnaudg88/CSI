<?php
require_once "vendor/autoload.php";

use app\controller\Controller;
use app\controller\ControllerEnchere;

$app = new \Slim\App();

/* permet de faire des actions en fonciton de l'url
    exemple ici pour url / on veut afficher la page d'accueil

    j'ai mis ->get() car on récupère utilise le GET sinon c'est ->post() pour le POST*/
$app->get('/', function($req, $res, $args)  {
    $c = new Controller();
    $c->afficheAccueil();
})->setName('home'); /*un nom si on veut récupéré l'url pour un boutton par exemple avec la fonction pathFrom($nom) */

$app->get('/encheres', function ($req, $res, $args) {
    $c = new ControllerEnchere();
    $c->afficheListeEnchere();
})->setName('listeEnchère');

$app->run();



