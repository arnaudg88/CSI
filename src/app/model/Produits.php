<?php

namespace app\model;

require 'SPDO.php';

class Produits
{

    public $id, $idUtil, $description, $libelle, $dateMV, $dateFE, $prixDep, $prixFin, $enchereMax, $etat;
    public $lienImg, $mot;

    /**
     * Produits constructor.
     * @param $id
     * @param $description
     * @param $libelle
     * @param $dateMV
     * @param $dateFE
     * @param $prixDep
     * @param $prixFin
     * @param $enchereMax
     * @param $etat
     */
    public function __construct($id, $idUtil, $description, $libelle, $dateMV, $dateFE, $prixDep, $prixFin, $enchereMax, $etat)
    {
        $this->id = $id;
        $this->idUtil = $idUtil;
        $this->description = $description;
        $this->libelle = $libelle;
        $this->dateMV = $dateMV;
        $this->dateFE = $dateFE;
        $this->prixDep = $prixDep;
        $this->prixFin = $prixFin;
        $this->enchereMax = $enchereMax;
        $this->etat = $etat;
        $this->lienImg = 'produit_'.$id.'.jpg';
        $this->mot = MotsCles::getMotsCles($id);
    }

    static function fetchToProd($donne) {
        return new Produits($donne['id_produit'], $donne['idutilisateur_produit'], $donne['description_produit'], $donne['libelle_produit'], $donne['datemisevente_produit'], $donne['datefinenchere_produit'], $donne['prixdepartenchere_produit'], $donne['prixfinenchere_produit'], $donne['encheremax_produit'], $donne['etat_produit']);
    }

    /**
     * liste produit en enchere
     * @return array de Produits
     */
    static function getProduitsEncheres() {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('select * from produits where etat_produit = :etatProd');
        $req->execute(array("etatProd" => 'en cours'));
        $res = array();
        while($donne = $req->fetch()) {
            $res[] = Produits::fetchToProd($donne);
        }
        return $res;
    }
}