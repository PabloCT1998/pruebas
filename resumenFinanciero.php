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
echo 1;
?>
