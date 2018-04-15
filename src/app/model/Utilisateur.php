<?php

namespace app\model;

require_once 'SPDO.php';


class Utilisateur
{

    public $id, $nom, $prenom, $dateNais, $tel, $adresse, $ville, $pays, $pseudo, $mdp, $soldeDisp, $soldeCompte;

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
    public function __construct($id, $nom, $prenom, $dateNais, $tel, $adresse, $ville, $pays, $pseudo, $mdp, $soldeDisp, $soldeCompte)
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
        $this->mdp = $mdp;
    }

    static function fetchToUtilisateur($donne) {
        return new Utilisateur($donne['id_utilisateur'], $donne['nom_utilisateur'], $donne['prénom_utilisateur'], $donne['datenaissance_utilisateur'], $donne['numtel_utilisateur'], $donne['adresse_utilisateur'], $donne['ville_utilisateur'], $donne['pays_utilisateur'], $donne['pseudo_utilisateur'], $donne['mdp_utilisateur'], $donne['solde_disponible_utilisateur'], $donne['solde_compte_utilisateur']);
    }

    function inscritUtilisateur($nom, $prenom, $dateNaiss, $tel, $adresse, $ville, $pays, $pseudo, $mdp) {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $spdo = SPDO::getInstance();

    }

    function inscription() {
        $hash = password_hash($this->mdp, PASSWORD_DEFAULT);
        $this->mdp = $hash;
        $spdo = SPDO::getInstance();
        $req = $spdo->query('INSERT INTO utilisateurs(
	id_utilisateur, nom_utilisateur, "prénom_utilisateur", datenaissance_utilisateur, numtel_utilisateur, adresse_utilisateur, ville_utilisateur, pays_utilisateur, pseudo_utilisateur, mdp_utilisateur, solde_disponible_utilisateur, solde_compte_utilisateur)
	VALUES (DEFAULT , :nom, :prenom, :date, :tel, :adresse, :ville, :pays, :pseudo, :mdp, 0.00, 0.00);');
        if($req->execute(array(
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'date' => $this->dateNais,
            'tel' => $this->tel,
            'adresse' => $this->adresse,
            'ville' => $this->ville,
            'pays' => $this->pays,
            'pseudo' => $this->pseudo,
            'mdp' => $this->mdp
        ))) {
            return true;
        }else {
            echo $req->errorInfo()[2];
            return false;
        }
    }

    static function getUtilisateur($pseudo) {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('select * from utilisateurs where pseudo_utilisateur = :pseudo');
        $req->execute(array("pseudo" => $pseudo));
        if($donne = $req->fetch())
            return Utilisateur::fetchToUtilisateur($donne); //pour récupéré le premier
        else
            return null;
    }
}