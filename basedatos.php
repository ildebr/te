<?php
$nombre= "localhost";
$root= "root";
$contrasena = "";

$nombre_db="systhesis";

$dbconexion = mysqli_connect($nombre, $root, $contrasena, $nombre_db);

if(!$dbconexion){
    echo "Error conectando a la base de datos";
    exit();
}

// $dbconexion=mysqli_init(); 
// mysqli_ssl_set($dbconexion, NULL, NULL, "BaltimoreCyberTrustRoot.crt.pem", NULL, NULL); 
// mysqli_real_connect($dbconexion, "paulashop-azureserver.mysql.database.azure.com", "paula@paulashop-azureserver", "db-password123", "paula_shop", 3306, NULL, MYSQLI_CLIENT_SSL);


// if (mysqli_connect_errno()) {
//     die('Failed to connect to MySQL: '.mysqli_connect_error());
//     }
