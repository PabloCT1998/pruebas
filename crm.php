<?php 
    
include('includes/conexion.php');
include('includes/funciones.php');

require_once __DIR__ . '/vendor/autoload.php';
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

    //$fechaCreacion =date("d-m-Y-h-i-s");
    ////$connectionString ='DefaultEndpointsProtocol=https;AccountName=azsolar;AccountKey=s1x0MhH7ErO+KCUzv1xImFcGbzfwO+ewifWmzaN43d6C/zqfO8LSOOCFNrTE10J31/pD5CQuIfuD+ASt68bhyA==;EndpointSuffix=core.windows.net';
    //$blobClient = BlobRestProxy::createBlobService($connectionString);
    //$blobService = new AzureBlobService($blobClient);
    //$containerName = 'azsolar';
echo "Hola"
?>
