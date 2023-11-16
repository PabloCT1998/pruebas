<?php
require_once __DIR__ . '/vendor/autoload.php';
use HubSpot\Factory;
use HubSpot\Client\Crm\Contacts\ApiException;



function verContactos($token){
    $hubspot = \HubSpot\Factory::createWithAccessToken($token);
 $response = $hubspot->crm()->contacts()->basicApi()->getPage();
 
 $data = json_decode($response, true);
 
 $resultados = [];
 
 // Iterar a través de los resultados y seleccionar los datos requeridos
 foreach ($data['results'] as $resultado) {
     $id = $resultado['id'];
     $firstname = $resultado['properties']['firstname'];
     $lastname = $resultado['properties']['lastname'];
 
     
 
     // Agregar los datos seleccionados al array de resultados
     $fullName = $firstname . ' ' . $lastname;
 
     // Agregar los datos seleccionados al array de resultados
     $resultados[] = array('id' => $id, 'fullName' => $fullName);
 
 }
 
 // Imprimir los resultados
 return json_encode($resultados);
 
}




?>

