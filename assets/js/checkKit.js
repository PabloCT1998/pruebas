var selectedCount = 0
function toggleKitFields() {
    var checkbox = document.getElementById('checkKit');
    var kitNumField = document.getElementById('kitNum');
    var kitPrecioField = document.getElementById('kitPrecio');
    var cablesNumField = document.getElementById('cablesNum');
    var cablesPrecioField = document.getElementById('cablesPrecio');
    var manoObraPrecios = document.getElementById('manoObraPrecio');
    var panelPrecio = document.getElementById('panelPrecio');
    var inversoresNum = document.getElementById('inversoresNum');
    var inversoresPrecio = document.getElementById('inversoresPrecio');
    var estructurasNum = document.getElementById('estructurasNum');
    var estructurasPrecio = document.getElementById('estructurasPrecio');

    var combiBoxNum = document.getElementById('combiBoxNum');
    var combiBoxPrecio = document.getElementById('combiBoxPrecio');

    var wifiNum = document.getElementById('wifiNum');
    var wifiPrecio = document.getElementById('wifiPrecio');


    panelPrecio.disabled = checkbox.checked;

    inversoresNum.disabled = checkbox.checked;
    inversoresPrecio.disabled = checkbox.checked;

    estructurasNum.disabled = checkbox.checked;
    estructurasPrecio.disabled = checkbox.checked;

    kitNumField.disabled = !checkbox.checked;
    kitPrecioField.disabled = !checkbox.checked;
    
    cablesNumField.disabled = checkbox.checked;
    cablesPrecioField.disabled = checkbox.checked;

    manoObraPrecios.disabled = checkbox.checked;

    if (checkbox.checked) {
        selectedCount++;
    } else {
        selectedCount--;
    }
    
    
    if (!combiBoxNum.classList.contains('combiBox')) {
        combiBoxNum.disabled = checkbox.checked;
        combiBoxPrecio.disabled = checkbox.checked;
    }
    


    if (!wifiNum.classList.contains('wifi')) {
        wifiNum.disabled = checkbox.checked;
    }

    if (!wifiPrecio.classList.contains('wifi')) {
        wifiPrecio.disabled = checkbox.checked;
    }
}

// Agrega el evento de cambio al checkbox
document.getElementById('checkKit').addEventListener('change', toggleKitFields);

// Ejecuta la función inicialmente para establecer el estado inicial
toggleKitFields();