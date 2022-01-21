<?php
require 'functions/bddConnexion.php';
require 'functions/user-functions.php';
session_start();
$bdd = bddConnexion();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST["email"])) {
        $errors[] = "Veuillez saisir une adresse email.";
    }

    if (empty($_POST["password"])) {
        $errors[] = "Veuillez saisir un mot de passe.";
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Cet email n'est pas valide.";
    }

    if (count($errors) == 0) {
        $user = getUserByMail($bdd, $_POST["email"]);

        if (count($user) == 0) {
            $errors[] = "Inconnu au bataillon.";
        } else {
            if (password_verify($_POST["password"], $user[0]['password'])) {
                // On met user dans la session
                $_SESSION["user"] = $user[0];
                // On redirige notre user
                header("Location: admin.php");
            } else {
                $errors[] = "Mauvais mot de passe !";
            }
        }

    }


}
?>
<html>
<head>
    <?php
    include 'scripts/stylesheet.php';
    ?>
</head>

<body>
<div class="container">

    <h1>Login</h1>


    <form method="post" action="login.php">
        <label for="email">Indiquez votre email</label>
        <input id="email" type="text" name="email" class="form-control">

        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" class="form-control">

        <input type="submit" class="btn-success"><br>


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
