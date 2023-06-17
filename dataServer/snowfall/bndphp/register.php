<?php
    // Requires connector to get values from databases.
    require_once("./connector.php");

    // Get data (method POST) from form.
    $fUsername = $_POST["uname"];
    $fPassword = password_hash($_POST["passwd"], PASSWORD_DEFAULT);
    $fEmail = $_POST["email"];

    // Instances the class so it can use its methods.
    $dbConnection = new databaseConnection;

    // Opens connection to database.
    $dbConnection->openConnection("localhost", "admin", "1234", "snowfall");

    // Create user.
    $query = "INSERT INTO users(email, uname, password) VALUES('$fEmail', '$fUsername', '$fPassword');";
    $dbConnection->exec($query);

    header("Location: https://www.snowfall.net/html/login.html");
    die();
?>
