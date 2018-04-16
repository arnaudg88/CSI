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
    static function getProduitsEncheres($motCle = null) {
        $spdo = SPDO::getInstance();
        $sql = 'select * from produits left join decrit on produits.id_produit = decrit.id_produit left join motsclés on decrit.id_mot = motsclés.id_mot where etat_produit = :etatProd';
        $param = array("etatProd" => 'en cours');

        if(isset($motCle) && $motCle != '') {
            $w = explode(' ', $motCle);
            if(!empty($w)) {
                $sql .= ' and (';
            }
            foreach ($w as $k=>$mot) {
                if($k == 0)
                    $sql .= ' libellé_mot = :mot'.$k.' ';
                else
                    $sql .= ' OR libellé_mot = :mot'.$k.' ';

                $param['mot'.$k] = $mot;
            }
            if(!empty($w)) {
                $sql .= ' );';
            }
        }

        $req = $spdo->query($sql);
        $req->execute($param);
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

    static function getMesProduits($etat=null, $motCle=null) {
        $spdo = SPDO::getInstance();
        $sql = 'select * from produits left join decrit on produits.id_produit = decrit.id_produit left join motsclés on decrit.id_mot = motsclés.id_mot where idutilisateur_produit = :idUtil';
        $param = array('idUtil' => $_SESSION['util']->id);
        if(isset($etat) && $etat != '') {
            $sql .= ' and etat_produit like :etat';
            $param['etat'] = '%'.$etat.'%';
        }

        if(isset($motCle) && $motCle != '') {
            $w = explode(' ', $motCle);
            if(!empty($w)) {
                $sql .= ' and (';
            }
            foreach ($w as $k=>$mot) {
                if($k == 0)
                    $sql .= ' libellé_mot = :mot'.$k.' ';
                else
                    $sql .= ' OR libellé_mot = :mot'.$k.' ';

                $param['mot'.$k] = $mot;
            }
            if(!empty($w)) {
                $sql .= ' );';
            }
        }
        $req = $spdo->query($sql);
        $req->execute($param);
        $res = array();
        while($donne = $req->fetch()) {
            $res[] = Produits::fetchToProd($donne);
        }
        return $res;
    }

    function ajout() {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('INSERT INTO produits(
	id_produit, idutilisateur_produit, description_produit, libelle_produit, etat_produit, datemisevente_produit, prixdepartenchere_produit, prixfinenchere_produit, encheremax_produit, datefinenchere_produit)
	VALUES (DEFAULT, :idUtil, :desc, :lib, :etat, CURRENT_DATE, :prixD, :prixF, 0.00, :dateF);');
        if($req->execute(array(
            'idUtil' => $_SESSION['util']->id,
            'desc' => $this->description,
            'lib' => $this->libelle,
            'etat' => 'en cours',
            'prixD' => $this->prixDep,
            'prixF' => $this->prixFin,
            'dateF' => $this->dateFE
        ))) {
            $id = $spdo->getPDOInstance()->lastInsertId();
            foreach ($this->mot as $mot) {
                $mot = trim($mot);
                if($mot != '')
                    MotsCles::addMotsCle($id, $mot);
            }
            return true;
        }else {
            echo $req->errorInfo()[2];
            $s = Slim::getInstance();
            echo '<a href="'.$s->urlFor('addProduit').'">Retour</a>';
            return false;
        }
    }
}