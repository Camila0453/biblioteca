
<nav  class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Biblio Uni</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menú</h5>
       
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
       
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
          <?php  if($_SESSION["perfil"] == 1){ echo '<a class="nav-link active" aria-current="page" href="../usuario/indexAdmin">Inicio</a>';}?>
       <?php  if($_SESSION["perfil"] == 2){ echo '<a class="nav-link active" aria-current="page" href="../usuario/indexOp">Inicio</a>';}?>
       <?php  if($_SESSION["perfil"] == 5){ echo '<a class="nav-link active" aria-current="page" href="../usuario/indexSocio">Inicio</a>';}?>
       <?php  if($_SESSION["perfil"] == 5){ echo '<a class="nav-link active" aria-current="page" href="../usuario/misPrestamos">Mis prestamos</a>';}?>
       <?php  if($_SESSION["perfil"] == 5){ echo '<a class="nav-link active" aria-current="page" href="../usuario/misReservas">Mis reservas</a>';}?>
          </li>
          <li class="nav-item">
          <?php  if($_SESSION["perfil"] == 1){ echo '<a href="../usuario/showPerfilAdmin">Mi perfil</a>';}?>
       <?php  if($_SESSION["perfil"] == 2){ echo '<a href="../usuario/showPerfilOp">Mi perfil </a>';}?>
       <?php  if($_SESSION["perfil"] == 5){ echo '<a href="../usuario/showPerfilSo">Mi perfil </a>';}?>
          
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../usuario/logout">Cerrar Sesión</a>
          </li>
        </ul>
      
      </div>
    </div>
  </div>
</nav>