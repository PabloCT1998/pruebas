<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');

session_start();

if(llaveDefinida('ProductoXAlmacenID', $_POST) && llaveDefinida('cantidadAlmacen', $_POST)){
    $ids = $_POST['ProductoXAlmacenID'];
    $cantidad = $_POST['cantidadAlmacen'];
    $data = [];
    for($i = 0; $i < count($ids); $i++){
        $info = seleccionarFotoceldaxAlmacen($ids[$i]);
        $d = ['ProductoXAlmacenID' => $info[0]['ProductoXAlmacenID'],
                'DescMarca' => $info[0]['DescMarca'],
                'Modelo' => $info[0]['Modelo'], 
                'Potencia' => $info[0]['Potencia'], 
                'Eficiencia' => $info[0]['Eficiencia'], 
                'DescCiudad' => $info[0]['DescCiudad'], 
                'DescAlmacen' =>$info[0]['DescAlmacen'],
                'DescDisponibilidad' =>$info[0]['DescDisponibilidad'],
                'Numero'=> $cantidad[$i],
                'Index' => count($_SESSION['almacen']),
                'DisponibilidadID' => $info[0]['DisponibilidadID']
    ];

        if($_SESSION['checkKit'] ==  true){
            array_push($_SESSION['almacenKit'], $d);

        }else{
            array_push($_SESSION['almacen'], $d);

        }
    }
    // foreach($data as $d){
    //     array_push($_SESSION['almacen'], $d);
    // }

    $_SESSION['etapa'] == 3 ? $_SESSION['etapa'] = 4 : $_SESSION['etapa'] = $_SESSION['etapa'];
}

header("Location: almacen.php");

?>