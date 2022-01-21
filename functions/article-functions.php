<?php
function getArticleById($bdd, $id)
{
    $query = $bdd->prepare("SELECT * FROM `news-site`.articles WHERE id = :id");
    $query->execute(["id" => $id]);
    $article = $query->fetch();

    return $article;
}

function removeArticleById($bdd, $id)
{
    $query = $bdd->prepare("DELETE FROM  `news-site`.articles WHERE id = :id");
    $query->execute(["id" => $id]);
    header("Location: index.php");
}

?>;