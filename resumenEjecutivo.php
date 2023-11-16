<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');
session_start();
if (!definido($_SESSION['usuario'])) {
    header('location: LoginUser.php');
}
$mesesConsumo = [];
$_SESSION['archivosCRM']['tipo'] = 'RE';
$meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
if(llaveDefinida('input1', $_SESSION) && llaveDefinida('input2', $_SESSION)&& llaveDefinida('consumoMeses', $_SESSION) && llaveDefinida('energiaSolarMeses', $_SESSION) && $_SESSION['etapa'] == 4){
    if($_SESSION['input1']['tarifa'] == 1 ||$_SESSION['input1']['tarifa'] == 2){
        foreach($_SESSION['consumoMeses'] as $s){
            if($s != null){ 
                $num = $s / 2;
                array_push($mesesConsumo,  $num, $num);
            }
        }
    }else{
        $mesesConsumo = $_SESSION['consumoMeses'];
    }

    $tabla = [];
    $energiaSolar = [];
    $totalTabla = [];
    $totalTabla['consumoOriginal'] = 0;
    $totalTabla['consumoSolar'] = 0;
    $totalTabla['facturaActual'] = 0;
    $totalTabla['facturaSolar'] = 0;
    $totalTabla['ahorro'] = 0;
    $i = 0;

    $tarifa = $_SESSION['input1']['ultimoPrecio'] / $_SESSION['input1']['ultimoConsumoKwh'];

    foreach( $_SESSION['energiaSolarMeses'] as $f){
    array_push($energiaSolar,$f);  
    }

    foreach($mesesConsumo as $m){
    $consumoSolar = $m - $energiaSolar[$i];
        $t = ['mes' => $meses[$i],
            'consumoOriginal' => $m,
            'consumoSolar' => $consumoSolar,
            'facturaActual' => $m * $tarifa,
            'facturaSolar' => $consumoSolar * $tarifa,
            'ahorro' =>  ($m * $tarifa) - ($consumoSolar * $tarifa)];

        array_push($tabla, $t);
        $i++;
    }

    

    foreach($tabla as $t){
        $totalTabla['consumoOriginal'] += (float)$t['consumoOriginal']; 
        $totalTabla['consumoSolar'] += (float)$t['consumoSolar']; 
        $totalTabla['facturaActual'] += (float)$t['facturaActual'];
        $totalTabla['facturaSolar'] += (float)$t['facturaSolar'];
        $totalTabla['ahorro'] += (float)$t['ahorro'];
    }

    $_SESSION['tablaResumenEjecutivo'] = $tabla;
    $_SESSION['totalTableResumenEjecutivo'] = $totalTabla;
    $costoWatInstalado = $_SESSION['total'] / $_SESSION['kwNecesarios'] /1000;

    $totales = ['mes' => 'TOTAL',
                'consumoOriginal' =>  $totalTabla['consumoOriginal'],
                'consumoSolar' => $totalTabla['consumoSolar'], 
                'facturaActual' => $totalTabla['facturaActual'],
                'facturaSolar' => $totalTabla['facturaSolar'],
                'ahorro' => $totalTabla['ahorro']];

                array_push($tabla, $totales);

}else{
    header("Location: index.php");
}
$contador = 0;
?>

<!DOCTYPE html>
<html lang="es">
    <?php require_once 'includes/header.php';?>
	<body>
        <div class="no-imprimir">
        <?php require_once 'includes/nav.php';?>
        </div>
		<div class="container">
            <?php require_once 'includes/tituloCotizar.php';?>
			<h3 class="text-center  text-muted">RESUMEN EJECUTIVO</h3>
            <br>
            <div class="row  justify-content-end">
                <div class="col-auto"> 
                    <div class="d-flex">
                            <button class="btn text-light no-imprimir bg-danger"  id="botonpdf" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                    <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                                </svg>    
                                Convertir a PDF
                            </button>
                    </div>
                </div>
                <div class="col-auto"> 
                    <div class="d-flex">
                        <button id="resumenFinanciero" type="button" class="btn text-light  no-imprimir" style="background-color:  #fd7e14 ;" >  
                            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                            </svg>
                            Ver Resumen Financiero
                        </button>
                    </div>
                </div>
            </div>
            <br>    
            <h4 class="text-center ">TABLA DE NUEVOS CONSUMOS VS HISTORICOS</h4>			
				<div class="row justify-content-sm-center h-100">
                    <div class="col-xxl-9 col-xl-9 col-lg-5 col-md-12 col-sm-9">
                        <div class="table-responsive">
                            <table  id="tablaResumenEjecutivo" class="table table-striped table-bordered text-center ">
                                <thead style="background-color: #003a70;" >
                                <tr>
                                    <th class="text-center text-light">MES</th>
                                    <th class="text-center text-light">CONSUMO ACTUAL Kwh</th>
                                    <th class="text-center text-light">CONSUMO CON SPV Kwh</th>
                                    <th class="text-center text-light">FACTURA ACTUAL</th>
                                    <th class="text-center text-light">FACTURA CON SPV</th>
                                    <th class="text-center text-light">AHORRO</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($tabla as $t){
                                        if($contador < 12){?>
                                    <tr>
                                        <td class="col-1"><?php echo $t['mes']?></td>
                                        <td  class="col-2"><?php echo  round($t['consumoOriginal'], 0, PHP_ROUND_HALF_UP)?></td>
                                        <td class="col-2"><?php echo round($t['consumoSolar'], 0, PHP_ROUND_HALF_UP)?></td>
                                        <td class=" text-end">$<?php echo number_format($t['facturaActual'], 2, '.', ',')?></td>
                                        <td class=" text-end">$<?php echo number_format($t['facturaSolar'], 2, '.', ',')?><t/d>
                                        <td class="  text-end">$<?php echo  number_format($t['ahorro'], 2, '.', ',')?></td>
                                    </tr>

                                    <?php 
                                        $contador++;
                                        }else{ ?>
                                        <tr>
                                            <td class="col-1"><b><?php echo $t['mes']?></b></td>
                                            <td  class="col-2"><b><?php echo  round($t['consumoOriginal'], 0, PHP_ROUND_HALF_UP)?></b></td>
                                            <td class="col-2"><b><?php echo round($t['consumoSolar'], 0, PHP_ROUND_HALF_UP)?></b></td>
                                            <td class=" text-end"><b>$<?php echo number_format($t['facturaActual'], 2, '.', ',')?></b></td>
                                            <td class=" text-end"><b>$<?php echo number_format($t['facturaSolar'], 2, '.', ',')?></b><t/d>
                                            <td class="  text-end"><b>$<?php echo  number_format($t['ahorro'], 2, '.', ',')?></b></td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
				</div>
                <div class="row">
                    <div class="col-md-6">
                      <div id="chart1"></div>
                    </div>
                    <div class="col-md-6">
                      <div id="chart2"></div>
                    </div>
                </div>
                <br>
                <a class=" btn btn-success mb-3 no-imprimir" href="<?php echo ($_SESSION['checkKit'] == true) ? 'almacenKit.php' : 'almacen.php'; ?>">
                    <?php require_once 'includes/botonRegresar.php';?>
                </a>
		    </div>
        </div>
    </body>
    <?php require_once 'includes/footer.php';?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="assets/js/graficas.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.12/jspdf.plugin.autotable.min.js"></script>
    <script>var datos = <?php echo json_encode($tabla); ?>;</script>
</html>
