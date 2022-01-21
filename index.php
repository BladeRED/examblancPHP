<?php
require 'functions/bddConnexion.php';
require 'functions/article-functions.php';
require "functions/user-functions.php";

$bdd = bddConnexion();
$idArticles = $_GET["id"];
$articles = getArticlesById($bdd, $idArticles);

?>