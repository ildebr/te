<?php

function acceso($permisos){
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



