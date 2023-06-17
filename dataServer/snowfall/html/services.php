<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/admin.css">
		<title>Servicios contratados</title>
	</head>
	<body style="color:whitesmoke; padding: 1rem;">
	<h3 style="text-align:center">P E D I D O S</h3><br/><hr/>
<?php
	require_once("../bndphp/connector.php");

	$dbConnection = new databaseConnection;

	$dbConnection->openConnection("localhost", "admin", "1234", "snowfall");

	if(!isset($_COOKIE['logAs'])) {
		echo "You must login before starting";
	}

	$logAs = $_COOKIE['logAs'];

	$query = "SELECT orderId, email, firstName, secondName, planRequested, sitename FROM orders WHERE userLogged = '$logAs'";

	$result = $dbConnection->query($query);

	while ($registry = $result->fetch(PDO::FETCH_OBJ)) {
		echo "<br/><br/>";
		echo "ID: " . $registry->orderId . "<br/>";
		echo "Nombre: " . $registry->firstName . "<br/>";
		echo "Apellido: " . $registry->secondName . "<br/>";
		echo "Plan: " . $registry->planRequested . "<br/>";
		echo "Nombre del sitio: " . $registry->sitename . "<br/>";
		echo "<br/><br/>";
		echo "<hr/>";
	}
?>
	</body>
</html>
