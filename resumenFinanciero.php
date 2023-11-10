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
echo 1;
?>
