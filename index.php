<?php
require_once "vendor/autoload.php";

use app\controller\Controller;
use app\controller\ControllerEnchere;
use app\controller\ControllerConnexion;
use app\controller\ControllerProduit;

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

$app->post('/encheres', function () {
    $c = new ControllerEnchere();
    $c->afficheJusteEnchere();
})->setName('encheresPOST');

$app->get('/produit/:id', function ($id) {
    $c = new ControllerProduit();
    $c->afficheProduit($id);
})->setName('produit');

$app->post('/produit/:id', function ($id) use ($app) {
    if(isset($_SESSION['util'])) {
        $c = new ControllerEnchere();
        $c->faireEnchere($id, $_POST['montant']);
    } else {
        $app->redirect($app->urlFor('connexion'));
    }

})->setName('encherir');

$app->get('/addProduit', function () {
    $c = new ControllerProduit();
    $c->afficheAddProduit();
})->setName('addProduit');

$app->post('/addProduit', function () use ($app) {
    $c = new ControllerProduit();
    /*if(*/$c->ajoutProduit();//)
        //$app->redirect($app->urlFor('home'));
})->setName('addProduitPOST');


$app->get('/mesProduits', function () {
    $c = new ControllerProduit();
    $c->afficheMesProduits();
})->setName('mesProduits');

$app->post('/mesProduits', function () {
    $c = new ControllerProduit();
    $c->getMesProduits();
})->setName('mesProduitsPOST');

$app->post('/finEnchere', function () use ($app) {
    $c = new ControllerEnchere();
    $id = $_POST['idProd'];
    $c->finEnchere($id);
    $app->redirect($app->urlFor('produit', array('id' => $id)));
})->setName('finEncherePOST');



if(isset($_SESSION['util'])) {
    $app->get('/profil', function () {
        $c = new ControllerConnexion();
        $c->afficheProfil();
    })->setName('profil');

    $app->post('/profil', function () use ($app) {
        $c = new ControllerConnexion();
        $c->ajouterSoldeDispo($_POST['montant']);
        $app->redirect($app->urlFor('home'));
    })->setName('profilPOST');
}





//compte

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



