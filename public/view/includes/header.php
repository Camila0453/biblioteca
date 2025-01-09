
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
    <div  style="text-align:left" class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
           <?= $_SESSION["usuario"] ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="usuario/logout">Cerrar sesión</a></li>
            <li><a class="dropdown-item" href="usuario/logout">Gestionar tu cuenta</a></li>
            <li><a class="dropdown-item" href="usuario/logout">Configuración</a></li>
          
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>