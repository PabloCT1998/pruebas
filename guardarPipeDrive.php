<?php
    
include('includes/conexion.php');
include('includes/funciones.php');

require('vendor/autoload.php');
require('vendor\microsoft\azure-storage-blob\src\Blob\BlobRestProxy.php'); 
include ('includes/AzureBlobService.php');
require_once __DIR__ . '/vendor/autoload.php';
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

    session_start();
    $fechaCreacion =date("d-m-Y-h-i-s");
    $connectionString ='DefaultEndpointsProtocol=https;AccountName=azsolar;AccountKey=s1x0MhH7ErO+KCUzv1xImFcGbzfwO+ewifWmzaN43d6C/zqfO8LSOOCFNrTE10J31/pD5CQuIfuD+ASt68bhyA==;EndpointSuffix=core.windows.net';
    $blobClient = BlobRestProxy::createBlobService($connectionString);
    $blobService = new AzureBlobService($blobClient);
    $containerName = 'azsolar';
    $parametros = seleccionarParametrosCRM($_SESSION['usuario']['UsuarioID']);
    foreach($parametros as $parametro){
        foreach($parametro as $p){
            if($p == 'Pipedrive Activo'){
                $crm = $parametro['ValorParametroCRM'];
            }
            if($p == 'Token Pipedrive'){
                $token = $parametro['ValorParametroCRM'];
            }
            if($p == 'Dominio Pipedrive'){
                $dominio = $parametro['ValorParametroCRM'];
            }
        }
    } 
    $nota = '';
    $notaArchivo = 'Archivos';
    if($crm == 1 && ($token != null || $token != '') && ($dominio != null || $token != '') && llaveDefinida('nombre', $_POST) && llaveDefinida('correoElectronico', $_POST) && llaveDefinida('telefono', $_POST) && llaveDefinida('titulo', $_POST) && llaveDefinida('dinero', $_POST)){
        $idPersona = addPerson($_POST['nombre'],  $_POST['telefono'], $_POST['correoElectronico'], $token, $dominio);
        if($idPersona != 0){
            $idLead = addLeads($idPersona, $_POST['dinero'], $_POST['titulo'], $token, $dominio);
            if($idLead != 0){
                if(llaveDefinida('nota', $_POST)){
                    $notaValidar = addNote( $_POST['nota'], $idLead, $token, $dominio);
                    $nota =  $_POST['nota'];

                    if(!$notaValidar){
                        $_SESSION['erroCRM'] = 'Error al enviarse información 1';
                        header('location: formCRM.php');                
                    }
                }else{
                    $nota = '';
                }

                if ($_FILES['archivos']['error'][0] != UPLOAD_ERR_NO_FILE) {
                    foreach($_FILES["archivos"]['tmp_name'] as $key => $tmp_name){
                        if($_FILES["archivos"]["name"][$key]) {
                            $path = $_FILES['archivos']['name'][$key]; 
                            echo '<br>path: '. $path;
                            $nombreOriginalSinExtension = pathinfo($path, PATHINFO_FILENAME);
                            echo ' <br>Nombre: '. $nombreOriginalSinExtension;
                            $nombreOrigianlConExrension = $_FILES["archivos"]["name"][$key]; 
                            $extension = pathinfo($path, PATHINFO_EXTENSION);
                            echo '<br>Extensión: '. $extension;
                            $tipoArchivo = $_FILES['archivos']['type'][$key];
                            $size = $_FILES['archivos']['size'][$key];
                            $guid = getGUID();
                            '<br>unica: '. $nombreUnicoExtension = $fechaCreacion .'-'. $guid .'.'.$extension;
                            
                            $_FILES["archivos"]["name"][$key] =  $nombreUnicoExtension ; 
            
                            // Nombres de archivos de temporales
                            $archivonombre = $_FILES["archivos"]["name"][$key];
                            $fuente = $_FILES["archivos"]["tmp_name"][$key];  
            
                            $ruta = 'https://azsolar.blob.core.windows.net/azsolar/' .  $nombreUnicoExtension;
                            $notaArchivo = $notaArchivo. '<br><a href="'.$ruta.'">'.$nombreOrigianlConExrension .'</a>' ;
                            $archivo['archivos'] = [
                                'name' => $nombreUnicoExtension,
                                'full_path' => $_FILES["archivos"]["full_path"][$key],
                                'type' =>  $tipoArchivo,
                                'tmp_name' => $fuente,
                                'error' => $_FILES["archivos"]["error"][$key],
                                'size' =>  $size
                            ];                
                            try {
                                $blobService->addBlobContainer($containerName);
                                $blobService->setBlobContainerAcl($containerName, AzureBlobService::ACL_BLOB);
                            } catch (ServiceException $serviceException) {
                                     
                            }
                            try {
                                $fileName = $blobService->uploadBlob($containerName,  $archivo['archivos']);
                            } catch (ServiceException $serviceException) {
                                     
                            }
                        }
                    }

                    $notaArchivoValidar = addNote($notaArchivo, $idLead, $token, $dominio);
                    if(!$notaArchivoValidar){
                        $_SESSION['erroCRM'] = 'Error al enviarse información (archivos)';
                        header('location: formCRM.php');              
                    }

                } 
            } else{
                $_SESSION['erroCRM'] = 'Error al enviarse información 2';
                header('location: formCRM.php');        
            }
            
        }else{    
            $_SESSION['erroCRM'] = 'Error al enviarse información 3';
            header('location: formCRM.php');
        }
        $_SESSION['datosCRM'] = [   'nombre'=> $_POST['nombre'],
                                    'correoElectronico'=> $_POST['correoElectronico'],
                                    'telefono'=> $_POST['telefono'],
                                    'titulo'=> $_POST['titulo'],
                                    'dinero'=> $_POST['dinero'],
                                    'nota' => $nota];
        if(!isset($_SESSION['erroCRM'])){
            $_SESSION['exitoCRM'] = 'Información enviado con Exito al CRM';
        }
        
        header('location: formCRM.php');
    }else{
        $_SESSION['erroCRM'] = 'Error al enviarse información 4';
        header('location: formCRM.php');
    }
?>
