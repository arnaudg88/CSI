<?php

namespace app\model;

require_once 'SPDO.php';
use Slim\Slim;

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

    static function getProduit($id) {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('select * from produits where id_produit = :id');
        $req->execute(array("id" => $id));
        if ($donne = $req->fetch())
            return Produits::fetchToProd($donne); //pour récupéré le premier
        else
            return null;
    }

    function ajout() {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('INSERT INTO produits(
	id_produit, idutilisateur_produit, description_produit, libelle_produit, etat_produit, datemisevente_produit, prixdepartenchere_produit, prixfinenchere_produit, encheremax_produit, datefinenchere_produit)
	VALUES (DEFAULT, :idUtil, :desc, :lib, :etat, CURRENT_DATE, :prixD, :prixF, 0, :dateF);');
        if($req->execute(array(
            'idUtil' => $_SESSION['util']->id,
            'desc' => $this->description,
            'lib' => $this->libelle,
            'etat' => 'en cours',
            'prixD' => $this->prixDep,
            'prixF' => $this->prixFin,
            'dateF' => $this->dateFE
        ))) {
            return true;
        }else {
            echo $req->errorInfo()[2];
            $s = Slim::getInstance();
            echo '<a href="'.$s->urlFor('addProduit').'">Retour</a>';
            return false;
        }
    }
}