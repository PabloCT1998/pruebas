const estadoSelect = document.getElementById("estado");
const ciudadSelect = document.getElementById("ciudad");

estadoSelect.addEventListener("change", function () {
  const selectedEstado = estadoSelect.value;

  if (selectedEstado === "") {
    ciudadSelect.disabled = true;
    ciudadSelect.innerHTML = '<option value="">CIUDAD</option>';
  } else {
    // Llamar a una función que carga las ciudades basadas en el estado seleccionado
    cargarCiudades(selectedEstado)
      .then((ciudades) => {
        // Limpiar el select de ciudad
		ciudadSelect.innerHTML = ''; // Limpia el contenido previo del select
        // Agregar las nuevas opciones de ciudad basadas en la respuesta
        ciudades.forEach((ciudad) => {
          const option = document.createElement("option");
          option.value = ciudad.CiudadID; // Ajusta el valor adecuadamente
          option.textContent = ciudad.DescCiudad; // Ajusta el nombre adecuadamente
          ciudadSelect.appendChild(option);
        });

        ciudadSelect.disabled = false;
      })
      .catch((error) => {
        console.error("Error al cargar las ciudades:", error);
      });
  }
});
function cargarCiudades(estado) {
  return new Promise((resolve, reject) => {
    // Realizar una solicitud AJAX al servidor para obtener las ciudades del estado seleccionado
    fetch(`./obtener-ciudades.php?estado=${estado}`)
      .then((response) => response.json()) // Parsea la respuesta como JSON
      .then((data) => {
        console.log("Respuesta del servidor:", data); // Muestra la respuesta en la consola
        if (data.ciudades && Array.isArray(data.ciudades)) {
          resolve(data.ciudades); // Resuelve la promesa con las ciudades
        } else {
          reject("La respuesta no contiene datos de ciudades válidos.");
        }
      })
      .catch((error) => {
        console.error("Error al cargar las ciudades:", error);
        reject(error);
      });
  });
}
