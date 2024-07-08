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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="login">
    <h2>INICIA SESIÓN</h2>
<!-- <form method="POST">
    <input type="text" name="correo" placeholder="CORREO">
    <input type="password" name="clave" placeholder="CONTRASEÑA">
    <input type="submit" class="btn">
</form> -->
    <p>¿No tienes una cuenta? <a href="signup.php">Registrate</a></p>
</main>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="vistas/assets/imagenes/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form  method="POST">
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text"  name="correo" id="form3Example3" class="form-control form-control-lg"
              placeholder="Ingresa un correo valido" />
            <label class="form-label" for="form3Example3">Correo</label>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input type="password"  name="clave" id="form3Example4" class="form-control form-control-lg"
              placeholder="Ingresa una contraseña" />
            <label class="form-label" for="form3Example4">Contraseña</label>
          </div>



          <div class="text-center text-lg-start mt-4 pt-2">
          <input type="submit" class="btn btn-primary btn-lg"
          style="padding-left: 2.5rem; padding-right: 2.5rem;" value='Ingresar'>
          </div>
          

        </form>
      </div>
    </div>
  </div>
</section>
    
</body>
</html>


