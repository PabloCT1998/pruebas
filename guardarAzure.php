<?php 
include('includes/funciones.php');
require 'vendor/autoload.php'; // Asegúrate de incluir el SDK de Azure Storage

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
session_start();
$fechaCreacion =date("d-m-Y-h-i-s");

$connectionString ='DefaultEndpointsProtocol=https;AccountName=azsolar;AccountKey=s1x0MhH7ErO+KCUzv1xImFcGbzfwO+ewifWmzaN43d6C/zqfO8LSOOCFNrTE10J31/pD5CQuIfuD+ASt68bhyA==;EndpointSuffix=core.windows.net';

$blobClient = BlobRestProxy::createBlobService($connectionString);
$containerName = 'azsolar';
// Ruta local al archivo PDF
$guid = getGUID();
$nombreUnicoExtension = $fechaCreacion .'-'. $guid .'.pdf';
$ruta = $nombreUnicoExtension;

$rutaAzure = 'https://azsolar.blob.core.windows.net/azsolar/' .  $nombreUnicoExtension;

if($_SESSION['archivosCRM']['tipo'] == 'RF'){
    $_SESSION['archivosCRM']['resumenFinanciero'] = $rutaAzure;
} else if($_SESSION['archivosCRM']['tipo'] == 'RE'){
    $_SESSION['archivosCRM']['resumenEjecutivo'] = $rutaAzure;
}
$datosPDF = file_get_contents("php://input");

// Subir el archivo PDF a Azure Blob Storage
try {
    $blobClient->createBlockBlob($containerName, $ruta, fopen($datosPDF, "r"));
    echo json_encode(['success' => true, 'message' => 'PDF guardado correctamente en Azure Blob Storage.']);
} catch (ServiceException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al subir el PDF a Azure Blob Storage: ' . $e->getMessage()]);
}

?>