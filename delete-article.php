<?php
require 'functions/bddConnexion.php';
require 'functions/article-functions.php';
require "functions/user-functions.php";
session_start();
checkAuthentification();

$bdd = bddConnexion();
$idToDelete = $_GET["id"];

$article = getArticleById($bdd, $idToDelete);

if (is_null($article)) {
    // renvoyer une page 404 le produit n'existe pas
} else {
    removeArticleById($bdd, $idToDelete);

}

