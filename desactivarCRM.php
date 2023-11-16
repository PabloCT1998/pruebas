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
    try {
        $query = 'UPDATE ParametroCRM SET ValorParametroCRM = ? WHERE UsuarioID = ? AND DescParametroCRM = ?';
        $result = $conexion->prepare($query);
        
            $result->execute([0, $_SESSION['usuario']['UsuarioID'], 'CRM Activo']);
            $result->execute([0, $_SESSION['usuario']['UsuarioID'], 'Pipedrive Activo']);
            $result->execute([0, $_SESSION['usuario']['UsuarioID'], 'Hubspot Activo']);

        $conexion->commit();
        $_SESSION['exito'] = 'Éxito en la Actualización';
        header("Location: parametros.php");
    } catch (Exception $e) {
        if ($conexion->inTransaction()) { $conexion->rollBack(); }
        $_SESSION['errorParametro'] = 'Eror en la Actualización';
        $response = array('replyCode' => 400, 'replyText' => 'Error: ' . $solar->getMessage());
    }

  
  
?>