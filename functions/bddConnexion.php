<?php
function bddConnexion()
{
    try {
        $bdd = new PDO('mysql:dbname=news-site;host=127.0.0.1', "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (\Exception $e) {
        echo('Connexion impossible, veuillez vérifier vos identifiants.');
        throw $e;
    }
}

?>