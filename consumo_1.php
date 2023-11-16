<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");;

include('includes/conexion.php');
include('includes/funciones.php');
session_start();
if (!definido($_SESSION['usuario'])) {
	header('location: LoginUser.php');
}
$parametros = seleccionarParametrosCRM($_SESSION['usuario']['UsuarioID']); 
$estados = seleccionarEstados();
$tarifas = seleccionarTarifas();
$disable ='';
$meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
$_SESSION['validarConsumo1'] = true; 
if(!llaveDefinida('etapa', $_SESSION)){
	$_SESSION['etapa'] = 0;
}

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

if($_SESSION['etapa'] > 0 && count( $_SESSION['input1']) > 0){
        $numServivicio = $_SESSION['input1']['numServicio'];
        $nomUsuario = $_SESSION['input1']['nomUsuario'];
		$apellidoUsuario = ($crm ==1  && $hubspotActivo == 1) ? $_SESSION['input1']['apellidoUsuario'] : '';
        $cp = $_SESSION['input1']['cp'];
        $ultimoPrecio = $_SESSION['input1']['ultimoPrecio'];
        $ultimoConsumoKwh = $_SESSION['input1']['ultimoConsumoKwh'];
        //$pais = 'selected';
        $estado =  $_SESSION['input1']['estado'];
        $ciudad =  $_SESSION['input1']['ciudad'];
        //$region =  $_SESSION['input1']['region'];
        $tarifa =  $_SESSION['input1']['tarifa'];
		$ciudades = seleccionarCiudadesPorEstado($estado);
		$mesesConsumo = [$_SESSION['consumo']['mes1'], $_SESSION['consumo']['mes2'], $_SESSION['consumo']['mes3'], $_SESSION['consumo']['mes4'], $_SESSION['consumo']['mes5'],$_SESSION['consumo']['mes6'], $_SESSION['consumo']['mes7'], $_SESSION['consumo']['mes8'], $_SESSION['consumo']['mes9'], $_SESSION['consumo']['mes10'], $_SESSION['consumo']['mes11'], $_SESSION['consumo']['mes12']];
		if($_SESSION['input1']['tarifa'] == 1 || $_SESSION['input1']['tarifa'] == 2 ){
			$semestre = 'disabled';

		}else{
			$semestre = '';
		}
}else{
    $numServivicio = '';
    $nomUsuario = '';
	$apellidoUsuario = '';
    $cp = '';
    $ultimoPrecio = '';
    $ultimoConsumoKwh = '';
    $mesesConsumo = ['','','','','','','','','','','',''];
    //$pais = '';
    $estado = '';
    $ciudad =  '';
    //$region =  '';
    $tarifa =  '';
	$_SESSION['numPiezas'] = '';
	$_SESSION['panel'] = '';
	$mesesConsumo = ['','','','','','','','','','','',''];

	$semestre = '';
}
?>
<!DOCTYPE html>
<html lang="es">
	<?php require_once 'includes/header.php';?>
	<body>
		<?php require_once 'includes/nav.php';?>
		<div class="container">
			<br>
			<?php require_once 'includes/tituloCotizar.php';?>
			<h3 class="text-center text-muted">DATOS DE CONSUMO</h3>
			<br>
			<a href="nuevo.php"class="btn btn-primary mb-3" >
				Nuevo
			</a>
			<br>
			<br>
			<form action="consumo_2.php" method="POST">
				<div class="row">
					<div class="col-xxl-4  col-6">
						<label for="numServicio">NÚMERO DE SERVICIO</label>
					</div>
					<div class="col-xxl-3   col-6">
						<label for="nomUsuario">NOMBRE</label>
					</div>
					<?php if($crm == 1 && $hubspotActivo ==1){?>
					<div class="col-xxl-3   col-6">
						<label for="nomUsuario">APELLIDO</label>
					</div>
					<?php }?>
				</div> 
		
				<div class="row">
					<div class="col-xxl-4  col-6">
						<input type="text" name="numServicio" id="numServicio" class="form-control" value="<?php echo $numServivicio ?>">
					</div>
					<div class="col-xxl-3   col-6">
						<input type="text" name="nomUsuario" id="nomUsuario" class="form-control" value="<?php echo $nomUsuario ?>">
					</div>
					<?php if($crm == 1 && $hubspotActivo ==1){?>
						<div class="col-xxl-3   col-6">
							<input type="text" name="apellidoUsuario" id="apellidoUsuario" class="form-control" value="<?php echo $apellidoUsuario ?>">
						</div>
					<?php }?>
				</div>
				<br>
				<div class="row">					
					<div class="col-4">
						<label for="estado">ESTADO</label>
					</div>
					<div class="col-4">
						<label for="ciudad">CIUDAD</label>
					</div>
					<div class="col-3">
						<label for="cp">CÓDIGO POSTAL</label>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						<select class="form-select" aria-label="Default select example" id="estado" name="estado" required="required">
							<option value="">ESTADO</option>
							<?php 
                                foreach($estados as $e){
                                    if($e['EstadoID'] == $estado){
                                        
                            ?>
                                     <option value="<?php echo $e['EstadoID']?>" selected> <?php echo $e['DescEstado'];?></option>
                            <?php   }else{?>
                                        <option value="<?php echo $e['EstadoID']?>"> <?php echo $e['DescEstado'];?></option>
                            <?php   }
                                } 
                            ?>
						</select>
					</div>
					<div class="col-4">
						<select class="form-select" aria-label="Default select example" name="ciudad" id="ciudad" required="required" <?php echo ($ciudad == "") ? 'disabled' : ''?> >
							<?php 
								if($ciudad != ""){
									foreach($ciudades as $c){
										if($c['CiudadID'] == $ciudad){
									
							?>
							 	<option value="<?php echo $c['CiudadID']?>" selected> <?php echo $c['DescCiudad'];?></option>
							<?php 
									}else{
							?>
							<option value="<?php echo $c['CiudadID']?>"> <?php echo $c['DescCiudad'];?></option>
							<?php }}}?>
						</select>
					</div>
					<div class="col-3">
						<input type="text" name="cp" id="cp" value="<?php echo $cp?>" class="form-control" required>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-auto">
						<label for="tarifa">TARIFA</label>
					</div>
				</div>
				<div class="row">
					<?php 
                        foreach($tarifas as $t){
                            if($tarifa == $t['TarifaID']){
                    ?>
                                <div class="col-auto form-check">
                                    <input checked class="form-check-input" type="radio" id="tarifa_<?php echo $t['TarifaID'] ?>" name="tarifa" value="<?php echo $t['TarifaID'] ;?>" required="required">
                                    <label class="form-check-label" for="radio" ><?php echo $t['NombreTarifa']; ?></label>
                                </div>
					<?php   }else{?>
                                <div class="col-auto form-check">
                                    <input class="form-check-input" type="radio"id="tarifa_<?php echo $t['TarifaID'] ?>" name="tarifa" value="<?php echo $t['TarifaID'] ;?>" required="required" >
                                    <label class="form-check-label" for="radio" ><?php echo $t['NombreTarifa']; ?></label>
                                </div>
                    <?php 
                            }
                        }
                    ?>
				</div>
				<br>
				<div class="row">
					<div class="col-xxl-3 col-6">
						<label for="ultimoPrecio">IMPORTE ULTIMO RECIBO</label>
					</div>
					<div class="col-xxl-3 col-6">
						<label for="ultimoConsumoKwh">ÚLTIMA CANTIDAD DE kwh DE CONSUMO</label>
					</div>
				</div>
				<div class="row">
					<div class="col-xxl-3 col-6">
						<input type="number"step="any" name="ultimoPrecio"  value="<?php echo $ultimoPrecio?>"id="ultimoPrecio" class="form-control" required="required">
					</div>	
					<div class="col-xxl-3 col-6">
						<input type="number" step="any" name="ultimoConsumoKwh" id="ultimoConsumoKwh" value="<?php echo $ultimoConsumoKwh?>" class="form-control" required="required">
					</div>					
				</div>
				<br>
				<div class="row justify-content-sm-center h-100">
					<div class="col-xxl-4 col-xl-4 col-lg-5 col-md-7 col-sm-9">
					<label class="text-center">(Si la tarifa es DAC o PDBT sólo ingresar los meses par)</label>
					<table  id="tablax" class=" table table-striped table-bordered text-center">
						<thead style="background-color: #003a70;" >
							<tr>
								<th class="text-light">Mes</th>
								<th  class="text-light">Kwh</th>
							</tr>
						</thead>
						<tbody>
							<?php for($i = 0; $i <= 11; $i++){ ?>
							<tr>
								<td><?php echo $meses[$i]; ?></td>
								<td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" name="<?php echo 'mes'. ($i + 1);?>" value="<?php echo $mesesConsumo[$i]?>" id="<?php echo 'mes'.  ($i + 1);?>" class="form-control" required="required" <?php echo ((($i + 1) % 2) != 0) ? $semestre : ''?>>
										</div>
									</div>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
							</div>
				</div>
			<br>
			<br> 
			<div class="col-xxl-12  col-12">
                        <div class="d-flex justify-content-end">
						<?php require_once 'includes/botonSiguiente.php';?>
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
<script src="assets/js/ciudades.js" defer></script>
<script src="assets/js/meses.js" defer></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>
