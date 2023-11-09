<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: *");

  include('includes/conexion.php');
  include('includes/funciones.php');
  session_start();
	if (!definido($_SESSION['usuario'])) {
		header('location: LoginUser.php');
	}
?>
<!DOCTYPE html>
<html lang="es">
	<?php require_once 'includes/header.php';?>
  <body>
    <?php require_once 'includes/nav.php';?>
    <div  class="text-center my-5"></div>
	<div class="container h-100">
		<div class="row justify-content-sm-center">
			<div class="col-sm-4 mb-3 mb-sm-4">
          		<section class="h-100">
            		<div class="card shadow-lg">
						<div class="card-body p-4">
							<div class="row">
								<div class="col-auto">
									<a class="link-dark text-decoration-none" href="consumo_1.php"><h1 class="fs-4 card-title fw-bold mb-4">COTIZAR <br>PROYECTO</h1></a>
								</div>
								<div class="col-auto">
									<a href="consumo_1.php">
										<div class="justify-content-sm-center ">
											<button type="submit" class="btn btn-success ms-auto btn-circle.btn-xl btn-circle" name="accion" value="C">
												<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
  													<path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
													<path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
												</svg>
                        					</button>
                      					</div>
                    				</a>
                  				</div>
						    </div>
					    </div>
            		</div>
          		</section>
			</div>
			<div class="col-sm-4 mb-3 mb-sm-4">
          		<section class="h-100">
            		<div class="card shadow-lg">
						<div class="card-body p-4">
                			<div class="row">
                  				<div class="col-auto">
                    				<h1 class="fs-4 card-title fw-bold mb-4"><a class="link-dark text-decoration-none" href="catalogoProductos.php">CATÁLOGO <br>PRODUCTOS</a></h1>
                  				</div>
                  				<div class="col-auto">
				  					<a class="link-dark text-decoration-none" href="catalogoProductos.php">
                      					<div class="justify-content-sm-center ">
                        					<button type="submit" class="btn btn-primary ms-auto btn-circle.btn-xl btn-circle"  name="accion" value="V">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
												<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
												<path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
											</svg>
                        					</button>
                      					</div>
									</a>
                  				</div>
						    </div>
					    </div>
            		</div>
          		</section>
			</div>
			<div class="col-sm-4 mb-3 mb-sm-4">
          		<section class="h-100">
            		<div class="card shadow-lg">
						<div class="card-body p-4">
                			<div class="row">
                  				<div class="col-auto">
                    				<h1 class="fs-4 card-title fw-bold mb-4"><a class="link-dark text-decoration-none" href="catalogoAlmacen.php">ALMACENES</a></h1>
                  				</div>
                  				<div class="col-auto">
				  					<a class="link-dark text-decoration-none" href="catalogoAlmacen.php">
                      					<div class="justify-content-sm-center ">
                        					<button type="submit" class="btn btn-info ms-auto btn-circle.btn-xl btn-circle"  name="accion" value="V">
												<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
  													<path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 4.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
												</svg>
                        					</button>
                      					</div>
									</a>
                  				</div>
						    </div>
					    </div>
            		</div>
          		</section>
			</div>
		</div>
		<div class="row justify-content-sm-center">
			<div class="col-sm-4 mb-3 mb-sm-4">
          		<section class="h-100">
            		<div class="card shadow-lg">
						<div class="card-body p-4">
							<div class="row">
								<div class="col-auto">
									<a class="link-dark text-decoration-none" href="misDatos.php"><h1 class="fs-4 card-title fw-bold mb-4">MIS <br>DATOS</h1></a>
								</div>
								<div class="col-auto">
									<a href="misDatos.php">
										<div class="justify-content-sm-center ">
											<button type="submit" class="btn btn-secondary ms-auto btn-circle.btn-xl btn-circle" name="accion" value="C">
												<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  													<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
												</svg>
                        					</button>
                      					</div>
                    				</a>
                  				</div>
						    </div>
					    </div>
            		</div>
          		</section>
			</div>
			<div class="col-sm-4 mb-3 mb-sm-4">
          		<section class="h-100">
            		<div class="card shadow-lg">
						<div class="card-body p-4">
                			<div class="row">
                  				<div class="col-auto">
                    				<h1 class="fs-4 card-title fw-bold mb-4"><a class="link-dark text-decoration-none" href="parametros.php">PARÁMETROS</a></h1>
                  				</div>
                  				<div class="col-auto">
				  					<a class="link-dark text-decoration-none" href="parametros.php">
                      					<div class="justify-content-sm-center ">
                        					<button type="submit" class="btn btn-warning ms-auto btn-circle.btn-xl btn-circle"  name="accion" value="V">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
												<path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
  												<path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
											</svg>
                        					</button>
                      					</div>
									</a>
                  				</div>
						    </div>
					    </div>
            		</div>
          		</section>
			</div>			
		</div>
    </div>
  </body>
  <?php require_once 'includes/footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
