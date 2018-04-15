<?php
require_once "vendor/autoload.php";

use app\controller\Controller;
use app\controller\ControllerEnchere;
use app\controller\ControllerConnexion;

session_start();

$app = new \Slim\Slim();

/* permet de faire des actions en fonciton de l'url
    exemple ici pour url / on veut afficher la page d'accueil

    j'ai mis ->get() car on récupère utilise le GET sinon c'est ->post() pour le POST*/
$app->get('/', function()  {
    $c = new Controller();
    $c->afficheAccueil();
})->setName('home'); /*un nom si on veut récupéré l'url pour un boutton par exemple avec la fonction pathFrom($nom) */

$app->get('/encheres', function () {
    $c = new ControllerEnchere();
    $c->afficheListeEnchere();
})->setName('encheres');

$app->get('/inscription', function () {
    $c = new ControllerConnexion();
    $c->afficheInscription();
})->setName('inscription');

$app->post('/inscription', function () use ($app) {
    $c = new ControllerConnexion();
    if($c->inscription())
        $app->redirect($app->urlFor('connexion'));

})->setName('inscriptionPOST');

$app->get('/connexion', function () {
    $c = new ControllerConnexion();
    $c->afficheConnexion();
})->setName('connexion');

$app->post('/connexion', function () use ($app) {
    $c = new ControllerConnexion();
    if($c->connexion())
        $app->redirect($app->urlFor('home'));

})->setName('connexionPOST');

$app->get('/deconnexion', function () use ($app) {
    $c = new ControllerConnexion();
    $c->deconnexion();
    $app->redirect($app->urlFor('home'));
})->setName('deconnexion');

$app->run();



