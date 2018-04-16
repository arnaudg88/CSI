<?php

namespace app\model;

use Slim\Slim;

require_once 'SPDO.php';

class Encheres
{

    /*function getListeEncheres() {

    }*/

    static function faireEnchere($id, $montant) {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('INSERT INTO encheres(
	id_enchere, idproduit_enchere, idutilisateur_enchere, date_enchere, montant_enchere)
	VALUES (DEFAULT, :idProd, :idUtil, current_date, :montant);');
        if($req->execute(array(
            'idProd' => $id,
            'idUtil' => $_SESSION['util']->id,
            'montant' => $montant
        ))) {
            return true;
        }else {
            echo $req->errorInfo()[2];
            $s = Slim::getInstance();
            echo '<a href="'.$s->urlFor('produit', array('id' => $id)).'">Retour</a>';
            return false;
        }
    }

    static function finEnchere($id) {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('UPDATE public.produits
	SET etat_produit=:etat, datefinenchere_produit=current_date
	WHERE id_produit = :id;');
        if($req->execute(array(
            'etat' => 'vendu',
            'id' => $id
        ))) {
            return true;
        }else {
            echo $req->errorInfo()[2];
            $s = Slim::getInstance();
            echo '<a href="'.$s->urlFor('produit', array('id' => $id)).'">Retour</a>';
            return false;
        }
    }
}