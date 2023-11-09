<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');


include('includes/conexion.php'); // Asegúrate de que esto incluye tu archivo de conexión
include('includes/funciones.php'); // Asegúrate de que esto incluye tus funciones

// Verifica si se ha recibido el parámetro 'estado'
if (isset($_GET['estado'])) {
    $estadoID = $_GET['estado'];

    $soporte = new SolarDB();
    $conexion = $soporte->connect();

    $result = $conexion->prepare('SELECT CiudadID, DescCiudad FROM Ciudad WHERE EstadoID = ?');
    $result->execute([$estadoID]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);

    // Devuelve las ciudades en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['ciudades' => $datos]);
} else {
    // Si no se proporcionó el parámetro 'estado', devuelve un mensaje de error o un array vacío, según tus necesidades.
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Parámetro "estado" no proporcionado']);
}
?>
