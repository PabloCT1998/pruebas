<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');


session_start();
$consumoAnual = 0;
if($_SESSION['etapa'] < 1 ){
	header("Location: index.php");
}
if (!definido($_SESSION['usuario'])) {
	header('location: LoginUser.php');
}
$fotocoledas = seleccionarFotoceldasPorPortencia();
$inversores = seleccionarInversoresPorEficiencia();
$disable ='disabled';
if($_SESSION['etapa'] >= 2){ $disable ='';}
?>

<!DOCTYPE html>
<html lang="es">
	
<?php require_once 'includes/header.php';?>
	<body>
		<?php require_once 'includes/nav.php';?>
		<div class="container">
			<br>
			<?php require_once 'includes/tituloCotizar.php';?>
			<h3 class="text-center text-muted">Productos</h3>
			<br>
			<form action="calcular.php" method="POST">
				<div class="row justify-content-sm-center">
					<div class="table-responsive">
						<h3 class="text-muted">CELDAS</h3>
						<table  id="tablaCeldas" class="table tablax table-striped table-bordered text-center">
							<thead style="background-color: #003a70;" >
							<tr>
								<th class="text-center text-light">PRODUCTO</th>
								<th class="text-center text-light">MARCA</th>
								<th class="text-center text-light">POTENCIA</th>
								<th class="text-center text-light">SELECCIONAR</th>
							</tr>
							</thead>
							<tbody>
								<?php foreach($fotocoledas AS $i){?>
								<tr>
									<td class="text-center"><?php echo $i['DescTipoProducto'];?></td>
									<td> <?php echo $i['DescMarca'];?></td>
									<td><?php echo (int)$i['Potencia'];?></td>
									<td>
										<div class="row justify-content-sm-center h-100">
											<div class="col-auto form-check">
												<?php if( $_SESSION['etapa'] == 1 || $_SESSION['panel'] != $i['Potencia'].'+'. $i['MarcaID']){?>
														<input class="form-check-input" type="radio" name="panel" id="panel" value="<?php echo $i['Potencia'].'+'. $i['MarcaID'];?>"  required >
												<?php }else{?>
													<input class="form-check-input" type="radio" name="panel" id="panel" value="<?php echo $i['Potencia'].'+'. $i['MarcaID'];?>" checked>
											</div>
												<?php }?>
										</div>
									</td>
									<?php }?>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
					<div class="table-responsive">
						<h3 class="text-muted">INVERSORES</h3>
						<table  id="tablaInversor" class="table  data-click-to-select tablax table-striped table-bordered text-center">
							<thead style="background-color: #003a70;" >
							<tr>
								<th class="text-center text-light">PRODUCTO</th>
								<th class="text-center text-light">MARCA</th>
								<th class="text-center text-light">SELECCIONAR</th>
							</tr>
							</thead>
							<tbody>
								<?php foreach($inversores AS $i){?>
								<tr>
									<td class="text-center"><?php echo $i['DescTipoProducto'];?></td>
									<td> <?php echo $i['DescMarca'];?></td>
									<td>
										<div class="row justify-content-sm-center h-100">
											<div class="col-auto form-check">
											<?php if( $_SESSION['etapa'] == 1 || $_SESSION['inversor'] != $i['Eficiencia'].'+'. $i['MarcaID']){?>
														<input class="form-check-input inversor-input data-click-to-select" type="radio" name="inversor" id="inversro" value="<?php echo $i['Eficiencia'].'+'. $i['MarcaID'];?>"  required >
												<?php }else{?>
													<input class="form-check-input inversor-input data-click-to-select" type="radio" name="inversor" id="inversor" value="<?php echo $i['Eficiencia'].'+'. $i['MarcaID'];?>"  checked>
											</div>
												<?php }?>
										</div>
									</td>
									<?php }?>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
				<div class="row">
					<div class="col-auto">
						<label for="numPiezas">NÚMERO DE PIEZAS</label>
						<input type="number" name="numPiezas" min=0 value="<?php echo $_SESSION['numPiezas']?>" id="numPiezas" class="form-control " required="required">
					</div>
						<div class="col-10">
							<div class="d-flex justify-content-end">
								<label id="kw">
									<?php if(llaveDefinida('porcentaje', $_SESSION)){echo'<b>Porcentaje: </b>'. $_SESSION['porcentaje']. '%';}?>&nbsp&nbsp&nbsp&nbsp
									<?php if(llaveDefinida('kwNecesarios', $_SESSION)){echo '<b>Potencia: </b>' . $_SESSION['kwNecesarios']. 'Kw';}?> &nbsp&nbsp&nbsp&nbsp
									<!-- <?php if(llaveDefinida('kwNecesarios', $_SESSION) && (llaveDefinida('porcentaje', $_SESSION))){echo 'inclinación recomendada de 18 - 24°';} ?> -->
								</label>
							</div>
						</div>
						
						<?php if($_SESSION['etapa'] == 1 ) { ?>
							<input type="hidden" name="panelSeleccionado" id="panelSeleccionado" value="0">
						<?php }else{ ?>
							<input type="hidden" name="panelSeleccionado" id="panelSeleccionado" value="<?php echo $_SESSION['panel']?>">
						<?php }?>
						<?php if($_SESSION['etapa'] == 1 ) { ?>
							<input type="hidden" id="inversorSeleccionado" name="inversorSeleccionado" value="0">
						<?php }else{ ?>
							<input type="hidden" id="inversorSeleccionado" name="inversorSeleccionado" value="<?php echo $_SESSION['inversor']?>">
						<?php }?>
					</div>
                	<br>
					<?php require_once 'includes/botonCalcular.php';?>
				</div>
			</form>
			<div class="row">
				<div class="col-xxl-6  col-6">
					<a href="consumo_1.php" class=" btn btn-success mb-3">
						<?php require_once 'includes/botonRegresar.php';?>
					</a>
				</div>
				
				<div class="col-xxl-6  col-6">
					<div class="d-flex justify-content-end">
						<form action="design.php">
							<?php require_once 'includes/botonSiguiente.php';?>
						</form>
					</div>
				</div>
			</div>
		</div>

</body>
<?php require_once 'includes/footer.php';?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
	<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js" defer></script>
	<script src="assets/js/tabla.js" defer></script>
	<script src="assets/js/events.js" defer></script>

</html>
