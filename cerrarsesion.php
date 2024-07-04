<?php
    session_start();
    //para cerrar sesion se vacian todas las variables de sesión inicializadas
    
    if(isset($_SESSION['nombre'])){
        unset($_SESSION['nombre']);
    }
    if(isset($_SESSION['myid'])){
        unset($_SESSION['myid']);
    } 
    if(isset($_SESSION['PERMISOS'])){
        unset($_SESSION['PERMISOS']);
    }
    if(isset($_SESSION['PERMISOS']["ADMIN"])){
        unset($_SESSION['PERMISOS']["ADMIN"]);
    } 
    if(isset($_SESSION['PERMISOS']["USER"])){
        unset($_SESSION['PERMISOS']["USER"]);
    }
    if(isset($_SESSION["PERMISOS"]["ADMIN"])){
        unset($_SESSION["PERMISOS"]["ADMIN"]);
    }
    if(isset($_SESSION['id'])){
        unset($_SESSION['id']);
    } 
    if(isset($_SESSION['permisos'])){
        unset($_SESSION['permisos']);
    } 
    if(isset($_SESSION['tarjeta'])){
        unset($_SESSION['tarjeta']);
    } 

    header("Location: index.php");
?>