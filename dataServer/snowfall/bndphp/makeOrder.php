<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css">
	<title>Confirmación de pedido</title>
</head>
<body style="color:whitesmoke; font-size:1.2rem; margin-left: 1.5rem; margin-top: 1.5rem;">
<?php
    // Require connector to db.
    require_once("./connector.php");

    // Get data from form.
    $userLogged = $_COOKIE['logAs'];
    $firstName = $_POST['firstName'];
    $secondName = $_POST['secondName'];
    $email = $_POST['email'];
    $cardNumber = $_POST['cardNumber'];
    $selectedPlan = $_POST['planSelected'];
    $siteName = $_POST['site'];
    $currentDate = date("Y-m-d");
    $randId = rand(1000, 25000);

    // Open new connection to database.
    $dbConnection = new databaseConnection;

    // Opens connection to database.
    $dbConnection->openConnection("localhost", "admin", "1234", "snowfall");

    if(isset($firstName, $secondName, $cardNumber, $selectedPlan, $randId)) {

        // Check if random id is already present in table so it can be avoided.
        $stmt = $dbConnection->query("SELECT COUNT(orderId) FROM orders WHERE orderId=$randId;")->fetchColumn();

        if($stmt > 0) {
            $numbTries = 0;
            while($stmt = $dbConnection->query("SELECT COUNT(orderId) FROM orders WHERE orderId=$randId;")->fetchColumn() > 0) {
                $randId = rand(1000, 25000);
                $numbTries++;

                // If it's been checked over a hundred times that ID exists, it'll throw an error and break the loop. Avoiding infinte loops.
                if($numbTries > 100) {
                    echo "Internal error.<br/>Cod.: 0001<br/>Contact admin@snowfall.net.";
                    break;
                }
            }

            $stmt = $dbConnection->prepare("INSERT INTO orders(orderId, email, firstName, secondName, planRequested, creationDate, active, userlogged, siteName) VALUES($randId, '$email', '$firstName', '$secondName', '$selectedPlan', '$currentDate', 1, '$userLogged', '$siteName');");
            $stmt->execute();

            echo 'La orden se ha creado de forma exitosa. Será visible desde tu panel de <a href="https://www.snowfall.net/html/services.php">servicios</a>';

        } else {
            // Procedural query to. ID is generated randomly for security reasons
            $stmt = $dbConnection->prepare("INSERT INTO orders(orderId, email, firstName, secondName, planRequested, creationDate, active, userlogged, siteName) VALUES($randId, '$email', '$firstName', '$secondName', '$selectedPlan', '$currentDate', 1, '$userLogged', '$siteName');");
            $stmt->execute();

            echo 'La orden se ha creado de forma exitosa. Será visible desde tu panel de <a href="https://www.snowfall.net/html/services.php" style="color:blueviolet;">servicios</a>.<br/>Estará disponible dentro de dos o tres minutos.';

            echo "<br/><br/>Detalles del servicio contratado:<br/><br/><table style='width:25%;'>
            <tbody>
            <tr>
            <td>ID</td>
            <td>$randId</td>
            </tr>
            <tr>
            <td>Nombre</td>
            <td>$firstName</td>
            </tr>
            <tr>
            <td>Apellido</td>
            <td>$secondName</td>
            </tr>
            <tr>
            <td>Plan</td>
            <td>$selectedPlan</td>
            </tr>
            <tr>
            <td>Fecha de creación</td>
            <td>$currentDate</td>
            </tr>
            <tr>
            <td>Usuario que ha ejecutado</td>
            <td>$userLogged</td>
            </tr>
	    <tr>
	    <td>Nombre del sitio</td>
	    <td>$siteName</td>
	    </tr>
            </tbody>
            </table>";

	    // Creates or overwrites the content in a file so it can be treated.
	    file_put_contents("/home/administrator/tmp/name", $siteName);
        }
    } else {
        echo "An internal error ocurred.";
    }
?>
</body>
</html>
