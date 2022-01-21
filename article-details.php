<?php
require 'functions/bddConnexion.php';
require 'functions/article-functions.php';
require "functions/user-functions.php";
session_start();
$bdd = bddConnexion();
$idArticle = $_GET["id"];
$article = getArticleById($bdd, $idArticle);
$idUser = $_GET["id"];
$user = getUserById($bdd, $idUser);

if (is_null($article)) {
    // Je renverrais une page 404 !
}

?>
<html>
<head>
    <?php
    include 'scripts/stylesheet.php'
    ?>
</head>

<body>
<div class="container d-flex justify-content-center">
    <div class="card" style="width: 36rem;">
        <img src="<?php echo($article["picture"]); ?>" alt="">
        <div class="card-body">
            <h5 class="card-title"><?php echo($article["title"]) ?></h5>
            <p class="card-text"><?php echo($article["content"]) ?></br> Rédigé par : <?php echo($user["first_name"] . $user["name"]);?></p>

        </div>
    </div>
</div>
<?php
include 'scripts/bootstrap.php';
?>
</body>

</html>
