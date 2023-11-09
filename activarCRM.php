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
  if(llaveDefinida('crm', $_POST) && llaveDefinida('token', $_POST)){
    try {
        $query = 'UPDATE ParametroCRM SET ValorParametroCRM = ? WHERE UsuarioID = ? AND DescParametroCRM = ?';
        $result = $conexion->prepare($query);
        
        if(llaveDefinida('crm', $_POST)){
            $result->execute([1, $_SESSION['usuario']['UsuarioID'], 'CRM Activo']);
        }

        if($_POST['crm'] == 'Piepedrive' && llaveDefinida('dominio', $_POST)){
            $result->execute([1, $_SESSION['usuario']['UsuarioID'], 'Pipedrive Activo']);
            $result->execute([$_POST['token'], $_SESSION['usuario']['UsuarioID'], 'Token Pipedrive']);
            $result->execute([$_POST['dominio'], $_SESSION['usuario']['UsuarioID'], 'Dominio Pipedrive']);

        }else if($_POST['crm'] == 'Hubspot'){
            $result->execute([1, $_SESSION['usuario']['UsuarioID'], 'Hubspot Activo']);
            $result->execute([$_POST['token'], $_SESSION['usuario']['UsuarioID'], 'Token Hubspot']);
        }
        $conexion->commit();
        $_SESSION['exito'] = 'Éxito en la Actualización';
        header("Location: parametros.php");
    } catch (Exception $e) {
        if ($conexion->inTransaction()) { $conexion->rollBack(); }
        $_SESSION['errorParametro'] = 'Eror en la Actualización';
        $response = array('replyCode' => 400, 'replyText' => 'Error: ' . $solar->getMessage());
    }
}
  
  
?>