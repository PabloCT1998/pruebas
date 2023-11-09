<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");;

include('includes/conexion.php');
include('includes/funciones.php');
session_start();
if((llaveDefinida('ciudad',$_POST) && llaveDefinida('tarifa',$_POST) && llaveDefinida('ultimoPrecio',$_POST) && llaveDefinida('ultimoConsumoKwh',$_POST))){
	$_SESSION['etapa'] == 0 ? $_SESSION['etapa'] =  1 : $_SESSION['etapa'] = $_SESSION['etapa'];
	if($_POST['tarifa'] == 1 || $_POST['tarifa'] == 2){
		$meses = ['mes1' =>  null,
		'mes2' => $_POST['mes2'],
		'mes3' =>  null,
		'mes4' => $_POST['mes4'],
		'mes5' =>  null,
		'mes6' => $_POST['mes6'],
		'mes7' =>  null,
		'mes8' => $_POST['mes8'],
		'mes9' =>  null,
		'mes10' => $_POST['mes10'],
		'mes11' =>  null,
		'mes12' => $_POST['mes12']];
		$_SESSION['consumo'] = $meses;
	}else{
		$meses =['mes1' => $_POST['mes1'],
			'mes2' => $_POST['mes2'],
			'mes3' => $_POST['mes3'],
			'mes4' => $_POST['mes4'],
			'mes5' => $_POST['mes5'],
			'mes6' => $_POST['mes6'],
			'mes7' => $_POST['mes7'],
			'mes8' => $_POST['mes8'],
			'mes9' => $_POST['mes9'],
			'mes10' => $_POST['mes10'],
			'mes11' => $_POST['mes11'],
			'mes12' => $_POST['mes12']];
		$_SESSION['consumo'] = $meses;
	}
	foreach($meses as $m){
		if($m != null){
			$consumoAnual += $m;
		}
	}	
	$_SESSION['consumoAnual'] = $consumoAnual;	
	$_SESSION['consumoMeses'] = $meses;	
	$_SESSION['input1'] = $_POST;
	header("Location: producto.php");
}else{
	header("Location: index.php");
}

?>