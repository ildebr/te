function accesso($permisos){
    echo $_SESSION["permisos"];
    if(isset($_SESSION["permisos"])){
        if($permisos == 'usuario' ){
            if( !($_SESSION["permisos"] == 'usuario' || $_SESSION["permisos"] == 'administrador')){
                ?><script>location.replace("denegado.php")</script> <?php
            }
        }else if($permisos == 'administrador'){
            if( !($_SESSION["permisos"] == 'administrador')){
                ?><script>location.replace("denegado.php")</script> <?php
            }
            
        }
    }else{
        ?><script>location.replace("denegado.php")</script> <?php
    }
}

// function accesso($permisos){
//     if(isset($_SESSION["permisos"]) && !$_SESSION["permisos"][$permisos]){
//         ?><script>location.replace("denegado.php")</script> <?php
//         die;
//     }
// }

// $_SESSION["permisos"]["ADMIN"] = isset($_SESSION["permisos"]) && $_SESSION["permisos"] == "administrador";
// $_SESSION["permisos"]["USER"] = isset($_SESSION["permisos"]) && ($_SESSION["permisos"] == "usuario" || $_SESSION["permisos"] == "administrador");
