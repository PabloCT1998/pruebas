<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');

session_start();
$_POST['panel'] = (!llaveDefinida('panel', $_POST)) ? $_POST['panelSeleccionado'] : $_POST['panel'];
$_POST['inversor'] = (!llaveDefinida('inversor', $_POST)) ? $_POST['inversorSeleccionado'] : $_POST['inversor'];
if(llaveDefinida('panel', $_POST) && llaveDefinida('numPiezas', $_POST)  && llaveDefinida('inversor', $_POST)){
    
    $panel = explode("+", $_POST['panel']);
    $potencia = $panel[0];
    $_SESSION['potencia'] =$potencia;
    $inversor = explode("+", $_POST['inversor']);
    $eficiencia = $inversor[0];
    // $panel = seleccionarProducto($_POST['panel']);
//     $inversor = seleccionarProducto($_POST['inversor']);
    $_SESSION['kwNecesarios'] = ((int)$potencia * $_POST['numPiezas'])/1000;
  $_SESSION['panel'] = $_POST['panel'];
    $_SESSION['inversor'] =  $_POST['inversor'];
    $_SESSION['numPiezas'] = $_POST['numPiezas'];
    $ciudad = $_SESSION['input1']['ciudad'];
    $_SESSION['etapa'] == 1 ? $_SESSION['etapa'] =  2 : $_SESSION['etapa'] = $_SESSION['etapa'];
    $mesesEnergia = seleccionarEnergiaSolar($ciudad);
    $mesesDias = ['enero' => 31,'febrero' => 28, 'marzo' => 31, 'abril' => 30, 'mayo' => 31,'junio' => 30, 'julio' => 31, 'agosto' => 31, 'septiembre' => 30, 'octubre' => 31, 'noviembre' => 30, 'diciembre' => 31];
//         $eficiencia =  $inversor[0]['Eficiencia']; 
        $eneregiaSolarMes = ['enero' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Enero'] *  $mesesDias['enero'] * (float)$eficiencia),
                            'febrero' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Febrero'] *  $mesesDias['febrero'] * (float)$eficiencia),
                            'marzo' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Marzo'] *  $mesesDias['marzo'] * (float)$eficiencia),
                            'abril' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Abril'] *  $mesesDias['abril'] * (float)$eficiencia),
                            'mayo' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Mayo'] *  $mesesDias['mayo'] * (float)$eficiencia),
                            'junio' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Junio'] *  $mesesDias['junio'] * (float)$eficiencia),
                            'julio' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Julio'] *  $mesesDias['julio'] * (float)$eficiencia),
                            'agosto' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Agosto'] *  $mesesDias['agosto'] * (float)$eficiencia),
                            'septiembre'=> ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Septiembre'] *  $mesesDias['septiembre'] * (float)$eficiencia),
                            'octubre' =>($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Octubre'] *  $mesesDias['octubre'] * (float)$eficiencia),
                            'noviembre' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Noviembre'] *  $mesesDias['noviembre'] * (float)$eficiencia),
                            'diciembre' => ($_SESSION['kwNecesarios'] *  $mesesEnergia[0]['Diciembre'] *  $mesesDias['diciembre'] * (float)$eficiencia)];
    $consumoEnergiaSolarAnual = 0;
    foreach($eneregiaSolarMes as $e){
            $consumoEnergiaSolarAnual += $e;
    }

//     $dimensiones = $panel[0]['Dimensiones'] ;

//     $dimensiones_array = explode("X", $dimensiones);

//     $longitud_mm = (int)$dimensiones_array[0];
//     $ancho_mm = (int)$dimensiones_array[1];


//     $longitud_metros = $longitud_mm / 1000;
//     $ancho_metros = $ancho_mm / 1000;

//     $area_metros_cuadrados =  $_SESSION['numPiezas'] * ($longitud_metros * $ancho_metros);

//     $quince_por_ciento_area = $area_metros_cuadrados * 0.15;

//     $areaNecesaria =  $area_metros_cuadrados + $quince_por_ciento_area;

    $_SESSION['energiaSolarMeses'] = $eneregiaSolarMes;
    $diferencia = $_SESSION['consumoAnual'] - $consumoEnergiaSolarAnual;
    $_SESSION['porcentaje'] = (1-$diferencia /$_SESSION['consumoAnual'])*100;
    $_SESSION['porcentaje'] = number_format($_SESSION['porcentaje'] , 2, '.', ',');

//     $_SESSION['areaNecesaria'] = $areaNecesaria; 
}
header("Location: producto.php");

?>