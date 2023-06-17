<?php
    // Require connector to database.
    require_once('./connector.php');

    // Instances the class so it can use its methods.
    $dbConnection = new databaseConnection;

    // Opens connection to database.
    $dbConnection->openConnection("localhost", "admin", "1234", "snowfall");

    // Get data from the form.
    $userLogged = "admin0";
    $bugReason = $_POST['bugReason'];
    $bugPrio = $_POST['bugPrio'];
    $bugDpt = $_POST['bugDpt'];

    // Insert the bug into the database so it's registered.
    $sql = "INSERT INTO bugs (bugReason, bugPrio, bugDpt) VALUES ('$bugReason', '$bugPrio', '$bugDpt')";
    $stmt = $dbConnection->prepare($sql);
    $result = $stmt->execute();

    // Redirect to main page and confirmation.
    header('Location: https://www.snowfall.net/html/confirm.html');
    die();

    echo "Incidencia sobre fallo creada. Si es preciso, se contactará con usted.";
?>
