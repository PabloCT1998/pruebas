
    function validatePasswordInputs() {
    var passViejo = document.getElementById("passwordViejo").value;
    var passNuevo = document.getElementById("passwordNuevo").value;

    if (passViejo != "" || passNuevo != "") {
        document.getElementById("passwordViejo").setAttribute("required", "true");
        document.getElementById("passwordNuevo").setAttribute("required", "true");
    } else {

        document.getElementById("passwordViejo").removeAttribute("required");
        document.getElementById("passwordNuevo").removeAttribute("required");
    }
}
