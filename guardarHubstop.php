<?php 
include('includes/conexion.php');
include('includes/funciones.php');
session_start();
$parametros = seleccionarParametrosCRM($_SESSION['usuario']['UsuarioID']);
    foreach($parametros as $parametro){
        foreach($parametro as $p){
            if($p == 'Token Hubspot'){
                $token = $parametro['ValorParametroCRM'];
            }   
        }
    } 
if(isset($_POST['checkContactoExistente'])){
    if(llaveDefinida('dinero', $_POST) && llaveDefinida('titulo', $_POST)){
        addDealHubspot($token, $_POST['titulo'], $_POST['dinero']);
        if(isset($_SESSION['exitoCRM'])){
            unset($_SESSION['exitoCRM']); 
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
            addDealHubspotContacto($token, $idContacto, $_POST['titulo'], $_POST['dinero']);
            $_SESSION['datosCRM'] = [   'nombre' =>$_POST['nombre'],
                                        'apellido' =>$_POST['apellido'],
                                        'correoElectronico'=> $_POST['correoElectronico'],
                                        'telefono'=> $_POST['telefono'],
                                        'titulo'=> $_POST['titulo'],
                                        'dinero'=> $_POST['dinero']];
            $_SESSION['exitoCRM'] = 'Información enviado con Exito al CRM';
            header('location: formCRM.php');                
        }
    }
   
}

?>
