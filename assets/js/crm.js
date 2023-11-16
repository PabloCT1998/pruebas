	// Obtén referencias a los elementos del DOM
    const pipedriveRadio = document.getElementById('pipedrive');
    const hubspotRadio = document.getElementById('hubspot');
    const dominioInput = document.getElementById('dominio');
    
    // Agrega un event listener a los campos de radio
    pipedriveRadio.addEventListener('change', function() {
        if (pipedriveRadio.checked) {
            dominioInput.disabled = false; // Habilita el campo de dominio si se selecciona Pipedrive
        }
    });
    
    hubspotRadio.addEventListener('change', function() {
        if (hubspotRadio.checked) {
            dominioInput.disabled = true; // Deshabilita el campo de dominio si se selecciona Hubspot
        }
    });
    