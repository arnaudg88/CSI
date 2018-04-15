<?php

namespace app\model;

require 'SPDO.php';

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
}