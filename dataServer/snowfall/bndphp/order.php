<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
<title>Solicitar pedido</title>
</head>
<style>
form label {
	padding: 1rem;
}

form {
	margin-top: 10%;
	font-size: 1.2rem;
}
</style>
<body>

    <?php
        // To notify user as who's logged in. As well as giving the option to log off the account (stored with a cookie).
        echo "Logueado como: " . $_COOKIE["logAs"] . ".<a href='https://www.snowfall.net/bndphp/logoff.php'>Log off</a> - <a href='https://www.snowfall.net/html/services.php'>Ver servicios</a>";
    ?>

    <form action="../bndphp/makeOrder.php" method="post" style="text-align: center;">
        <!-- Input for "First Name" -->
        <br/><label for="firstName">First name</label>
        <input type="text" name="firstName" required/><br/>
        
        <!-- Input for "Second Name" -->
        <br/><label for="secondName">Second name</label>
        <input type="text" name="secondName" required/><br/>
        
        <!-- Input for email -->
        <br><label for="email">Email</label>
        <input type="email" name="email" placeholder="example@domain.com"><br>

        <!-- Input for "Card Number" -->
        <br/><label for="cardNumber">Card number</label>
        <input type="text" name="cardNumber" required/><br/>
        
        <!-- Input for "Card Security Code" -->
        <br/><label for="cvv">CVV</label>
        <input type="text" name="cvv" required/><br/>

	 <!-- Input for "site" -->
        <br/><label for="site">Nombre del sitio</label>
        <input type="text" name="site" required/><br/>

        <!-- Selection for "Plan Selected" -->
        <br/><label for="cvv">Selección de plan:</label>
        <select name="planSelected">
            <option value="none" selected hidden></option>
            <option value="Mini">MINI - 4€/mes</option>
            <option value="Medium">MEDIUM - 10€/mes</option>
            <option value="Super">SUPER - 30€/mes</option>
            <option value="Ultra">ULTRA - 75€/mes</option>
        </select>

        <!-- Form buttons -->
        <br/><br/><button type="submit">Enviar</button>
        <button type="reset">Limpiar datos</button>
    </form>
</body>
</html>
