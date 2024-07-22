<?php
ob_start();
    $nombre = 'ali';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Value To PDF</title>
</head>
<body>
    <h1>
        Hello <?php echo $nombre; ?> <?= $nombre ?>
    </h1>

    <p>al</p>
</body>
</html>