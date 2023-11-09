<?php
  /**
   * Autor: Pablo Castañeda Trinidad
   * Fecha de creación: 16/05/2023
   * Descripción: Funciones para la aplicacionón
   */
  include __DIR__ . '../../vendor/autoload.php';
  use HubSpot\Factory;
  use HubSpot\Client\Crm\Contacts\ApiException;
  use HubSpot\Client\Crm\Contacts\Model\BatchInputSimplePublicObjectInputForCreate;
  use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInputForCreate;
  use HubSpot\Client\Crm\Deals\ApiException as DealsApiException;
  use HubSpot\Client\Crm\Deals\Model\AssociationSpec;
  use HubSpot\Client\Crm\Deals\Model\PublicAssociationsForObject;
  use HubSpot\Client\Crm\Deals\Model\PublicObjectId;
  use HubSpot\Client\Crm\Deals\Model\SimplePublicObjectInputForCreate as DealsSimplePublicObjectInputForCreate;


   /**
   * Verifica si una variable está definida y contiene un valor distinto a nulo ó vacío
   * @param any $value
   * @return boolean
  */
   function definido($value) {
    return (isset($value) && $value !== '');
  }
  /**
   * Verifica si llave está definida dentro de un array u objeto y si contiene un valor distinto a nulo ó vacío
   * @param any $key
   * @param array $array
   * @return boolean
  */
  function llaveDefinida($key, $array) {
    return array_key_exists($key, $array) && definido($array[$key]);
  }

  function seleccionarEstados(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT EstadoID, DescEstado FROM Estado');
    $result->execute();
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarRegiones(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT RegionID, NombreRegion FROM Region');
    $result->execute();
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarCiudades(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT CiudadID, DescCiudad FROM Ciudad');
    $result->execute();
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }
  function seleccionarCiudadesPorEstado($estadoID){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT CiudadID, DescCiudad FROM Ciudad WHERE EstadoID =?');
    $result->execute([$estadoID]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarTarifas(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT TarifaID, NombreTarifa FROM Tarifa');
    $result->execute();
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }  
  function seleccionarFotoceldasPorPortencia(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT m.DescMarca, p.Potencia, tp.DescTipoProducto, m.MarcaID
                                      FROM Producto p
                                      JOIN Marca m ON p.MarcaID = m.MarcaID
                                      JOIN TipoProducto tp ON tp.TipoProductoID = p.TipoProductoID
                                      WHERE p.TipoProductoID = ? 
                                      GROUP BY p.Potencia, m.DescMarca, tp.DescTipoProducto, m.MarcaID
    ');
    $result->execute([1]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarCombiBox(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT m.DescMarca, m.DescMarca, p.Modelo, p.Precio
                                      FROM Producto p
                                      JOIN Marca m ON p.MarcaID = m.MarcaID
                                      JOIN TipoProducto tp ON tp.TipoProductoID = p.TipoProductoID
                                      WHERE p.TipoProductoID = ?;');
    $result->execute([4]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarKit($idMarca){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT m.DescMarca, m.DescMarca, p.Modelo, p.Precio, ProductoID
                                      FROM Producto p
                                      JOIN Marca m ON p.MarcaID = m.MarcaID
                                      JOIN TipoProducto tp ON tp.TipoProductoID = p.TipoProductoID
                                      WHERE p.TipoProductoID = ? AND p.MarcaID = ?;');
    $result->execute([8, $idMarca]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarConectoresMC4(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT m.DescMarca, m.DescMarca, p.Modelo, p.Precio, p.ProductoID 
                                      FROM Producto p
                                      JOIN Marca m ON p.MarcaID = m.MarcaID
                                      JOIN TipoProducto tp ON tp.TipoProductoID = p.TipoProductoID
                                      WHERE p.TipoProductoID = ?;');
    $result->execute([5]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }
  function seleccionarFotoceldasxAlmacen($idProdcuto){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT pa.ProductoXAlmacenID, p.ProductoID, m.DescMarca, p.Modelo, p.Potencia, c.DescCiudad, a.DescAlmacen , pa.NumeroProductos, p.Eficiencia, d.DescDisponibilidad, pa.DisponibilidadID
                                  FROM Producto p
                                  JOIN Marca m ON p.MarcaID = m.MarcaID
                                  JOIN  ProductoXAlmacen pa ON pa.ProductoID = p.ProductoID
                                  JOIN  Almacen a ON a.almacenID = pa.almacenID
                                  JOIN  Ciudad c ON a.CiudadID = c.CiudadID
                                  JOIN Disponibilidad d ON pa.DisponibilidadID = d.DisponibilidadID
                                  WHERE p.ProductoID = ?
                                  ORDER BY c.DescCiudad;');
    $result->execute([$idProdcuto]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarFotoceldaxAlmacen($idProductoXAlmacen){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT pa.ProductoXAlmacenID, m.DescMarca, p.Modelo, p.Potencia, c.DescCiudad, a.DescAlmacen , p.Eficiencia, pa.DisponibilidadID, d.DescDisponibilidad
                                  FROM ProductoXAlmacen pa
                                  JOIN  Producto p ON pa.ProductoID = p.ProductoID
                                  JOIN Marca m ON p.MarcaID = m.MarcaID
                                  JOIN  Almacen a ON a.almacenID = pa.almacenID
                                  JOIN  Ciudad c ON a.CiudadID = c.CiudadID
                                  JOIN Disponibilidad d ON pa.DisponibilidadID = d.DisponibilidadID
                                  WHERE pa.ProductoXAlmacenID = ?');
    $result->execute([$idProductoXAlmacen]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarKitxAlmacen($idProdcuto){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT TOP 1 pa.ProductoXAlmacenID, p.DescProducto, p.ProductoID, m.DescMarca, p.Modelo, p.Potencia, c.DescCiudad, a.DescAlmacen , pa.NumeroProductos, p.Eficiencia, pa.Disponibilidad
                                  FROM Producto p
                                  JOIN Marca m ON p.MarcaID = m.MarcaID
                                  JOIN  ProductoXAlmacen pa ON pa.ProductoID = p.ProductoID
                                  JOIN  Almacen a ON a.almacenID = pa.almacenID
                                  JOIN  Ciudad c ON a.CiudadID = c.CiudadID
                                  WHERE p.ProductoID = ?
                                  ORDER BY c.DescCiudad;');
    $result->execute([$idProdcuto]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }
  function seleccionarProducto($idProdcuto){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT ProductoID, Potencia, Eficiencia, Precio, Dimensiones, MarcaID
                                  FROM Producto 
                                  WHERE  ProductoID = ?');
    $result->execute([$idProdcuto]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }
  
  function seleccionarFotoceldas( $potencia, $idMarca){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT ProductoID, Potencia, Precio, Dimensiones, Modelo
                                  FROM Producto 
                                  WHERE  MarcaID = ? AND Potencia = ?');
    $result->execute([$idMarca, $potencia]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  
  function seleccionarInversores($Eficiencia, $idMarca){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT ProductoID, Eficiencia, Precio, Dimensiones, Modelo
                                  FROM Producto 
                                  WHERE  MarcaID = ? AND Eficiencia = ?');
    $result->execute([$idMarca, $Eficiencia]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarEnergiaSolar($idCiudad){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre
                                  FROM EnergiaSolar
                                  WHERE CiudadID = ?');
    $result->execute([$idCiudad]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }  

  function seleccionarInversoresPorEficiencia(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT m.DescMarca, p.Eficiencia, tp.DescTipoProducto, m.MarcaID
                                  FROM Producto p
                                  JOIN Marca m ON p.MarcaID = m.MarcaID
                                  JOIN TipoProducto tp ON tp.TipoProductoID = p.TipoProductoID
                                  WHERE p.TipoProductoID = ? OR p.TipoProductoID = ?
                                  GROUP BY p.Eficiencia, m.DescMarca, tp.DescTipoProducto, m.MarcaID
    ');
    $result->execute([2,3]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  } 


  function seleccionarAlmacenes(){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT a.AlmacenID, a.DescAlmacen , c.DescCiudad FROM Almacen a JOIN Ciudad c ON a.CiudadID = c.CiudadID');
    $result->execute();
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  } 

  function seleccionarProductos($idProdcuto){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('  SELECT m.DescMarca, t.DescTipoProducto, p.Modelo, p.Precio, p.DescProducto, p.ProductoID
                                    FROM Producto p
                                    JOIN Marca m ON m.MarcaID = p.MarcaID
                                    JOIN TipoProducto t ON t.TipoProductoID = p.TipoProductoID
                                    WHERE p.TipoProductoID = ?');
    $result->execute([$idProdcuto]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  } 

  function seleccionarInversor($idInversor){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT ProductoID, PrecioID, MarcaID 
                                  FROM Producto
                                  WHERE ProductoID = ?;');
    $result->execute([$idInversor]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  } 

  function seleccionarParametros($UsuarioID){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('  SELECT DescParametro, ValorParametro
                                    FROM Parametro
                                    WHERE UsuarioID = ?');
    $result->execute([$UsuarioID]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  
  function seleccionarParametrosCRM($UsuarioID){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT DescParametroCRM, ValorParametroCRM 
                                  FROM ParametroCRM
                                  WHERE UsuarioID = ?;');
    $result->execute([$UsuarioID]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarParametroCRMActivo($UsuarioID){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT DescParametroCRM, ValorParametroCRM 
                                  FROM ParametroCRM
                                  WHERE UsuarioID = ? 
                                  AND DescParametroCRM = ?;');
    $result->execute([$UsuarioID, 'CRM Activo']);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }
  

  function seleccionarParametrosCRM1($UsuarioID){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('SELECT DescParametro, ValorParametro 
                                  FROM Parametro
                                  WHERE UsuarioID = ? 
                                  AND DescParametro IN (?, ?, ?);');
    $result->execute([$UsuarioID, 'Pipedrive Activo', 'Token Pipedrive', 'Dominio Pipedrive']);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  function seleccionarUsuario($UsuarioID){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('  SELECT *
                                    FROM Usuario
                                    WHERE UsuarioID = ?');
    $result->execute([$UsuarioID]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }

  
  function buscarUsuario($Usuario){
    $soporte = new SolarDB ();
	  $conexion = $soporte->connect();
    $result = $conexion->prepare('  SELECT *
                                    FROM Usuario
                                    WHERE Usuario = ?');
    $result->execute([$Usuario]);
    $datos = $result->fetchAll(PDO::FETCH_ASSOC);
	  return $datos;
  }


function addPerson($nombre, $telefono, $correo, $token, $dominio){
    $data = array(
        'name' => $nombre,
        'phone' => $telefono,
        'email' => $correo
    );
    $url = 'https://' . $dominio . '.pipedrive.com/api/v1/persons?api_token=' . $token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $output = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($output, true);
    if (!empty($result['data']['id'])) {
        return $result['data']['id'];
    }else{
       return  0;
    }
}


  function addLeads($idPersona, $monto, $titulo, $token, $dominio){
   $dinero = array( 'amount'=> (float)$monto, 'currency'=> 'MXN');
   $data = json_encode(array( 'title' => $titulo, 
                               'person_id' => $idPersona,
                               'value' =>  $dinero,
                           ));
   

   $url = 'https://' . $dominio . '.pipedrive.com/api/v1/leads?api_token=' . $token;

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
   $output = curl_exec($ch);
   curl_close($ch);

   $result = json_decode($output, true);
   if (!empty($result['data']['id'])) {
     return $result['data']['id'];
     }else{
       $result = 0; 
     }
}


function addNote($contenido, $idLead , $token, $dominio){
  $data = array(  "content"=> $contenido,
                   "lead_id"=> $idLead);
  $url = 'https://' . $dominio . '.pipedrive.com/api/v1/notes?api_token=' . $token;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  $output = curl_exec($ch);
  curl_close($ch);
  $result = json_decode($output, true);
  if (!empty($result['data']['id'])) {
      return $result['data']['id'];
  }else{
      return "Fallo";
  }	
}



function addContactHubspot($token, $email, $phone, $nombre, $apellido){
  $hubspot = \HubSpot\Factory::createWithAccessToken($token);
  $contactInput = new \HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput();
  $contactInput->setProperties([
  'email' => $email,
  'phone' => $phone,
  'firstname' => $nombre,
  "lastname"=>$apellido
  ]);
    try {
        
      $contact = $hubspot->crm()->contacts()->basicApi()->create($contactInput);
      $data = json_decode($contact, true);
      return $id = $data['id'];    
  } catch (ApiException $e) {      
      return  0;
  }
   
}

function addDealHubspotContacto($token, $idContacto, $titulo, $dinero){
  $client = Factory::createWithAccessToken($token);

  $associationSpec1 = new AssociationSpec([
      'association_category' => 'HUBSPOT_DEFINED',
      'association_type_id' => 3
  ]);
  $to1 = new PublicObjectId([
      'id' => $idContacto
  ]);
  $publicAssociationsForObject1 = new PublicAssociationsForObject([
      'types' => [$associationSpec1],
      'to' => $to1
  ]);
  $properties1 = [
      'amount' => $dinero,
      'dealname' => $titulo,
      'pipeline' => 'default',
      'dealstage' => 'presentationscheduled',
  ];
  $simplePublicObjectInputForCreate = new DealsSimplePublicObjectInputForCreate([
      'associations' => [$publicAssociationsForObject1],
      'properties' => $properties1,
  ]);
  try {
      $apiResponse = $client->crm()->deals()->basicApi()->create($simplePublicObjectInputForCreate);

      return $apiResponse;
      $apiResponse = json_decode($apiResponse, true); // Convierte la respuesta JSON en un array asociativo
  
      // Accede al ID del negocio
      $dealId = $apiResponse['id'];
      
  
  } catch (ApiException $e) {
      echo "Exception when calling basic_api->create: ", $e->getMessage();
  }
}


function addDealHubspot($token, $titulo, $dinero){
  $client = Factory::createWithAccessToken($token);

  $properties1 = [
      'amount' => $dinero,
      'dealname' => $titulo,
      'pipeline' => 'default',
      'dealstage' => 'presentationscheduled',
  ];
  $simplePublicObjectInputForCreate = new DealsSimplePublicObjectInputForCreate([
      'properties' => $properties1,
  ]);
  try {
      $apiResponse = $client->crm()->deals()->basicApi()->create($simplePublicObjectInputForCreate);

      return $apiResponse;
      $apiResponse = json_decode($apiResponse, true); // Convierte la respuesta JSON en un array asociativo
  
    // Accede al ID del negocio
    $dealId = $apiResponse['id'];

  } catch (ApiException $e) {
      echo "Exception when calling basic_api->create: ", $e->getMessage();
  }
}


function getGUID(){
  if (function_exists('com_create_guid')){
      return com_create_guid();
  }
  else {
      mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
      $charid = strtoupper(md5(uniqid(rand(), true)));
      $hyphen = chr(45);// "-"
      $uuid = substr($charid, 0, 8).$hyphen
          .substr($charid, 8, 4).$hyphen
          .substr($charid,12, 4).$hyphen
          .substr($charid,16, 4).$hyphen
          .substr($charid,20,12);
      return $uuid;
  }
}
?>