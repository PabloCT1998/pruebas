<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');

session_start();
$producto1 = seleccionarProductos(1);
$producto2 = seleccionarProductos(2);
$producto3 = seleccionarProductos(3);
$producto4 = seleccionarProductos(4);
$producto5 = seleccionarProductos(5);
$producto6  = seleccionarProductos(8);
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
            <h1 class="fw-normal text-center " style="color:#003a70";><b>CATÁLOGO PRODUCTOS</b>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
					<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
					<path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
			    </svg>
			</h1>
			<br>
				<div class="row justify-content-sm-center">
					<div class="table-responsive">
                    <br>
                    <h3 class="text-start text-muted"><?php echo $producto1[0]['DescTipoProducto']?></h3>
					<table  id="tablax" class="table tablax table-striped table-bordered text-center">
                        <thead style="background-color: #003a70;" >

                            <tr>
                                <th class="text-center text-light">Marca</th>
                                <th class="text-center text-light">Modelo</th>
                                <th class="text-center text-light">Descripción</th>
                                <th class="text-center text-light">Precio</th>
                            </tr>
						</thead>
						<tbody>
                            <?php foreach($producto1 as $p){?>
                                <tr>
                                    <td><?php echo $p['DescMarca']?></td>
                                    <td><?php echo $p['Modelo']?></td>
                                    <td><?php echo $p['DescProducto']?></td>
                                    <td>$<?php echo ' '. number_format(((float)$p['Precio']), 2, '.', ',');?></td>
                                </tr>
                            <?php }?>
						</tbody>
					</table>
                    <br>
                    <h3 class="text-start text-muted"><?php echo $producto2[0]['DescTipoProducto']?></h3>
                    <table  id="tablax" class="table tablax table-striped table-bordered text-center">
					    <thead style="background-color: #003a70;" >
                            <tr>
                                <th class="text-center text-light">Marca</th>
                                <th class="text-center text-light">Modelo</th>
                                <th class="text-center text-light">Descripción</th>
                                <th class="text-center text-light">Precio</th>
                            </tr>
						</thead>
						<tbody>
                            <?php foreach($producto2 as $p){?>
                                <tr>
                                    <td><?php echo $p['DescMarca']?></td>
                                    <td><?php echo $p['Modelo']?></td>
                                    <td><?php echo $p['DescProducto']?></td>
                                    <td>$<?php echo ' '. number_format(((float)$p['Precio']), 2, '.', ',');?></td>
                                </tr>
                            <?php }?>
						</tbody>

					</table>
                    <br>
                    <h3 class="text-start text-muted"><?php echo $producto3[0]['DescTipoProducto']?></h3>
                    <table  id="tablax" class="table tablax table-striped table-bordered text-center">
                        <thead style="background-color: #003a70;" >
                            <tr>
                                <th class="text-center text-light">Marca</th>
                                <th class="text-center text-light">Modelo</th>
                                <th class="text-center text-light">Descripción</th>
                                <th class="text-center text-light">Precio</th>
                            </tr>
						</thead>
						<tbody>
                            <?php foreach($producto3 as $p){?>
                                <tr>
                                    <td><?php echo $p['DescMarca']?></td>
                                    <td><?php echo $p['Modelo']?></td>
                                    <td><?php echo $p['DescProducto']?></td>
                                    <td>$<?php echo ' '. number_format(((float)$p['Precio']), 2, '.', ',');?></td>
                                </tr>
                            <?php }?>
						</tbody>
					</table>
                    <br>
                    <h3 class="text-start text-muted"><?php echo $producto4[0]['DescTipoProducto']?></h3>
                    <table  id="tablax" class="table tablax table-striped table-bordered text-center">
                        <thead style="background-color: #003a70;" >
                            <tr>
                                <th class="text-center text-light">Marca</th>
                                <th class="text-center text-light">Modelo</th>
                                <th class="text-center text-light">Descripción</th>
                                <th class="text-center text-light">Precio</th>
                            </tr>
						</thead>
						<tbody>
                            <?php foreach($producto4 as $p){?>
                                <tr>
                                    <td><?php echo $p['DescMarca']?></td>
                                    <td><?php echo $p['Modelo']?></td>
                                    <td><?php echo $p['DescProducto']?></td>
                                    <td>$<?php echo ' '. number_format(((float)$p['Precio']), 2, '.', ',');?></td>
                                </tr>
                            <?php }?>
						</tbody>
					</table>
                    <br>
                    <h3 class="text-start text-muted"><?php echo $producto5[0]['DescTipoProducto']?></h3>
                    <table  id="tablax" class="table tablax table-striped table-bordered text-center">
                        <thead style="background-color: #003a70;" >
                            <tr>
                                <th class="text-center text-light">Marca</th>
                                <th class="text-center text-light">Modelo</th>
                                <th class="text-center text-light">Descripción</th>
                                <th class="text-center text-light">Precio</th>
                            </tr>
						</thead>
						<tbody>
                            <?php foreach($producto5 as $p){?>
                                <tr>
                                    <td><?php echo $p['DescMarca']?></td>
                                    <td><?php echo $p['Modelo']?></td>
                                    <td><?php echo $p['DescProducto']?></td>
                                    <td>$<?php echo ' '. number_format(((float)$p['Precio']), 2, '.', ',');?></td>
                                </tr>
                            <?php }?>
						</tbody>
					</table>
                    <h3 class="text-start text-muted"><?php echo $producto6[0]['DescTipoProducto']?></h3>
                    <table  id="tablax" class="table tablax table-striped table-bordered text-center">
                        <thead style="background-color: #003a70;" >
                            <tr>
                                <th class="text-center text-light">Marca</th>
                                <th class="text-center text-light">Modelo</th>
                                <th class="text-center text-light">Descripción</th>
                                <th class="text-center text-light">Precio</th>
                            </tr>
						</thead>
						<tbody>
                            <?php foreach($producto6 as $p){?>
                                <tr>
                                    <td><?php echo $p['DescMarca']?></td>
                                    <td><?php echo $p['Modelo']?></td>
                                    <td><?php echo $p['DescProducto']?></td>
                                    <td>$<?php echo ' '. number_format(((float)$p['Precio']), 2, '.', ',');?></td>
                                </tr>
                            <?php }?>
						</tbody>
					</table>
					</div>
					
				</div>
                <br>
			<div class="row">
				<div class="col-auto">
					<a href="index.php"  class=" btn btn-success mb-3">
						<?php require_once 'includes/botonRegresarMenu.php';?>
					</a>
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
</html>
