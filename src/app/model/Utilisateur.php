<?php

namespace app\model;

require_once 'SPDO.php';


class Utilisateur
{

    public $id, $nom, $prenom, $dateNais, $tel, $adresse, $ville, $pays, $pseudo, $soldeDisp, $soldeCompte;

    /**
     * Utilisateur constructor.
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $dateNais
     * @param $tel
     * @param $adresse
     * @param $ville
     * @param $pays
     * @param $pseudo
     * @param $soldeDisp
     * @param $soldeCompte
     */
    public function __construct($id, $nom, $prenom, $dateNais, $tel, $adresse, $ville, $pays, $pseudo, $soldeDisp, $soldeCompte)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNais = $dateNais;
        $this->tel = $tel;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->pseudo = $pseudo;
        $this->soldeDisp = $soldeDisp;
        $this->soldeCompte = $soldeCompte;
    }

    static function fetchToUtilisateur($donne) {
        return new Utilisateur($donne['id_utilisateur'], $donne['nom_utilisateur'], $donne['prénom_utilisateur'], $donne['datenaissance_utilisateur'], $donne['numtel_utilisateur'], $donne['adresse_utilisateur'], $donne['ville_utilisateur'], $donne['pays_utilisateur'], $donne['pseudo_utilisateur'], $donne['solde_disponible_utilisateur'], $donne['solde_compte_utilisateur']);
    }

    function inscritUtilisateur($nom, $prenom, $dateNaiss, $tel, $adresse, $ville, $pays, $pseudo, $mdp) {
        $hash = hash("postgre123", $mdp);
        $spdo = SPDO::getInstance();

    }

    static function getUtilisateur($pseudo) {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('select * from utilisateurs where pseudo_utilisateur = :pseudo');
        $req->execute(array("pseudo" => $pseudo));
        return Utilisateur::fetchToUtilisateur($req->fetch()); //pour récupéré le premier
    }
}