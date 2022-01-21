<?php
require "functions/user-functions.php";
require "functions/bddConnexion.php";
require "functions/article-functions.php";
session_start();
checkAuthentification();

$bdd = bddConnexion();

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $errors = validateArticleForm();

    if (count($errors) == 0) {
        try {
            $query = $bdd->prepare("INSERT INTO `news-site`.articles(title,type,picture, content)
            VALUES (:title, :type, :picture, :content)");

            $query->execute([
                'title' => $_POST["title"],
                'type' => $_POST["type"],
                'picture' => $_POST["picture"],
                'content' => $_POST["content"],

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

    <h1>Ajouter un nouvel article !</h1>

    <form action="add-article.php" method="post">
        <form>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Titre</label>
                <div class="col-sm-10">
                    <input id="title" type="text" name="title" placeholder="Saisissez votre titre"
                           class="form-control-plaintext">
                </div>
            </div>
            <div class="form-group row">
                <label for="type" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input id="type" type="text" name="type" placeholder="Saisissez votre type d'article"
                           class="form-control-plaintext">
                </div>
            </div>
            <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input id="picture" type="text" name="picture" placeholder="Saisissez votre lien d'image"
                           class="form-control-plaintext">
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-sm-2 col-form-label">Contenu</label>
                <div class="col-sm-10">
                    <input id="content" type="text" name="content" placeholder="Saisissez votre contenu"
                           class="form-control-plaintext">
                </div>
            </div>
</div>


<input type="submit" class="btn btn-success">
</form>
</form>

<?php
foreach ($errors as $error) {
    echo('<div class="alert alert-danger" role="alert">
  ' . $error . '
</div>');
}
?>
</div>
<?php
include 'scripts/bootstrap.php';
?>
</body>

</html>
