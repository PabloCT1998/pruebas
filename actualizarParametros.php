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
  if(llaveDefinida('utilidad', $_POST) || llaveDefinida('comision', $_POST) || llaveDefinida('dollar', $_POST) || llaveDefinida('crm', $_POST) || llaveDefinida('dominio', $_POST) || llaveDefinida('token', $_POST)){
    try {
        $query = 'UPDATE Parametro SET ValorParametro = ? WHERE UsuarioID = ? AND DescParametro = ?';
        $result = $conexion->prepare($query);
        
        if(llaveDefinida('utilidad', $_POST)){
            $result->execute([$_POST['utilidad'], $_SESSION['usuario']['UsuarioID'], 'Utilidad']);
        }

        if(llaveDefinida('comision', $_POST)){
            $result->execute([$_POST['comision'], $_SESSION['usuario']['UsuarioID'], 'Comisión Vendedor']);

        }
        if(llaveDefinida('dollar', $_POST)){
            $result->execute([$_POST['dollar'], $_SESSION['usuario']['UsuarioID'], 'Dollar']);
        }

        if(llaveDefinida('crm', $_POST)){
            ($_POST['crm']) ? $_POST['crm'] = 0 : $_POST['crm'] = 1;
            $result->execute([$_POST['crm'], $_SESSION['usuario']['UsuarioID'], 'Pipedrive Activo']);
        }

        if(llaveDefinida('dominio', $_POST)){
            $result->execute([$_POST['dominio'], $_SESSION['usuario']['UsuarioID'], 'Dominio Pipedrive']);
        }

        if(llaveDefinida('token', $_POST)){
            $result->execute([$_POST['token'], $_SESSION['usuario']['UsuarioID'], 'Token Pipedrive']);
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