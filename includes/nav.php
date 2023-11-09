<nav class="navbar no-imprimir navbar-expand-lg navbar-light bg-light site-header sticky-top d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
  <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/img/softtown-logo.png" alt="logo" width="150" height="50"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <?php  if (isset($_SESSION['usuario'])) { ?>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> <!-- Utilizo 'ms-auto' para justificar a la derecha -->
            <li class="nav-item">
                <br>
                <a class="btn btn-secondary ml-2" href="index.php">Menú</a>
            </li>
            
            <li class="nav-item">
                <br>
                <a class="btn bg-primary text-light mx-2" href="salir.php"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.500H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>    
                    Cerrar Sesión
                </a>
            </li>
        </ul>
      </div>
      <?php }?>
  </div>
</nav>    
 