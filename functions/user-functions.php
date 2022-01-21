<?php
function getUserByMail($bdd, $email)
{

    $query = $bdd->prepare('SELECT * FROM `news-site`.users WHERE email = :email');
    $query->execute(["email" => $email]);
    return $query->fetchAll();
}

;

function getUserById($bdd, $id)
{

    $query = $bdd->prepare('SELECT * FROM `news-site`.users WHERE id = :id');
    $query->execute(["id" => $id]);
    $user = $query->fetch();

    return $user;
}

function checkAuthentification()
{
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
    }
}

;

?>