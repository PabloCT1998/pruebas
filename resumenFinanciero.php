<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');
session_start();
if (!definido($_SESSION['usuario'])) {
    header('location: LoginUser.php');
}
$parametros = seleccionarParametroCRMActivo($_SESSION['usuario']['UsuarioID']);
$crm = $parametros[0]['ValorParametroCRM'];
$mesesConsumo = [];
if(llaveDefinida('input1', $_SESSION) && llaveDefinida('input2', $_SESSION)&& llaveDefinida('consumoMeses', $_SESSION) && llaveDefinida('energiaSolarMeses', $_SESSION) && $_SESSION['etapa'] == 4){
    
    if($_SESSION['utilidadGeneral'] >= 10){
        $utilidad = (float)('0.'. $_SESSION['utilidadGeneral']);
    }else{
        $utilidad = (float)('0.0'. $_SESSION['utilidadGeneral']);
    }

    if($_SESSION['comisionVendedor'] >= 10){
        $numComision = (float)('0.'. $_SESSION['comisionVendedor']);
    }else{
        $numComision = (float)('0.0'. $_SESSION['comisionVendedor']);
    }

    // Valor del Dolar
    $dollar = $_SESSION['valorDollar'];
    //comisión
   // $numComision = (float)('0.0'. $_SESSION['comisionVendedor']);
    
    //Dolares 
    $totalDollar = $_SESSION['total']; //TotlaDolar

    //$utilidad = (float)('0.'. $_SESSION['utilidadGeneral']);


    //Pesos
    $importePesos = $totalDollar * $dollar;
    $ivaPesos = $importePesos * 0.16;
    $totalPesos = $importePesos + $ivaPesos;
    $importeUtilidadPesos = $importePesos / (1 - $utilidad);
    //$subTotal = $importeUtilidadPesos - $comisionUtilidad;
    $ivaUtilidad = $importeUtilidadPesos * 0.16;
    $totalUtilidad = $importeUtilidadPesos + $ivaUtilidad;
    $comisionUtilidad = $importeUtilidadPesos * $numComision;
    $utilidadSinIVA = $importeUtilidadPesos - $importePesos;

    $_SESSION['precioVenta'] = $totalUtilidad;
    $costoWatInstalado = $_SESSION['total'] / $_SESSION['kwNecesarios'] /1000;
}else{
    header("Location: index.php");
}
echo 1;
?>
