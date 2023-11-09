document.addEventListener("DOMContentLoaded", function () {
  const checkboxes = document.querySelectorAll(".almacen-checkbox");
  const cantidadInputs = document.querySelectorAll("[name='cantidadAlmacen[]']");

  checkboxes.forEach((checkbox, index) => {
    checkbox.addEventListener("change", function () {
      if (this.checked) {
        checkboxes.forEach((otherCheckbox, otherIndex) => {
          if (otherIndex !== index) {
            otherCheckbox.removeAttribute("required");
          }
        });

        cantidadInputs[index].setAttribute("required", "required");
        cantidadInputs[index].removeAttribute("disabled");
      } else {
        cantidadInputs[index].removeAttribute("required");
        cantidadInputs[index].setAttribute("disabled", "disabled");
      }
    });

    // Verificar estado inicial al cargar la página
    if (checkbox.checked) {
      cantidadInputs[index].removeAttribute("disabled");
    } else {
      cantidadInputs[index].setAttribute("disabled", "disabled");
    }
  });
});
