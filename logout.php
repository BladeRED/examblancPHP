<?php
require "functions/user-functions.php";
checkAuthentification();

session_destroy();
header("Location: login.php");
?>;