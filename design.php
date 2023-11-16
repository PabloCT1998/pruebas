<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');
session_start();
if($_SESSION['etapa'] < 2){
	header("Location: index.php");
}
if (!definido($_SESSION['usuario'])) {
	header('location: LoginUser.php');
}
date_default_timezone_set('America/Mexico_City');

$fechaHoy = date("d/m/Y");
$_SESSION['fechaActual'] = $fechaHoy;
$panel = explode("+", $_SESSION['panel']);
$inversor = explode("+", $_SESSION['inversor']);
$paneles = seleccionarFotoceldas($panel[0], $panel[1]);
$inversores = seleccionarInversores($inversor[0], $inversor[1]);
	$combiBox = seleccionarCombiBox();	
	$conectores = seleccionarConectoresMC4();
	$kits = seleccionarKit($panel[1]);

if(llaveDefinida('precios', $_SESSION)){
	$total = 0;
	$precios = $_SESSION['precios'];
	$precioTotal = $precios['celdas'] + $precios['inversores'] + $precios['combiBox'] + $precios['cables'] + $precios['manoObra'] + $precios['fletes'] + $precios['wifi'] + $precios['unidadVerificadora'] + $precios['interconexion'] + $precios['estructuras'] + $precios['kit'];
	foreach($precios as $p){
		$total += $p;
	}
	$_SESSION['total'] = $total;
	$watsValor = $precioTotal/ $_SESSION['numPiezas']/$_SESSION['potencia']; 
	$watsValor = number_format($watsValor  , 2, '.', ',');
	$_SESSION['watssInstalados'] = $watsValor;
	$dollar = $_SESSION['valorDollar'];
	$cpEntrega = $_SESSION['cpEntrega'];
	$_SESSION['total'] = $total;
		$watsValor = $precioTotal/ $_SESSION['numPiezas']/$_SESSION['potencia']; 
		$watsValor = number_format($watsValor  , 2, '.', ',');
		$_SESSION['watssInstalados'] = $watsValor;
		$dollar = $_SESSION['valorDollar'];
		$utilidadGeneral = $_SESSION['utilidadGeneral'];
		$comisionVendedor = $_SESSION['comisionVendedor'];
		$precioNum = ['panel' =>  (llaveDefinida('panelPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['panelPrecio'] : '',
					'inversores' => (llaveDefinida('inversoresPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['inversoresPrecio'] : '',
					'estructuras' => (llaveDefinida('estructurasPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['estructurasPrecio'] : 0 ,
					'combiBox' => (llaveDefinida('combiBoxPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['combiBoxPrecio'] : '' , 
					'cables' => (llaveDefinida('cablesPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['cablesPrecio'] : 0 ,
					'conectoresMC4' => $_SESSION['input2']['conectoresMC4Precio'],
					'manoObra' => (llaveDefinida('manoObraPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['manoObraPrecio'] : 0 ,
					'fletes' => $_SESSION['input2']['fletesPrecio'], 
					'wifi' => (llaveDefinida('wifiPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['wifiPrecio'] : 0 ,
					'unidadVerificadora' => (llaveDefinida('unidadVerificadorPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['unidadVerificadorPrecio'] : 0  ,  
					'interconexion' => $_SESSION['input2']['interconexionPrecio'],
					'kit' => (llaveDefinida('kitPrecio', $_SESSION['input2'])) ? $_SESSION['input2']['kitPrecio'] : ''];
		$numProducto = [
						'panel' => $_SESSION['numPiezas'],
						'inversores' =>  (llaveDefinida('inversoresNum', $_SESSION['input2'])) ? $_SESSION['input2']['inversoresNum'] : 0 ,
						'estructuras' => (llaveDefinida('estructurasNum', $_SESSION['input2'])) ? $_SESSION['input2']['estructurasNum'] : 0 ,
						'combiBox' => (llaveDefinida('combiBoxNum', $_SESSION['input2'])) ? $_SESSION['input2']['combiBoxNum'] : 0 , 
						'cables' => (llaveDefinida('cablesNum', $_SESSION['input2'])) ? $_SESSION['input2']['cablesNum'] : 0 ,
						'conectoresMC4' => $_SESSION['input2']['conectoresMC4Num'],
						'fletes' => $_SESSION['input2']['fletesNum'], 
						'wifi' => (llaveDefinida('wifiNum', $_SESSION['input2'])) ? $_SESSION['input2']['wifiNum'] : 0 ,
						'unidadVerificadora' => (llaveDefinida('unidadVerificadorNum', $_SESSION['input2'])) ? $_SESSION['input2']['unidadVerificadorPrecio'] : 0  ,
						'interconexion' => $_SESSION['input2']['interconexionNum'],
						'kit' => (llaveDefinida('kitNum', $_SESSION['input2'])) ? $_SESSION['input2']['kitNum'] : 0];

}else{
	$paramatros = seleccionarParametros($_SESSION['usuario']['UsuarioID']);
	$precios = [];
	$precioTotal = 0;
	$precioNum = ['celdas' => '',
				'inversores' => '',
				'estructuras' => '',
				'combiBox' => '', 
				'cables' => '',
				'conectoresMC4' => '',
				'manoObra' => '',
				'fletes' => '', 
				'wifi' => '',
				'unidadVerificadora' => '',
				'interconexion' => '',
				'kit' => ''];
	$numProducto = ['celdas' => '',
				'inversores' => '',
				'estructuras' => '',
				'combiBox' => '', 
				'cables' => '',
				'conectoresMC4' => '',
				'manoObra' => '',
				'fletes' => '', 
				'wifi' => '',
				'unidadVerificadora' => '',
				'interconexion' => '',
				'kit' => ''];

				foreach($paramatros as $paramatro){
					foreach($paramatro as $p){
						if($p == 'Utilidad'){
							$utilidadGeneral = $paramatro['ValorParametro'];
						}

						if($p == 'Comisión Vendedor'){
							$comisionVendedor = $paramatro['ValorParametro'];
						}

						if($p == 'Dollar'){
							$dollar = $paramatro['ValorParametro'];
						}
					}
				}
				$cpEntrega = '';
				$total = 0;
}
$disable ='disabled';
if($_SESSION['etapa'] >= 3){
	$disable ='';
}
?>
<!DOCTYPE html>
<html lang="es-MX">
	<?php require_once 'includes/header.php';?>
	<body>
		<?php require_once 'includes/nav.php';?>
		<div class="container">
			<br>
			<?php require_once 'includes/tituloCotizar.php';?>
			<h3 class="text-center text-muted">COTIZADOR DISEÑO/INTEGRACIÓN</h3>
			<br>
			<form action="calcularDesign.php" class="row" method="POST">
				<div class="col-xxl-3  col-sm-12 col-md-6 col-lg-4">
					<label for="valorDollar">TIPO DE CAMBIO/DÓLAR (<?php echo $fechaHoy;?>)</label>
					<input type="number" min=0 value="<?php echo $dollar?>" step="any" name="valorDollar" id="valorDollar" class="form-control">
				</div>
				<div class="col-xxl-2  col-sm-12 col-md-6 col-lg-4">
					<label for="utilidadGeneral">% UTILIDAD</label>
					<input type="number" min=0 value="<?php echo $utilidadGeneral?>" step="any" name="utilidadGeneral" id="utilidadGeneral" class="form-control" required>
				</div>
				<div class="col-xxl-2  col-sm-12 col-md-6 col-lg-4">
					<label for="comisionVendedor">% COMISION VENDEDOR</label>
					<input type="number" min=0 max="100" value="<?php echo $comisionVendedor?>" step="any" name="comisionVendedor" id="comisionVendedor" class="form-control" required>
				</div>
				<div class="col-xxl-5  col-sm-12 col-md-6 col-lg-7">
					<label for="cpEntrega">CÓDIGO POSTAL PARA ENTREGA </label>
					<div class="row">
						<div class="col-6 col-lg-5">
						<input type="text" name="cpEntrega" id="cpEntrega" value="<?php echo $cpEntrega?>" class="form-control" required>
						</div>
						<div class="col-6 col-lg-5">
						<div class=" form-check">
								<input class="form-check-input" name="checkCPEntregaCliente" type="checkbox" value="true" id="checkCPEntregaCliente" <?php echo (llaveDefinida('checkKit', $_SESSION) && $_SESSION['checkCPEntregaCliente'] == true) ? 'checked' : '';?>>
								<label class="form-check-label" name="checkCPEntregaCliente" for="checkCPEntregaCliente">
									Código Postal del Cliente
								</label>
							</div>
								
						</div>
						
					</div>
					<br>
				</div>
				<input type="hidden" name="cpCliente" value="<?php echo $_SESSION['input1']['cp']?>">
				
				<div class="row justify-content-sm-center h-100">
					<div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12 col-sm-12">
						<div class="table-responsive">
							<?php require_once 'includes/tablaDesign.php';?>
						</div>					
					</div>
				</div>
				<div class="row">
					<div class="col-auto ">
						<label for="checkKit">¿Desea cotizar un Kit?</label>
						<input class="form-switch almacen-checkbox " type="checkbox" name="checkKit" id="checkKit" value="true" <?php echo (llaveDefinida('checkKit', $_SESSION) && $_SESSION['checkKit'] == true) ? 'checked' : '';?>>
					</div>
				</div>
				<?php if($precios != null){?>
                <div class="row justify-content-sm-end">
                    <div class="col-auto">
						<label> <b>TOTAL:</b> <?php echo '$' . number_format($total, 2, '.', ',');?></label>
					</div>
                    <div class="col-auto">
						<label>$<?php echo $watsValor?>/ watts de instalación
						&nbsp&nbsp&nbsp&nbsp <?php if(llaveDefinida('areaNecesaria', $_SESSION)  && $_SESSION['checkKit'] == false){echo '<b>Area a Considerar: </b>' . number_format($_SESSION['areaNecesaria'], 2). 'm<sup>2</sup>';}?> 

					
						</label>
						
					</div>
                </div>
				<?php }?>
	            <br>
				<?php require_once 'includes/botonCalcular.php';?>
			</form>
			<div class="row">
				<div class="col-xxl-6  col-6">
					<a href="producto.php" class=" btn btn-success mb-3">
						<?php require_once 'includes/botonRegresar.php';?>
					</a>
				</div>
				<div class="col-xxl-6  col-6">
					<div class="d-flex justify-content-end">
						<form action="almacen.php">
							<?php require_once 'includes/botonSiguiente.php';?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php require_once 'includes/footer.php';?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script src="assets/js/checkKit.js" defer></script>
	<script>
	document.addEventListener("DOMContentLoaded", function() {
    var cpEntregaInput = document.getElementById("cpEntrega");
    var cpClienteInput = document.querySelector("input[name='cpCliente']");
    var cpEntregaClienteCheckbox = document.getElementById("checkCPEntregaCliente");

    // Verificar el estado inicial del checkbox y deshabilitar el campo de entrada si está marcado
    if (cpEntregaClienteCheckbox.checked) {
        cpEntregaInput.disabled = true;
        cpEntregaInput.value = cpClienteInput.value;
    }

    // Agregar un evento change al checkbox para habilitar o deshabilitar el campo de entrada
    cpEntregaClienteCheckbox.addEventListener("change", function() {
        cpEntregaInput.disabled = this.checked;
        // Establecer el valor del campo de entrada al valor del campo cpCliente cuando se deshabilita
        if (this.checked) {
            cpEntregaInput.value = cpClienteInput.value;
        } else {
            cpEntregaInput.value = ""; // Limpiar el valor del campo de entrada cuando se habilita
        }
    });
});

	</script>

</html>