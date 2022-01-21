<?php
function getUserByMail($bdd, $email)
{

    $query = $bdd->prepare('SELECT * FROM `news-site`.users WHERE email = :email');
    $query->execute(["email" => $email]);
    return $query->fetchAll();
}

function checkAuthentification()
{
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
    }
}

?>