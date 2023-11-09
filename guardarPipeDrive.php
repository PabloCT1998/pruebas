<?php
    include('includes/conexion.php');
    include('includes/funciones.php');
    require('vendor/autoload.php');
    use MicrosoftAzure\Storage\Blob\BlobRestProxy;
    use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
    
    session_start();
    $fechaCreacion =date("d-m-Y-h-i-s");
    $connectionString ='DefaultEndpointsProtocol=https;AccountName=azsolar;AccountKey=s1x0MhH7ErO+KCUzv1xImFcGbzfwO+ewifWmzaN43d6C/zqfO8LSOOCFNrTE10J31/pD5CQuIfuD+ASt68bhyA==;EndpointSuffix=core.windows.net';
    $blobClient = BlobRestProxy::createBlobService($connectionString);
    $containerName = 'azsolar';
    $parametros = seleccionarParametroPipedrive($_SESSION['usuario']['UsuarioID']);
    foreach($parametros as $parametro){
        foreach($parametro as $p){
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
    if(($token != null || $token != '') && ($dominio != null || $token != '') && llaveDefinida('nombre', $_POST) && llaveDefinida('correoElectronico', $_POST) && llaveDefinida('telefono', $_POST) && llaveDefinida('titulo', $_POST) && llaveDefinida('dinero', $_POST)){
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
                }
                if ($_FILES['archivos']['error'][0] != UPLOAD_ERR_NO_FILE) {
                    $archivos = $_FILES['archivos'];
                    foreach($archivos['tmp_name'] as $key => $tmp_name){
                        if ($archivos['error'][$key] === UPLOAD_ERR_OK) {
                            $archivoTmp = $archivos['tmp_name'][$key];
                            $nombreOrigianlConExrension = $archivos['name'][$key];
                            $extension = pathinfo($nombreOrigianlConExrension, PATHINFO_EXTENSION);
                            $guid = getGUID();
                            $nombreUnicoExtension = $fechaCreacion .'-'. $guid .'.'.$extension;
                            $archivos["name"][$key] =  $nombreUnicoExtension ; 
                            // Nombres de archivos de temporales
                            $ruta = "$nombreUnicoExtension";
                            $rutaAzure = 'https://azsolar.blob.core.windows.net/azsolar/' .  $nombreUnicoExtension;
                            $notaArchivo = $notaArchivo. '<br><a href="'.$rutaAzure.'">'.$nombreOrigianlConExrension .'</a>' ;                            
                            try {
                                $blobClient->createBlockBlob($containerName, $ruta, fopen($archivoTmp, "r"));
                            } catch (ServiceException $e) {
                                $_SESSION['erroCRM'] = 'Error al enviarse información (archivos)';
                                header('location: formCRM.php');              
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
                $_SESSION['erroCRM'] = 'Error al enviarse información';
                header('location: formCRM.php');        
            }
            
        }else{    
            $_SESSION['erroCRM'] = 'Error al enviarse información';
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
