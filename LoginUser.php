<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include('includes/conexion.php');
    include('includes/funciones.php');
    session_start();
    if(llaveDefinida('usuario', $_SESSION)){
	    header('location: index.php');
    }

    if(llaveDefinida('error', $_SESSION)){
        $error = $_SESSION['error'];
    }else{
        $error = '';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="screen" /> 
	<link rel="stylesheet" type="text/css" href="assets/css/loginFondo.css" media="screen" />     
    <link rel="icon" href="assets/img/softtown-logo.png" />
    <title>Solar</title>
  </head>

  <body>
    <?php require_once 'includes/nav.php';?>
    <div  class="text-center my-5"></div>
    <br>
	<main>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Iniciar Sesión</h1>
							<form method="POST" class="needs-validation" action="login.php"  autocomplete="off">
                                <?php echo '<span class="error">'.$error.'</span>'; ?>
								<div class="mb-3">
									<label class="mb-2 text-muted" for="user">Usuario</label>
									<input id="user" type="text" class="form-control" name="user" required="required">
								</div>
								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Contraseña</label>
									</div>
									<input id="password" type="password" class="form-control" name="password" required="required">
								</div>
								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto" >
										Iniciar sesión
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- </section>
	<div class="container">
	<div class="row justify-content-sm-center">
			<img src="assets/img/paneles.jpeg" alt="paneles.jpeg" height="500px" width="500px">
		</div>
		<br>
		<br> -->
	</div>
	</main>
  </body>
  <?php require_once 'includes/footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>