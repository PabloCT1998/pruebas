<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include('includes/conexion.php');
include('includes/funciones.php');
session_start();
if (!definido($_SESSION['usuario'])) {
    header('location: LoginUser.php');
}
$parametros = seleccionarParametroCRMActivo($_SESSION['usuario']['UsuarioID']);
$crm = $parametros[0]['ValorParametroCRM'];
$mesesConsumo = [];
if(llaveDefinida('input1', $_SESSION) && llaveDefinida('input2', $_SESSION)&& llaveDefinida('consumoMeses', $_SESSION) && llaveDefinida('energiaSolarMeses', $_SESSION) && $_SESSION['etapa'] == 4){
    
    if($_SESSION['utilidadGeneral'] >= 10){
        $utilidad = (float)('0.'. $_SESSION['utilidadGeneral']);
    }else{
        $utilidad = (float)('0.0'. $_SESSION['utilidadGeneral']);
    }

    if($_SESSION['comisionVendedor'] >= 10){
        $numComision = (float)('0.'. $_SESSION['comisionVendedor']);
    }else{
        $numComision = (float)('0.0'. $_SESSION['comisionVendedor']);
    }

    // Valor del Dolar
    $dollar = $_SESSION['valorDollar'];
    //comisión
   // $numComision = (float)('0.0'. $_SESSION['comisionVendedor']);
    
    //Dolares 
    $totalDollar = $_SESSION['total']; //TotlaDolar

    //$utilidad = (float)('0.'. $_SESSION['utilidadGeneral']);


    //Pesos
    $importePesos = $totalDollar * $dollar;
    $ivaPesos = $importePesos * 0.16;
    $totalPesos = $importePesos + $ivaPesos;
    $importeUtilidadPesos = $importePesos / (1 - $utilidad);
    //$subTotal = $importeUtilidadPesos - $comisionUtilidad;
    $ivaUtilidad = $importeUtilidadPesos * 0.16;
    $totalUtilidad = $importeUtilidadPesos + $ivaUtilidad;
    $comisionUtilidad = $importeUtilidadPesos * $numComision;
    $utilidadSinIVA = $importeUtilidadPesos - $importePesos;

    $_SESSION['precioVenta'] = $totalUtilidad;
    $costoWatInstalado = $_SESSION['total'] / $_SESSION['kwNecesarios'] /1000;
}else{
    header("Location: index.php");
}
echo 1;
?>

<!DOCTYPE html>
<html lang="es">
    <?php require_once 'includes/header.php';?>
	<body>
        <div class="no-imprimir">
        <?php require_once 'includes/nav.php';?>
        </div>
		<div class="container">
            <?php require_once 'includes/tituloCotizar.php';?>
			<h3 class="text-center  text-muted">RESUMEN FINANCIERO</h3>
            <div class="row  justify-content-end">
                <div class="col-auto"> 
                    <div class="d-flex">
                        <button class="btn text-light no-imprimir bg-danger"  id="botonpdf" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                            </svg>    
                            Convertir a PDF
                        </button>
                    </div>
                </div>
                <?php if($crm){?>
                <div class="col-auto"> 
                    <div class="d-flex">
                        <a href="formCRM.php" class="btn text-light  no-imprimir bg-success" >  
                            Enviar Información al CRM
                        </a>
                    </div>
                </div>
                <?php }?>
            </div>
                <br>
				<p>PRECIO: &nbsp;&nbsp;&nbsp; DIFERENTES MONEDAS UTILIZANDO EL DÓLAR COMO BASE</p>
                <p id="comisionPorcentaje">COMISIÓN DEL VENDEDOR: &nbsp;&nbsp;&nbsp; <?php echo $_SESSION['comisionVendedor']; ?>%</p>
                <p id="valorDollar">TIPO DE CAMBIO DÓLAR: $<?php echo number_format($_SESSION['valorDollar'], 2, '.', ',');?></p>
                <p id="wattInstalacion">COSTO POR WATT INSTALADO: $<?php echo number_format($costoWatInstalado, 2, '.', ',');?></p>
                <p id="utilidadGenearl">UTILIDAD: <?php echo  $_SESSION['utilidadGeneral'];?>%</p>
                <div class="table-responsive">
                    <table id="tablaFinanciera">
                    <thead>
          				<tr>
							<th class="text-end"></th>
                            <th>&nbsp;&nbsp;&nbsp;</th>
                            <th class="text-end">COSTO</th>
                            <th>&nbsp;&nbsp;&nbsp;</th>
							<th class="text-end ">PRECIO DE VENTA</th>
                            <th>&nbsp;&nbsp;&nbsp;</th>
                            <th class="text-end">UTILIDAD</th>
          				</tr>
                        <tbody>
                            <tr>
                                <td>IMPORTE</td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td id="importePesos" class="text-end">$<?php echo number_format($importePesos, 2, '.', ',');?></td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                               <td id="importeUtilidadPesos" class="text-end">$<?php echo number_format($importeUtilidadPesos, 2, '.', ',');?></td>
                               <td>&nbsp;&nbsp;&nbsp;</td>
                               <td id="utilidadSinIVA" class="text-end">$<?php echo number_format($utilidadSinIVA, 2, '.', ',');?></td>
                            </tr>
                            <tr>
                                <td>IVA</td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td id="ivaPesos" class="text-end">$<?php echo number_format($ivaPesos, 2, '.', ',');?></td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td id="ivaUtilidad" class="text-end">$<?php echo number_format($ivaUtilidad, 2, '.', ',');?></td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr>
                                <td>TOTAL</td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td id="totalPesos" class="text-end">$<?php echo number_format($totalPesos, 2, '.', ',');?></td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td id="totalUtilidad" class="text-end">$<?php echo number_format($totalUtilidad , 2, '.', ',');?></td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <p id="comisionVendedor">COMISIÓN DEL VENDEDOR: $<?php echo number_format($comisionUtilidad, 2, '.', ',');?></p>
                </div>
                <a class=" btn btn-success mb-3 no-imprimir" href="resumenEjecutivo.php">
                    <?php require_once 'includes/botonRegresar.php';?>
                </a>
		    </div>
        </div>

    </body>
    <?php require_once 'includes/footer.php';?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.12/jspdf.plugin.autotable.min.js"></script>
    <script src="assets/js/crearpdf.js" defer></script>
</html>
