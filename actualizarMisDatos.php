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
  if(llaveDefinida('nombreCompleto', $_POST) && llaveDefinida('usuario', $_POST) && llaveDefinida('email', $_POST)){
    $nombreCompleto = $_POST['nombreCompleto'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $validarUsuario = buscarUsuario($usuario);
    if($usuario != $_SESSION['usuario']['Usuario']){
        if( count($validarUsuario) > 0){
            echo 11;
            $errores['usuario'] = 'El usuario '.$usuario. ' ya existe';
        }
    }

    if(llaveDefinida('passwordViejo', $_POST) && llaveDefinida('passwordNuevo', $_POST)){
        $passwordViejo = $_POST['passwordViejo'];
        $passwordNuevo = $_POST['passwordNuevo'];

        $password = seleccionarUsuario($_SESSION['usuario']['UsuarioID']);
        if(password_verify($passwordViejo, $password[0]['Pwd'])){
            $password_segura = password_hash($passwordNuevo, PASSWORD_BCRYPT, ['cost'=>12]);
            $passwordValido = true;
        }else{
            $errores['password'] = "El password Actual no es correcto";
            $passwordValido = false;
        }
    }else{
        $passwordValido = false;
    }
    if(!empty($nombreCompleto) && !is_numeric($nombreCompleto) && !preg_match("/[0-9]/", $nombreCompleto)){
		$nombre_validado = true;
	}else{
		$nombre_validado = false;
		$errores['nombre'] = "El nombre no es válido";
	}
    if(count($errores) > 0){
        $_SESSION['erroresMisDatos'] = $errores;
        header('location: misDatos.php');
    }else{
        if(isset($_SESSION['erroresMisDatos'])){
            unset($_SESSION['erroresMisDatos']);
        }
    }
    if(count($errores) == 0){
        try {
            $vars = [$nombreCompleto, $usuario, $email];
            $query = 'UPDATE Usuario SET NombreCompleto = ?, Usuario = ?, CorreoUsuario = ?';
            if($passwordValido){
                $query = $query .= ' ,PWD = ?';
                array_push($vars, $password_segura);
        
            }
        
            $query = $query .= ' WHERE UsuarioID = ?;';
            array_push($vars, $_SESSION['usuario']['UsuarioID']);
            $result = $conexion->prepare($query);
            $result->execute($vars);
            $conexion->commit();
            $datos = seleccionarUsuario($_SESSION['usuario']['UsuarioID']);
            $info = [
                'UsuarioID' => $datos[0]['UsuarioID'], 
                'Usuario' => $datos[0]['Usuario'],
                'NombreCompleto' => $datos[0]['NombreCompleto'],
                'CorreoUsuario' => $datos[0]['CorreoUsuario'],
                'TipoUsuario' => $datos[0]['TipoUsuario']];
            $_SESSION['usuario'] = $info;
            $_SESSION['exito'] = 'Éxito en la Actualización';
            header("Location: misDatos.php");
            } catch (Exception $e) {
                if ($conexion->inTransaction()) { $conexion->rollBack(); }
                    $response = array('replyCode' => 400, 'replyText' => 'Error: ' . $solar->getMessage());
            }
    }
  }
  
?>