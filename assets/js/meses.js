
$(document).ready(function() {
    // Escuchar el cambio en cualquier radio button de tarifa
    $('input[name="tarifa"]').change(function() {
        // Habilitar todos los campos de entrada de meses
        $("input[name^='mes']").prop('disabled', false);

        var selectedTarifa = $("input[name='tarifa']:checked").val();
        
        // Comprobar si la tarifa seleccionada es 1 o 2
        if (selectedTarifa === "1" || selectedTarifa === "2") {
            // Deshabilitar los campos de meses impares
            $("input[name='mes1'], input[name='mes3'], input[name='mes5'], input[name='mes7'], input[name='mes9'], input[name='mes11']").prop('disabled', true);
        }
    });
});