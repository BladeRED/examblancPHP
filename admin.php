<?php
require 'functions/bddConnexion.php';
require 'functions/article-functions.php';
require "functions/user-functions.php";
session_start();
checkAuthentification();
$bdd = bddConnexion();

$response = $bdd->query('SELECT * FROM `news-site`.articles');
$results = $response->fetchAll();


?>

<html>
<head>
    <?php
    include 'scripts/stylesheet.php';
    ?>
</head>

<body>
<div class="container">
    <h1> Bienvenue sur la page d'administration</h1>

    <button type="submit" class="btn btn-outline-success"><a href="add-article.php">AJOUTER</a></button>
    <button type="submit" class="btn btn-outline-danger"><a href="logout.php">DECONNEXION</a></button>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Type</th>
            <th scope="col">Aperçu du contenu</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($results as $result) {

            echo ' <tr>
                <th scope="row">' . $result["id"] . '</th>
                <td>' . $result["title"] . '</td>
                <td>' . $result["type"] . '</td>
                <td>' . substr($result['content'], 0, 20) . '</td>
                 <td>
                 <a href="article-details.php?id=' . $result["id"] . '" title="Voir"><i class="fas fa-eye"></i> </a>
                  <a href="delete-article.php?id=' . $result["id"] . '" title="Supprimer">  <i class="fas fa-trash"></i> </a>
             <a href="update-article.php?id=' . $result["id"] . '" ><i class="fas fa-edit" data-container="body" title="Editer"></i> </a>
                 </td>
            </tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php
include 'scripts/bootstrap.php';
?>
</body>
</html>

