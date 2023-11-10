<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');
session_start();
if (!definido($_SESSION['usuario'])) {
    header('location: LoginUser.php');
}
echo 1;
?>
