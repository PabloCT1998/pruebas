<?php
header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: *");

  include('includes/conexion.php');
  include('includes/funciones.php');
  
  session_start();
  $errores = array();
  $solar = new SolarDB();
  $conexion = $solar->connect();
  $conexion->beginTransaction(); 
  if(llaveDefinida('crm', $_POST) || llaveDefinida('dominio', $_POST) || llaveDefinida('token', $_POST)){
    try {
        $query = 'UPDATE ParametroCRM SET ValorParametroCRM = ? WHERE UsuarioID = ? AND DescParametroCRM = ?';
        $result = $conexion->prepare($query);
        
        if(llaveDefinida('dominio', $_POST)){
            $result->execute([$_POST['dominio'], $_SESSION['usuario']['UsuarioID'], 'Dominio Pipedrive']);
        }

        if(llaveDefinida('token', $_POST) && $_POST['crm'] == 'Pipedrive'){
            $result->execute([$_POST['token'], $_SESSION['usuario']['UsuarioID'], 'Token Pipedrive']);
        }else if(llaveDefinida('token', $_POST) && $_POST['crm'] == 'Hubspot'){
            $result->execute([$_POST['token'], $_SESSION['usuario']['UsuarioID'], 'Token Hubspot']);
        }


        $conexion->commit();
        $_SESSION['exito'] = 'Éxito en la Actualización';
        header("Location: parametros.php");
    } catch (Exception $e) {
        if ($conexion->inTransaction()) { $conexion->rollBack(); }
        $_SESSION['errorParametro'] = 'Eror en la Actualización';
        header("Location: parametros.php");
        $response = array('replyCode' => 400, 'replyText' => 'Error: ' . $solar->getMessage());
    }
}
  
  
?>