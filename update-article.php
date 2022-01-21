<?php
require "functions/user-functions.php";
require 'functions/bddConnexion.php';
require 'functions/article-functions.php';
session_start();
checkAuthentification();

$bdd = bddConnexion();
$idArticle = $_GET["id"];

$article = getArticleById($bdd, $idArticle);


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $errors = validateArticleForm();

    if (count($errors) == 0) {
        try {

            $query = $bdd->prepare("UPDATE `news-site`.articles 
            SET title = :title, type = :type, picture = :picture, content =:content WHERE id = :id");

            $query->execute([
                'title' => $_POST["title"],
                'type' => $_POST["type"],
                "picture" => $_POST["picture"],
                "content" => $_POST["content"],
                "id" => $idArticle
            ]);

            header("Location: admin.php");
        } catch (\PDOException $e) {
            throw $e;
            die();
        }

    }
}


?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <?php
    include 'scripts/stylesheet.php'
    ?>
</head>

<body>
<div class="container">

    <h1>Mettre à jour l' article <?php echo($article["title"]); ?> !</h1>

    <form action="update-article.php?id=<?php echo($_GET["id"]); ?>" method="post">
        <form>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input id="title" type="text" name="title"
                           value="<?php echo($article["title"]); ?>"
                           placeholder="Saisissez votre titre" class="form-control-plaintext">
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input id="type" type="text" name="type"
                           value="<?php echo($article["type"]); ?>"
                           placeholder="Saisissez votre type" class="form-control-plaintext">
                </div>
            </div>

            <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input id="picture" type="text" name="picture"
                           value="<?php echo($article["picture"]); ?>"
                           placeholder="Changez le lien de l'image" class="form-control-plaintext">
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-sm-2 col-form-label">Contenu</label>
                <div class="col-sm-10">
                    <input id="content" type="text" name="content"
                           value="<?php echo($article["content"]); ?>"
                           placeholder="Saisissez votre contenu" class="form-control-plaintext">
                </div>
            </div>


            <input type="submit" class="btn btn-success">
        </form>
    </form>


</div>
<?php
include 'scripts/bootstrap.php';
?>
</body>

</html>
