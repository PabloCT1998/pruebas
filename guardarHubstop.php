<?php 
include('includes/conexion.php');
include('includes/funciones.php');
session_start();
$fechaCreacion =date("d-m-Y-h-i-s");
$parametros = seleccionarParametrosCRM($_SESSION['usuario']['UsuarioID']);

    foreach($parametros as $parametro){
        foreach($parametro as $p){
            if($p == 'Token Hubspot'){
                $token = $parametro['ValorParametroCRM'];
            }   
        }
    } 
    $dinero = str_replace(",", "", $_POST['dinero']);
if(isset($_POST['checkContactoExistente'])){
    if(llaveDefinida('dinero', $_POST) && llaveDefinida('titulo', $_POST)){
        addDealHubspot($token, $_POST['titulo'], $dinero);
        if(isset($_SESSION['exitoCRM'])){
            unset($_SESSION['exitoCRM']); 
        }
        $validar = enviarArchivoHubspot($_SESSION['archivosCRM']['resumenEjecutivo'], $token, $fechaCreacion.'Resumen Ejecutivo.pdf');
            if($validar != 1){
                $_SESSION['erroCRM'] = 'Error: Falla an enviarse información';
                header('location: formCRM.php');  
            }
            $validar = enviarArchivoHubspot($_SESSION['archivosCRM']['resumenFinanciero'], $token, $fechaCreacion.'Resumen Financiero.pdf');
            if($validar != 1){
                $_SESSION['erroCRM'] = 'Error: Falla an enviarse información';
                header('location: formCRM.php');  
            }
        $_SESSION['exitoCRM'] = 'Información enviado con Exito al CRM';
        $_SESSION['datosCRM'] = [   'titulo'=> $_POST['titulo'],
                                    'dinero'=> $_POST['dinero'],
                                    'checkContactoExistente' => true];
        header('location: formCRM.php');                
    }else{
        $_SESSION['erroCRM'] = 'Error al enviarse información';
        header('location: formCRM.php');                
    }
 }else{
    if(llaveDefinida('dinero', $_POST) && llaveDefinida('titulo', $_POST) && llaveDefinida('nombre', $_POST) 
        && llaveDefinida('apellido', $_POST) && llaveDefinida('correoElectronico', $_POST) && llaveDefinida('telefono', $_POST)){
        $idContacto = addContactHubspot($token, $_POST['correoElectronico'], $_POST['telefono'], $_POST['nombre'], $_POST['apellido']);
        
        if($idContacto === 0){
            $_SESSION['erroCRM'] = 'Error: El contacto ya existe';
            header('location: formCRM.php');                
        }else{
            addDealHubspotContacto($token, $idContacto, $_POST['titulo'], $dinero);
            $_SESSION['datosCRM'] = [   'nombre' =>$_POST['nombre'],
                                        'apellido' =>$_POST['apellido'],
                                        'correoElectronico'=> $_POST['correoElectronico'],
                                        'telefono'=> $_POST['telefono'],
                                        'titulo'=> $_POST['titulo'],
                                        'dinero'=> $_POST['dinero']];

            $validar = enviarArchivoHubspot($_SESSION['archivosCRM']['resumenEjecutivo'], $token, $fechaCreacion.'Resumen Ejecutivo.pdf');
            if($validar != 1){
                $_SESSION['erroCRM'] = 'Error: Falla an enviarse información';
                header('location: formCRM.php');  
            }
            $validar = enviarArchivoHubspot($_SESSION['archivosCRM']['resumenFinanciero'], $token, $fechaCreacion.'Resumen Financiero.pdf');
            if($validar != 1){
                $_SESSION['erroCRM'] = 'Error: Falla an enviarse información';
                header('location: formCRM.php');  
            }
            $_SESSION['exitoCRM'] = 'Información enviado con Exito al CRM';
            header('location: formCRM.php');                
        }
    }
   
}

?>
