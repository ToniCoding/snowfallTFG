<?php
    // Get data from form.
    $senderMail = $_POST['contactMail'];
    $reason = $_POST['reason'];

    // General variables.
    $directory = '/var/www/html/ftpService/support';
    $currentDate = date('Y-m-d');
    $filename = 'supportProblem_' . $currentDate . '_';
    $fileCount = count(glob($directory . '*.txt')) + 1;
    $filePath = $directory . $filename . $fileCount . '.txt';
    $content = $reason;

    // Escritura.
    file_put_contents($filePath, $content);
    echo "<script>window.alert('Se ha recogido tu problema de manera exitosa. ¡Gracias, serás atendido pronto!');</script>";
?>
