<style>
    .sidebarasi{
        display: inline;
    z-index: 1;
    padding-top: 1rem;
    height: 100%;
    padding: 1rem;
    }

    .center{
        text-align: center;
    }

    li:hover{
        background: #1d50b8;
    }

    .navbar-nav a.nav-link{
        font-weight: 700;
    }

    .sidebar{
        width: 100% !important;
    }

    /* .nav-item:hover{
        background
    } */
</style>


<aside id="sidebar p-3" class="sidebarasi">
    <p class="center h4">Bienvenido, 
        <?php
            echo $_SESSION['nombre'];
        ?>
    </p>
<p class='center h6'>
<?php
    echo 'Rol: '. $_SESSION['permisos'];
?>
</p>

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " onclick="CargarContenido('vistas/landing.php','content-wrapper')">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <?php 
      if ($_SESSION['permisos'] == 'administrador'){
        ?>
            <li class="nav-item">
                <a class="nav-link " onclick="CargarContenido('vistas/crearusuario.php','content-wrapper')">
                    <i class="bi bi-grid"></i>
                    <span>Crear Usuario</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " onclick="CargarContenido('vistas/listarUsuarios.php','content-wrapper')">
                    <i class="bi bi-grid"></i>
                    <span>Listar Usuarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " onclick="CargarContenido('vistas/reporte.php','content-wrapper')">
                    <i class="bi bi-grid"></i>
                    <span>Reporte</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cerrarsesion.php">
                    <i class="bi bi-grid"></i>
                    <span>Cerrar sesion</span>
                </a>
            </li>
        <?php
      }else if($_SESSION['permisos'] == 'usuario'){
        ?> 
            <li class="nav-item">
                <a class="nav-link" href="cerrarsesion.php">
                    <i class="bi bi-grid"></i>
                    <span>Cerrar sesion</span>
                </a>
            </li>
        <?php
      }
      ?>

      
    </ul>

  </aside>