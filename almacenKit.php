<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');

session_start();
if (!definido($_SESSION['usuario'])) {
	header('location: LoginUser.php');
}
if(llaveDefinida('panel', $_SESSION) && llaveDefinida('inversor', $_SESSION)&& $_SESSION['etapa'] >= 4 ){

	$kits = seleccionarKitxAlmacen($_SESSION['input2']['kitPrecio']);
	$disable ='';
	if(!llaveDefinida('almacenKit', $_SESSION)){
		$_SESSION['almacenKit'] = [];
		
	}

	if($_SESSION['etapa']  == 5 && count($_SESSION['almacenKit']) > 0){
		$disable ='';
		foreach($_SESSION['almacenKit'] as $a){
			$contador = $a['Numero'];
			$id = $a['ProductoXAlmacenID'];

			for($k = 0; $k < count($kits);$k++){
				if($kits[$k]['ProductoXAlmacenID'] == $id){
					if($kits[$k]['NumeroProductos'] > 0){
						$kits[$k]['NumeroProductos'] = $kits[$k]['NumeroProductos'] - $contador;
					}
				}
				
			}
		}
	}
}else{
	header("Location: index.php");
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
			<h3 class="text-center text-muted">ALMACÉN EN EL SE REALIZARA EL ENVÍO</h3>
			<br>
			
				<div class="row justify-content-sm-center">	
					<div class="table-responsive">
					<br>
					<h3 class="text-muted">KITS</h3>
						<table  id="tablax" class="table table-striped table-bordered text-center">
						<thead style="background-color: #003a70;" >
							<tr>
								<th class="text-center text-light">ALMACÉN</th>
								<th class="text-center text-light">MARCA</th>
								<th class="text-center text-light">MODELO</th>
								<th class="text-center text-light">DESCRIPCIÓN</th>
								<th class="text-center text-light">DISPONIBILIDAD</th>
							</tr>
							</thead>
							<tbody>
								<?php foreach($kits AS $f){
									
									if($f['Disponibilidad'] == 'DISPONIBLE'){
										$imgDisponible = '<img src="assets/img/disponible-icon.png"  height="30px" width="30px" alt="">';
									}else if($f['Disponibilidad'] == 'ENTREGA 15 DÍAS'){
										$imgDisponible = '<img src="assets/img/warning.png"  height="30px" width="30px" alt="">';
									}else{
										$imgDisponible = '<img src="assets/img/no-disponible.png"  height="30px" width="30px" alt="">';
									}
								?>
									<tr>
										<td><?php echo $f['DescCiudad'].': '. $f['DescAlmacen'];?></td>
										<td> <?php echo $f['DescMarca'];?></td>
										<td> <?php echo $f['Modelo'];?></td>
										<td> <?php echo $f['DescProducto'];?></td>
										<td>
											<div class="rounded p-2 w-75 mx-auto"><?php echo $f['Disponibilidad']?><br><?php echo $imgDisponible?></div> 
										</td>
									</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			<br>
			<?php if($_SESSION['etapa'] == 5 && count($_SESSION['almacenKit']) > 0){?>
				<div class="row justify-content-sm-center">	
					<div class="table-responsive">
						<table  id="ultima" class="table  table-striped table-bordered text-center">
						<thead style="background-color: #003a70;" >
							<tr>
								<th class="text-center text-light">ALMACÉN</th>
								<th class="text-center text-light">MARCA</th>
								<th class="text-center text-light">NÚMERO DE PRODUCTOS</th>
								<th class="text-center text-light">DISPONIBILIDAD</th>
								<th class="text-center text-light">QUITAR</th>
							</tr>
							</thead>
							<tbody>
								<?php foreach($_SESSION['almacenKit'] AS $i){ 
									if($i['Disponibilidad'] == 'DISPONIBLE'){
										$imgDisponible = '<img src="assets/img/disponible-icon.png"  height="30px" width="30px" alt="">';
									}else if($i['Disponibilidad'] == 'ENTREGA 15 DÍAS'){
										$imgDisponible = '<img src="assets/img/warning.png"  height="30px" width="30px" alt="">';
									}else{
										$imgDisponible = '<img src="assets/img/no-disponible.png"  height="30px" width="30px" alt="">';
									}
								?>
									<tr>
									<td class="text-start"><?php echo $i['DescCiudad'].' '. $i['DescAlmacen']?></td>
										<td><?php echo $i['DescMarca']?></td>
										<td><?php echo $i['Numero']?></td>
										<td >  
											   <div class=" rounded p-2 w-75 mx-auto"><?php echo $i['Disponibilidad']?><br><?php echo $imgDisponible?></div> </td>
										<td>
											<form action="quitar.php" method="POST">
												<div class="row justify-content-sm-center h-100">
													<div class="col-auto form-check">
														<button class="btn btn-danger mb-3" name="Index" type="submit" value="<?php echo $i['Index'];?>">
															<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  																<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
															</svg>
														</button>
													</div>
												</div>
											</form>
										</td>
									</tr>

								<?php }?>					
							</tbody>
						</table>
					</div>
					<span id="errorMensaje" class="error" style="display: none;">Debes seleccionar al menos una opción.</span>
				</div>
			<?php }?>
			<br>
			<div class="row">
				<div class="col-xxl-6  col-6">
					<a href="design.php" class=" btn btn-success mb-3">
						<?php require_once 'includes/botonRegresar.php';?>
					</a>
				</div>
				<div class="col-xxl-6  col-6">
					<div class="d-flex justify-content-end">
						<form action="resumenEjecutivo.php">
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
	<script src="assets/js/validar.js" defer></script>
	
</html>
