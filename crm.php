

<?php
include('includes/conexion.php');
include('includes/funciones.php');
require('vendor/autoload.php');
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

session_start();

$connectionString ='DefaultEndpointsProtocol=https;AccountName=azsolar;AccountKey=s1x0MhH7ErO+KCUzv1xImFcGbzfwO+ewifWmzaN43d6C/zqfO8LSOOCFNrTE10J31/pD5CQuIfuD+ASt68bhyA==;EndpointSuffix=core.windows.net';

$blobClient = BlobRestProxy::createBlobService($connectionString);
$containerName = 'azsolar';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && llaveDefinida('archivos', $_FILES)) {
    $archivos = $_FILES['archivos'];

    foreach ($archivos['tmp_name'] as $key => $tmp_name) {
        if ($archivos['error'][$key] === UPLOAD_ERR_OK) {
            $archivoTmp = $archivos['tmp_name'][$key];
            $nombreArchivo = $archivos['name'][$key];
            $rutaEnBlob = "$nombreArchivo";

            try {
                $blobClient->createBlockBlob($containerName, $rutaEnBlob, fopen($archivoTmp, "r"));
                echo "Archivo '$nombreArchivo' subido correctamente a Blob Storage.";
            } catch (ServiceException $e) {
                echo "Error al subir el archivo '$nombreArchivo': " . $e->getMessage();
            }
        } else {
            echo "Error al subir el archivo '$nombreArchivo': Código de error " . $archivos['error'][$key];
        }
    }
} else {
    echo "No se recibieron archivos para subir.";
}
?>
