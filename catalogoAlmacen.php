<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');

session_start();
$almacens = seleccionarAlmacenes();
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
			<h1 class="fw-normal text-center " style="color:#003a70";><b>ALMACENES</b>
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
  				    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
				</svg>
			</h1>
			<br>
			<form action="calcular.php" method="POST">
				<div class="row justify-content-sm-center">
					<div class="table-responsive">
					<table  id="tablax" class="table  table-striped table-bordered text-center">
					<thead style="background-color: #003a70;" >
                            <tr>
                                <th class="text-center text-light">NÚMERO</th>
                                <th class="text-center text-light">CIUDAD</th>
                                <th class="text-center text-light">ZONA</th>
                            </tr>
						</thead>
						<tbody>
                            <?php foreach($almacens as $a){?>
                                <tr>
                                    <td><?php echo $a['AlmacenID']?></td>
                                    <td><?php echo $a['DescCiudad']?></td>
                                    <td><?php echo $a['DescAlmacen']?></td>
                                </tr>
                            <?php }?>
						</tbody>

					</table>
					</div>
					
				</div>
                <br>
			</form>
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
	<script src="assets/js/tabla.js" defer></script>
</html>
