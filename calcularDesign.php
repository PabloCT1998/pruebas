<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');
session_start();

if(llaveDefinida('panelPrecio', $_POST)){
    $panel = seleccionarProducto($_POST['panelPrecio']);
    $panelPrecio = $panel[0]['Precio'];
}else{
    $panelPrecio = 0; 
}

if(llaveDefinida('inversoresPrecio', $_POST)){
    $inversoresPrecio = seleccionarProducto($_POST['inversoresPrecio']);
    $inversoresPrecio = $inversoresPrecio[0]['Precio'];

}else{
    $inversoresPrecio = 0;
}

if(llaveDefinida('checkKit', $_POST)){
    $_SESSION['checkKit'] = true;
    $kits = seleccionarProducto($_POST['kitPrecio']);
    $kitPrecio = $kits[0]['Precio'];

}else{
    $_SESSION['checkKit'] = false;
    $_SESSION['cpEntrega'] = $_POST['cpEntrega'];
}


if(llaveDefinida('checkCPEntregaCliente', $_POST)){
    $_SESSION['checkCPEntregaCliente'] = true;
    $_SESSION['cpEntrega'] = $_SESSION['input1']['cp'];

}else{
    $_SESSION['checkCPEntregaCliente'] = false;
    $_SESSION['cpEntrega'] = $_POST['cpEntrega'];
}

$conectorMC4 = seleccionarProducto($_POST['conectoresMC4Precio']);
$_SESSION['etapa'] == 2 ? $_SESSION['etapa'] =  3 : $_SESSION['etapa'] = $_SESSION['etapa'];
$precios = ['celdas' => $_SESSION['numPiezas'] * $panelPrecio,
'inversores' => ((llaveDefinida('inversoresNum', $_POST)) ? $_POST['inversoresNum'] : 0 ) * $inversoresPrecio,
'estructuras' => ((llaveDefinida('estructurasNum', $_POST)) ? $_POST['estructurasNum'] : 0 )  *  ((llaveDefinida('estructurasPrecio', $_POST)) ? $_POST['estructurasPrecio'] : 0 ),
'combiBox' => ((llaveDefinida('combiBoxNum', $_POST)) ? $_POST['combiBoxNum'] : 0 ) * ((llaveDefinida('combiBoxPrecio', $_POST)) ? $_POST['combiBoxPrecio'] : 0 ),
'cables'=> ((llaveDefinida('cablesNum', $_POST)) ? $_POST['cablesNum'] : 0 )  *  ((llaveDefinida('cablesPrecio', $_POST)) ? $_POST['cablesPrecio'] : 0 ),
'conectoresMC4'=> $_POST['conectoresMC4Num'] *  $conectorMC4[0]['Precio'],
'manoObra' =>  $_SESSION['numPiezas'] *  ((llaveDefinida('manoObraPrecio', $_POST)) ? $_POST['manoObraPrecio'] : 0 ),
'fletes' => $_POST['fletesNum'] *  $_POST['fletesPrecio'],  
'wifi'=> ((llaveDefinida('wifiNum', $_POST)) ? $_POST['wifiNum'] : 0 ) * ((llaveDefinida('wifiPrecio', $_POST)) ? $_POST['wifiPrecio'] : 0 ),
'unidadVerificadora' => ((llaveDefinida('unidadVerificadorNum', $_POST)) ? $_POST['unidadVerificadorNum'] : 0 ) * ((llaveDefinida('unidadVerificadorPrecio', $_POST)) ? $_POST['unidadVerificadorPrecio'] : 0 ),
'interconexion' => $_POST['interconexionNum'] *  $_POST['interconexionPrecio'],
'kit' => ((llaveDefinida('kitNum', $_POST)) ? $_POST['kitNum'] : 0 ) * ((llaveDefinida('kitPrecio', $_POST))) ? $kitPrecio : 0] ;


if(llaveDefinida('kitNum', $_POST) && llaveDefinida('kitPrecio', $_POST)){
    $precios['kit'] = $_POST['kitNum'] * $kitPrecio;
}
$_SESSION['input2'] = $_POST;
$_SESSION['precios'] = $precios;
if(llaveDefinida('valorDollar', $_POST)){
    $_SESSION['valorDollar'] = $_POST['valorDollar'];
}else{
    $_SESSION['valorDollar'] = 20;
}

    $dimensiones = $panel[0]['Dimensiones'];

    $dimensiones_array = explode("X", $dimensiones);

    $longitud_mm = (int)$dimensiones_array[0];
    $ancho_mm = (int)$dimensiones_array[1];


    $longitud_metros = $longitud_mm / 1000;
    $ancho_metros = $ancho_mm / 1000;

    $area_metros_cuadrados =  $_SESSION['numPiezas'] * ($longitud_metros * $ancho_metros);

    $quince_por_ciento_area = $area_metros_cuadrados * 0.15;

    $areaNecesaria =  $area_metros_cuadrados + $quince_por_ciento_area;

$_SESSION['areaNecesaria'] = $areaNecesaria;
$_SESSION['utilidadGeneral' ] = $_POST['utilidadGeneral'];
$_SESSION['comisionVendedor'] = $_POST['comisionVendedor'];
header("Location: design.php");
?>
