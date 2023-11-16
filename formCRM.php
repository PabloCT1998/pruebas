<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");;

include('includes/conexion.php');
include('includes/funciones.php');
session_start();
$parametros = seleccionarParametrosCRM($_SESSION['usuario']['UsuarioID']);

foreach($parametros as $parametro){
	foreach($parametro as $p){
		if($p == 'CRM Activo'){
			 $crm = $parametro['ValorParametroCRM'];
		}
		if($p == 'Pipedrive Activo'){
			 $pipedriveActivo = $parametro['ValorParametroCRM'];
		}

		if($p == 'Hubspot Activo'){
			$hubspotActivo = $parametro['ValorParametroCRM'];
		}

		if($p == 'Token Pipedrive'){
			$tokenPipedrive = $parametro['ValorParametroCRM'];
	  	}

	  if($p == 'Dominio Pipedrive'){
		  $dominioPipedrive = $parametro['ValorParametroCRM'];
  		}
		
		if($p == 'Token Hubspot'){
			$tokenHubspo = $parametro['ValorParametroCRM'];
		}
	}
}

if(!$crm){
    header('location: resumenFinanciero.php');
}
$dinero = $_SESSION['precioVenta'];

if($pipedriveActivo == 1 && $hubspotActivo== 0 ) {
	if(isset($_SESSION['datosCRM'])){
		$titulo = $_SESSION['datosCRM']['titulo'];
		$nombre = (isset ($_SESSION['datosCRM']['nombre'])) ? $_SESSION['datosCRM']['nombre'] :'';
		$telefono = (isset($_SESSION['datosCRM']['telefono']))? $_SESSION['datosCRM']['telefono']: '';
		$correo = (isset($_SESSION['datosCRM']['correoElectronico']))? $_SESSION['datosCRM']['correoElectronico'] :'';
		$dinero = $_SESSION['datosCRM']['dinero'];
		$nota = (isset($_SESSION['datosCRM']['nota']))?$_SESSION['datosCRM']['nota'] : '';
	}else{
		$titulo = '';
		$nombre = $_SESSION['input1']['nomUsuario'];
		$telefono = '';
		$correo = ''; 
		$nota = '';
	}
}else if($pipedriveActivo == 0 && $hubspotActivo== 1 ){
	if(isset($_SESSION['datosCRM'])){
		
		if(!isset($_SESSION['datosCRM']['checkContactoExistente'])){
			$nombre = (isset($_SESSION['datosCRM']['nombre'])) ? $_SESSION['datosCRM']['nombre'] :'';
			$apellido = (isset($_SESSION['datosCRM']['apellido'])) ? $_SESSION['datosCRM']['apellido'] : '';
			$telefono = (isset($_SESSION['datosCRM']['telefono'])) ? $_SESSION['datosCRM']['telefono']: '';
			$correo = (isset($_SESSION['datosCRM']['correoElectronico'])) ? $_SESSION['datosCRM']['correoElectronico']: '';
		}else{
			$nombre = $_SESSION['input1']['nomUsuario'];
			$apellido = $_SESSION['input1']['apellidoUsuario'];
			$telefono = '';
			$correo = '';
		}
		$titulo = $_SESSION['datosCRM']['titulo'];
	
		$dinero = $_SESSION['datosCRM']['dinero'];
	}else{
		$titulo = '';
		$nombre = $_SESSION['input1']['nomUsuario'];
		$apellido = $_SESSION['input1']['apellidoUsuario'];
		$telefono = '';
		$correo = '';
	}
}
?>
<!DOCTYPE html>
<html lang="es-MX">
	<?php require_once 'includes/header.php';?>
	<body>
		<?php require_once 'includes/nav.php';?>
		<div class="container">
            <?php require_once 'includes/tituloCotizar.php';?>
            <h3 class="text-center  text-muted">ENVIAR AL CRM</h3>
            <br>
            <br>

            <?php if($pipedriveActivo ==1 && $hubspotActivo == 0){
				require_once 'includes/formPipedrive.php';
			}else if($pipedriveActivo == 0 && $hubspotActivo == 1){
				require_once 'includes/formHubstop.php';
			}?>
            <br>
            <a class=" btn btn-success mb-3 no-imprimir" href="resumenFinanciero.php">
                <?php require_once 'includes/botonRegresar.php';?>
            </a>
		</div>
	</body>
	<?php require_once 'includes/footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="assets/js/formCRM.js" defer></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>
