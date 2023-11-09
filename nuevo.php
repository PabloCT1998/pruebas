<?php 
  session_start();
  $_SESSION['etapa'] = 0;
  header("Location: consumo_1.php");
  unset($_SESSION['validarConsumo1'], $_SESSION['numPiezas'], $_SESSION['panel'], $_SESSION['consumo'], $_SESSION['consumoAnual'],
        $_SESSION['consumoMeses'], $_SESSION['input1'], $_SESSION['potencia'], $_SESSION['energiaSolarMeses'],
        $_SESSION['porcentaje'], $_SESSION['checkKit'], $_SESSION['input2'], $_SESSION['precios'],
        $_SESSION['valorDollar'], $_SESSION['areaNecesaria'], $_SESSION['cpEntrega'], $_SESSION['utilidadGeneral'],
        $_SESSION['total'], $_SESSION['watssInstalados'], $_SESSION['almacen'], $_SESSION['fechaActual'],  $_SESSION['comisionVendedor'],
        $_SESSION['kwNecesarios'], $_SESSION['inversor'], $_SESSION['datosCRM']
  );
?>