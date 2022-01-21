<?php
require 'functions/bddConnexion.php';
require 'functions/article-functions.php';
require "functions/user-functions.php";
session_start();
$bdd = bddConnexion();
$response = $bdd->query('SELECT * FROM `news-site`.articles');
$results = $response->fetchAll();

?>

<html>
<head>
    <?php
    include 'scripts/stylesheet.php';
    session_start();
    ?>
</head>

<body>
<div class="container">
    <h1> Nouille Info, la carbonara des sites d'infos ! </h1>

    <?php


    ?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Type</th>
            <th scope="col">Image</th>
            <th scope="col">Aperçu du contenu</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($results as $result) {

            switch ($result["type"]) {
                case ($result["type"] == 'Politique'):
                    echo('color: red');
                    break;
                case ($result["type"] == 'Faits-Divers') :
                    echo('color: blue');
                    break;
                case ($result["type"] == 'Autres'):
                    echo('color: green');
                    break;

                default:
                    echo('color: black');
            };

            echo ' <tr>
                <th scope="row">' . $result["id"] . '</th>
                <td>' . $result["title"] . '</td>
                <td>' . $result["type"] . '</td>
                <td><img src="' . $result["picture"] . '" alt=""></td>
                <td>' . substr($result['content'], 0, 20) . '</td>
                 <td>
                 <a href="article-details.php?id=' . $result["id"] . '" title="Voir"><i class="fas fa-eye"></i> </a>
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

