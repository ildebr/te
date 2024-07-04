<?php

function access($permisos){
    if(isset($_SESSION["PERMISOS"]) && !$_SESSION["PERMISOS"][$permisos]){
        ?><script>location.replace("denegado.php")</script> <?php
        die;
    }
}

$_SESSION["PERMISOS"]["ADMIN"] = isset($_SESSION["permisos"]) && $_SESSION["permisos"] == "administrador";
$_SESSION["PERMISOS"]["USER"] = isset($_SESSION["permisos"]) && ($_SESSION["permisos"] == "usuario" || $_SESSION["permisos"] == "administrador");
