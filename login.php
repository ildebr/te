<?php
    include "basedatos.php";
    session_start();
    $error = "";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $correo = $_POST['correo'];
        $clave = hash('sha1',$_POST['clave']);
        // $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);
        // se busca el usuario cuyas credenciales coincida con las ingresadas de no existir se retorna error
        // $query = "SELECT id, nombre, correo, apellido, rol FROM usuario WHERE cedula='$correo' && contrasena = '$clave'";
        $query = "SELECT id, nombre, correo, apellido, rol, contrasena FROM usuario WHERE cedula='$correo' AND contrasena= '$clave'";
        $res = mysqli_query($dbconexion, $query) or trigger_error("failed".mysqli_error($dbconexion), E_USER_ERROR);
        if (mysqli_num_rows($res) > 0){
            
            while($usuario = mysqli_fetch_assoc($res)){
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['apellido'] = $usuario['apellido'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['permisos'] = $usuario['rol'];
                ?><script>location.replace("index.php")</script> <?php
                
            }
            
        }else{
            $error ="Los valores ingresados no corresponden a un usuario registrado". password_hash($_POST["clave"], PASSWORD_DEFAULT);
        }
 
    }
    
?>

<?php
    if($error!=""){
        echo $error;
    }

    if(isset($_SESSION['nombre'])){
        echo $_SESSION['nombre'];
    }
?>

<main class="login">
    <h2>INICIA SESIÓN</h2>
<form method="POST">
    <input type="text" name="correo" placeholder="CORREO">
    <input type="password" name="clave" placeholder="CONTRASEÑA">
    <input type="submit" class="btn">
</form>
    <p>¿No tienes una cuenta? <a href="signup.php">Registrate</a></p>
</main>