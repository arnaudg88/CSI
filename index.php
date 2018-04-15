<?php
require_once "vendor/autoload.php";

use app\controller\Controller;
use app\controller\ControllerEnchere;
use app\controller\ControllerConnexion;

session_start();

$app = new \Slim\App();

/* permet de faire des actions en fonciton de l'url
    exemple ici pour url / on veut afficher la page d'accueil

    j'ai mis ->get() car on récupère utilise le GET sinon c'est ->post() pour le POST*/
$app->get('/', function($req, $res, $args)  {
    $_SESSION['lien'] = $this->router;
    $c = new Controller();
    $c->afficheAccueil();
})->setName('home'); /*un nom si on veut récupéré l'url pour un boutton par exemple avec la fonction pathFrom($nom) */

$app->get('/encheres', function ($req, $res, $args) {
    $c = new ControllerEnchere();
    $c->afficheListeEnchere();
})->setName('listeEnchère');

$app->get('/inscription', function ($req, $res, $args) {
    $c = new ControllerConnexion();
    $c->afficheInscription();
})->setName('inscription');

$app->post('/inscription', function ($req, $res, $args) {
    $c = new ControllerConnexion();
    if($c->inscription())
        return $res->withRedirect($this->router->pathFor('connexion'));

})->setName('inscriptionPOST');

$app->get('/connexion', function ($req, $res, $args) {
    $c = new ControllerConnexion();
    $c->afficheConnexion();
})->setName('connexion');

$app->post('/connexion', function ($req, $res, $args) {
    $c = new ControllerConnexion();
    if($c->connexion())
        return $res->withRedirect($this->router->pathFor('accueil'));

})->setName('inscriptionPOST');

$app->run();



