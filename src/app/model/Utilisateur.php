<?php

namespace app\model;

use app\model\SPDO;


class Utilisateur
{

    function inscritUtilisateur($nom, $prenom, $dateNaiss, $tel, $adresse, $ville, $pays, $pseudo, $mdp) {
        $hash = hash("postgre123", $mdp);
        $spdo = SPDO::getInstance();

    }

    function getUtilisateur($pseudo) {
        $spdo = SPDO::getInstance();
        $req = $spdo->query('select * from utilisateurs where pseudo_utilisateur = :pseudo');
        $req->execute(array("pseudo" => $pseudo));
        return $req->fetch(); //pour récupéré le premier
    }
}