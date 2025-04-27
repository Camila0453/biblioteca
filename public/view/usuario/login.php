<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
      
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="view/usuario/css/styles.css" rel="stylesheet" />
        <link href="view/css/general.css" rel="stylesheet" />

        <title>BiblioUni</title>
 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
        <link href="view/css/general.css" rel="stylesheet" />
    <?php
    
       
     //   $pass= "1234";
     //$hash=    password_hash($pass,PASSWORD_DEFAULT) ;
     $_SESSION["claveSecreta"]=2025;
    ?>
    <script defer type="text/javascript" src="view/usuario/js/login.js"></script> 
    </head>
    <body style="background: url('view/usuario/img/fondoLogoUnpa.jpg') no-repeat center center/cover">

        <!-- Masthead-->
        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">
                    <h1 class="fst-italic lh-1 mb-4">BiblioUni</h1>
                    <p class="mb-5">Sistema de gestión en línea de la Biblioteca de la Universidad Nacional de la Patagonia Austral Sede Caleta Olivia!</p>

                    <form id="formLogin" name="formLogin" class="form-label"  method="POST" action="" enctype="multipart/form-data">
                        <label>Iniciar Sesión</label>
                        <br>
                    <div class="form-group">
                       <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
                       <div class="col-sm-6">
                         <input required type="text" maxlength="45" minlength="8" class="form-control form-control-sm" id="datoUsuario" name="datoUsuario" placeholder="">
                       </div>
                       <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Clave</label>
                       <div class="col-sm-6">
                          <input class="form-control form-control-sm" required maxlength="8" minlength="8" type="password" name="datoClave" id="datoClave">
                       </div>
                  </div>
  <button id="btnLogin"  name="btnLogin" onclick="log1()" type="button" class="btn btn-primary my-4"  >Ingresar </button>
  <button id="limp" type="button" class="btn btn-primary my-4" onclick="limpiar(formAlta)" >Limpiar</button>
  </form>
                </div>
            </div>
        </div>
        <div  class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <a class="btn btn-dark m-3" href="https://x.com/UNPA_C_Olivia"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark m-3" href="https://www.facebook.com/people/Unidad-Acad%C3%A9mica-Caleta-Olivia-UNPA/100064834562211/"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark m-3" href="https://www.instagram.com/unpa_uaco/?hl=es-la"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <div id="liveAlertPlaceholder" class="toast-container position-fixed bottom-0 end-0 p-3">
</div>
    </body>
</html>
