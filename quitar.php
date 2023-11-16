<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');

session_start();

$post = $_POST['Index'];
if($_SESSION['checkKit'] == true){
    unset($_SESSION['almacenKit'][$post]);
}else{
    unset($_SESSION['almacen'][$post]);
}
 
$cont = 0;

header("Location: almacen.php");

?>