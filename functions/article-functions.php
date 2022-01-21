<?php
function getArticleById($bdd, $id)
{
    $query = $bdd->prepare("SELECT * FROM `news-site`.articles WHERE id = :id");
    $query->execute(["id" => $id]);
    $article = $query->fetch();

    return $article;
}

;

function removeArticleById($bdd, $id)
{
    $query = $bdd->prepare("DELETE FROM  `news-site`.articles WHERE id = :id");
    $query->execute(["id" => $id]);
    header("Location: admin.php");
}

;

function validateArticleForm()
{
    $errors = [];
    if (empty($_POST["title"])) {
        $errors[] = "Ajoutez un titre svp !";
    };

    if (empty($_POST["type"])) {
        $errors[] = "Ajoutez un type d'article svp !";
    };

    if (empty($_POST["picture"])) {
        $errors[] = "Ajoute une image !";
    };

    if (empty($_POST["content"])) {
        $errors[] = "Ajoutez du contenu dans votre article !";
    };
    return $errors;
}

;

?>;