document.addEventListener("DOMContentLoaded", function() {
    const checkbox = document.getElementById("checkContactoExistente");
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"]');
    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const correoElectronico = document.getElementById("correoElectronico");
    const telefono = document.getElementById("telefono");

    checkbox.addEventListener("change", function() {
        if (checkbox.checked) {
            nombre.disabled = true;
            apellido.disabled = true;
            correoElectronico.disabled = true;
            telefono.disabled = true;
        } else {
            nombre.disabled = false;
            apellido.disabled = false;
            correoElectronico.disabled = false;
            telefono.disabled = false;
        }
    });
});