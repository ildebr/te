<style>
    .sidebar{
        display: inline;
    position: absolute;
    z-index: 1;
    }
</style>


<aside id="sidebar" class="sidebar">
<?php
    echo $_SESSION['permisos'];
?>

    <ul class="sidebar-nav" id="sidebar-nav">

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
                <a class="nav-link " href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Administrador</span>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a onclick="CargarContenido('vistas/<?php echo $subMenu->vista ?>','content-wrapper')">
                        <i class="bi bi-circle"></i><span>Alerts</span>
                        </a>
                    </li>
                </ul>
            </li>
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
        <?php
      }
      ?>

      
    </ul>

  </aside>