<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POC PHP PDO</title>
</head>
<body>
<?php
    // Include database once to reuse the same connexion later
    include_once("./db/database.php");

    include_once("./layout/header.php");


    // Homemade router
    if (empty($_GET) || $_GET["url"] === "home") {
        include_once ("./pages/home.php");
    } else if ($_GET["url"] === "about") {
        // http://localhost:8085/?url=about
        include_once ("./pages/about.php");
    }

    include_once("./layout/footer.php");
?>
</body>
</html>
