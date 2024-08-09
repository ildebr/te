<?php
    include "basedatos.php";
    session_start();
    $error = "";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $cedula = $_POST['cedula'];
        $clave = hash('sha1',$_POST['clave']);
        // $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);
        // se busca el usuario cuyas credenciales coincida con las ingresadas de no existir se retorna error
        // $query = "SELECT id, nombre, correo, apellido, rol FROM usuario WHERE cedula='$correo' && contrasena = '$clave'";
        $query = "SELECT id, nombre, correo, apellido, rol, contrasena FROM usuario WHERE cedula='$cedula' AND contrasena= '$clave'";
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
            $error ="Los valores ingresados no corresponden a un usuario registrado";
        }
 
    }
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion - SIPEC</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      h2{
        text-align: center;
        margin-top: 1rem;
      }
      .error{
        color:red;
      }
    </style>
    <!-- jQuery -->
    <script src="vistas/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Validacion -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
</head>
<body>
<main class="login">
    
<!-- <form method="POST">
    <input type="text" name="correo" placeholder="CORREO">
    <input type="password" name="clave" placeholder="CONTRASEÑA">
    <input type="submit" class="btn">
</form> -->

</main>

<section class="vh-90">
<h2>INICIA SESIÓN - SIPEC</h2>
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="vistas/assets/imagenes/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-6">
        <form id="login-form"  method="POST">
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text"  name="cedula" id="form3Example3" class="form-control form-control-lg"
              placeholder="Ingresa una cedula valida" />
            <label class="form-label" for="form3Example3">Cedula</label>
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
          
          <p class="error">
          <?php
    if($error!=""){
        echo $error;
    }
?>
          </p>

        </form>
      </div>
    </div>
  </div>
</section>

<script>
  $('#login-form').validate({
    rules:{
      cedula: {
        required: true,
        digits: true
      },
      clave: {
        required: true
      }
    },
    messages: {
      cedula:{
        required: "Este campo es obligatorio",
        digits: "Solo cedulas validas"
      },
      clave:{
        required: "Este campo es obligatorio"
      }
    }
  })
</script>
    
</body>
</html>


