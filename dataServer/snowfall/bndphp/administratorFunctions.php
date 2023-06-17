<?php
    // Requires connector.
    require_once("./connector.php");

    // This input is always present to identify the form.
    $formName = $_POST['formType'];

    // Instances the class so it can use its methods.
    $dbConnection = new databaseConnection;

    // Opens connection to database.
    $dbConnection->openConnection("localhost", "admin", "1234", "snowfall");

    // Function that checks if there's a registry already created. If finds registry returns true if not, false.
    function checkIfExist($dbConnection, $tableCheck, $columnCheck, $valueCheck) {
        if(($stmt = $dbConnection->query("SELECT COUNT($columnCheck) FROM $tableCheck WHERE $columnCheck='$valueCheck';")->fetchColumn()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Function to create a new user.
    function newUser($dbConnection, $username, $password, $email) {
	$password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(email, uname, password) VALUES('$email', '$username', '$password');";
        $dbConnection->exec($query);
        echo "<script>window.alert('Usuario creado de manera exitosa.')</script>";
    }

    // Function to delete a user.
    function delUser($dbConnection, $username) {
        $query = "DELETE FROM users WHERE uname='$username';";
        $dbConnection->exec($query);
        echo "<script>window.alert('Usuario eliminado de manera exitosa.')</script>";
    }

    // Function to modify a users property.
    function modUser($dbConnection, $username, $changeProperty, $newValue) {
        $query = "UPDATE users SET $changeProperty='$newValue' WHERE uname='$username'";
        if($changeProperty == "password") {
		$password = password_hash($newValue, PASSWORD_DEFAULT);
	}
	$dbConnection->exec($query);
        echo "<script>window.alert('La propiedad $changeProperty de $username ha sido cambiada de manera exitosa.')</script>";
    }

    // Function to unsubscribe from a plan.
    function unsubPlan($dbConnection, $orderId) {
        $query = "UPDATE orders SET active=0 WHERE orderId=$orderId";
        $dbConnection->exec($query);
        echo "<script>window.alert('El plan con ID $orderId se ha dado de baja.')</script>";
    }

    // Function to re-subscribe to a plan.
    function resubPlan($dbConnection, $orderId) {
        $query = "UPDATE orders SET active=1 WHERE orderId=$orderId";
        $dbConnection->exec($query);
        echo "<script>window.alert('El plan con ID $orderId vuelve a estar activo.')</script>";
    }

    // Avoids error on undefined variables.
    switch ($formName) {
        case 'createUser':
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            newUser($dbConnection, $username, $password, $email);
            break;

        case 'modifyUser':
            $username = $_POST['username'];
            $newValue = $_POST['newValue'];
            $changeProperty = $_POST['property'];
            modUser($dbConnection, $username, $changeProperty, $newValue);
            break;

        case 'deleteUser':
            $username = $_POST['username'];
            delUser($dbConnection, $username);
            break;

        case 'unsubPlan':
            $username = $_POST['username'];
            $orderId = $_POST['orderId'];
            unsubPlan($dbConnection, $orderId);
            break;

        case 'subPlan':
            $username = $_POST['username'];
            $orderId = $_POST['orderId'];
            resubPlan($dbConnection, $orderId);
            break;

        case 'checkRun':
            $tableCheck = $_POST['tableCheck'];
            $columnCheck = $_POST['columnCheck'];
            $valueCheck = $_POST['valueCheck'];
            if(checkIfExist($dbConnection, $tableCheck, $columnCheck, $valueCheck)) {
                echo "El registro existe en la base de datos seleccionada";
            } else {
                echo "El registro no existe en la base de datos seleccionada.";
            }

        default:
            $formName = null;
            break;
    }
?>
