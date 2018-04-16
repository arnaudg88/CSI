<?php

namespace app\model;

require_once 'SPDO.php';

class MotsCles
{

    public $id, $libelle;

    /**
     * MotsCles constructor.
     * @param $id
     * @param $libelle
     */
    public function __construct($id, $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    static function getMotsCles($idProduit) {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('select libellé_mot from motsclés, decrit where decrit.id_produit = :idProd and motsclés.id_mot=decrit.id_mot');
        $req->execute(array("idProd" => $idProduit));
        $res = array();
        while($donne = $req->fetch()) {
            $res[] = $donne['libellé_mot'];
        }
        return $res;
    }

    static function addMotsCle($id, $mot)
    {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('INSERT INTO motsclés(
	id_mot, libellé_mot)
	VALUES (DEFAULT, :mot);');
        if ($req->execute(array(
            'mot' => $mot
        ))) {

            $req = $spdo->query('select * from motsclés where libellé_mot = :mot');
            $req->execute(array('mot' => $mot));
            $idMot = $req->fetch()['id_mot'];

            $req = $spdo->query('INSERT INTO decrit(
	id_mot, id_produit)
	VALUES (:mot, :prod);');
            $req->execute(array(
                'mot' => $idMot,
                'prod' => $id
            ));
        } else {
            echo $req->errorInfo()[2];
        }
    }
}