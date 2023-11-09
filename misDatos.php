<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");;

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
		<div class="container">
			<br>
			<h1 class="fw-normal text-center " style="color:#003a70";><b>Mis Datos</b>
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                </svg>
			</h1>
			<br>
			<br>
			<?php if(isset($_SESSION['exito'])){?>
				<div class="row">
					<div class="col-auto alert alert-success" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
							<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
							<path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
						</svg>
							<?php echo $_SESSION['exito']; ?>
					</div>
				</div>
			<?php unset($_SESSION['exito']); } ?>
			<form action="actualizarMisDatos.php" method="POST">
				<div class="row">
					<div class="col-xxl-4  col-6">
						<label for="nombreCompleto">NOMBRE COMPLETO</label>
					</div>
					<div class="col-xxl-3   col-6">
						<label for="usuario">NOMBRE DE USUARIO</label>
					</div>
				</div> 
				<div class="row">
					<div class="col-xxl-4  col-6">
						<input type="text" name="nombreCompleto" id="nombreCompleto" class="form-control" value="<?php echo $_SESSION['usuario']['NombreCompleto']  ?>">
                        <?php echo (isset($_SESSION['erroresMisDatos']['nombre'])) ? '<label class="text-danger">' . $_SESSION['erroresMisDatos']['nombre'] . '</label>' : ''; ?>
					</div>
					<div class="col-xxl-3   col-6">
						<input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $_SESSION['usuario']['Usuario'] ?>">
                         <?php echo (isset($_SESSION['erroresMisDatos']['usuario'])) ? '<label class="text-danger">' . $_SESSION['erroresMisDatos']['usuario'] . '</label>' : ''; ?>                    
					</div>
				</div>
				<br>
				<div class="row">					
					<div class="col-3">
						<label for="email">CORREO ELECTRÓNICO</label>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<input type="email" name="email" id="email" value="<?php echo $_SESSION['usuario']['CorreoUsuario'] ?>" class="form-control" required>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xxl-3 col-6">
						<label for="passwordViejo">CONTRASEÑA ACTUAL</label>
					</div>
					<div class="col-xxl-3 col-6">
						<label for="passwordNuevo">NUEVA CONTRASEÑA</label>
					</div>
				</div>
				<div class="row">
					<div class="col-xxl-3 col-6">
						<input type="password"step="any" name="passwordViejo"  id="passwordViejo" class="form-control " oninput="validatePasswordInputs()">
                        <?php echo (isset($_SESSION['erroresMisDatos']['password'])) ? '<label class="text-danger">' . $_SESSION['erroresMisDatos']['password'] . '</label>' : ''; ?>    
					</div>	
					<div class="col-xxl-3 col-6">
						<input type="password" step="any" name="passwordNuevo" id="passwordNuevo"  class="form-control" oninput="validatePasswordInputs()">
					</div>					
				</div>
				<br>
				<?php if(isset($_SESSION['erroresMisDatos']))unset($_SESSION['erroresMisDatos']); ?>
                <div class="col-xxl-12  col-12">
                    <div class="row">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3"  >
                                ACTUALIZAR
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
				    <div class="col-xxl-6  col-6">
                        <a href="index.php" class=" btn btn-success mb-3">
                            <?php require_once 'includes/botonRegresarMenu.php';?>
                        </a>
	    			</div>
		    	</div>	
			</div>
		  </form>
		</div>
	</body>
	<br>
	<br>
	<br>
	<br>
		<br>
	<br>
	<?php require_once 'includes/footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/validarPassword.js" defer></script>
</html>
