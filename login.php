<?php 

require_once 'includes/conexion.php';
require_once 'includes/funciones.php';

    $usuario = $_POST['user'];
    $password = $_POST['password'];
    session_start();
    // $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);	
    if(llaveDefinida('user', $_POST) && llaveDefinida('password', $_POST)){
        try {
            $solar = new SolarDB ();
	        $conexion = $solar->connect();
            $result = $conexion->prepare('SELECT * FROM Usuario WHERE Usuario = ?');
            $result->execute([$usuario]);
            $datos = $result->fetchAll(PDO::FETCH_ASSOC);
            if(count($datos) == 1){
                if(password_verify($password, $datos[0]['Pwd'])){
                    $info = [
                        'UsuarioID' => $datos[0]['UsuarioID'], 
                        'Usuario' => $datos[0]['Usuario'],
                        'NombreCompleto' => $datos[0]['NombreCompleto'],
                        'CorreoUsuario' => $datos[0]['CorreoUsuario'],
                        'TipoUsuario' => $datos[0]['TipoUsuario']];
                    $_SESSION['usuario'] = $info;
                    header('location: index.php');
                }else{
                    header('location: LoginUser.php');
                    $_SESSION['error'] = 'Usuario o contraseña Incorrecto';
                }  
            } else{
                header('location: LoginUser.php');
                $_SESSION['error'] = 'Usuario o contraseña Incorrecto';

            }        
        } catch (Exception $e) {
          if ($conexion->inTransaction()) { $conexion->rollBack(); }
          $response = array('replyCode' => 400, 'replyText' => 'Error: ' . $e->getMessage());
        }
    }
?>