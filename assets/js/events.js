$(document).ready(function () { 
    var tablaCeldas = $('#tablaCeldas').DataTable();
    var tablaInversor = $('#tablaInversor').DataTable();
    
    function guardarSeleccionInversor() {
      var selectedInversor = $('input[name="inversor"]:checked').val();
      $('#inversorSeleccionado').val(selectedInversor);
      console.log("Valor seleccionado en el input invisible: " + selectedInversor);
    }

    function guardarSeleccionPanel() {
        var selectedPanel = $('input[name="panel"]:checked').val();
        $('#panelSeleccionado').val(selectedPanel);
    
      }

      function guardarSeleccionCombiBox() {
        var selectedCombiBox = $('input[name="combiBox"]:checked').val();
        $('#combiBoxSeleccionado').val(selectedCombiBox);
        console.log("Valor seleccionado en el input invisible: " + selectedCombiBox);
      }
  
  
    // Guardar la selección del input tipo "radio" al elegirlo en la tabla de inversores
    $('#tablaInversor').on('click', 'input[name="inversor"]', function() {
      guardarSeleccionInversor();
    });

    // Guardar la selección del input tipo "radio" al elegirlo en la tabla de celdas
    $('#tablaCeldas').on('click', 'input[name="panel"]', function() {
        guardarSeleccionPanel();
      });
  

    // Restaurar la selección del input tipo "radio" al cambiar de página en la tabla de inversores
    tablaInversor.on('draw.dt', function () {
      var selectedValue = $('#inversorSeleccionado').val();
      if (selectedValue !== "0") {
        $('input[name="inversor"][value="' + selectedValue + '"]').prop('checked', true);
        $('input[name="inversor"]').removeAttr('required');
      }
      console.log("Valor guardado en el input invisible: " + selectedValue);

      $('input[name="inversor"]').each(function () {
        if ($(this).val() !== selectedValue) {
          $(this).prop('checked', false);
        }
      });
  
    });
    
    // Restaurar la selección del input tipo "radio" al cambiar de página en la tabla de celdas
    tablaCeldas.on('draw.dt', function () {
        var selectedValue = $('#panelSeleccionado').val();
        if (selectedValue !== "0") {
          $('input[name="panel"][value="' + selectedValue + '"]').prop('checked', true);
          $('input[name="panel"]').removeAttr('required');
        }
        
        $('input[name="panel"]').each(function () {
          if ($(this).val() !== selectedValue) {
            $(this).prop('checked', false);
          }
        });
    
    });
  });