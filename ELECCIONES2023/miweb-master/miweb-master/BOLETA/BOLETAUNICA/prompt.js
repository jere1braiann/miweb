let selectedLista = null;

function seleccionarLista(lista) {
  selectedLista = lista;
  const listCards = document.querySelectorAll('.custom-card');
  listCards.forEach((card) => {
    card.classList.remove('selected-card');
  });
  const selectedCard = document.querySelector(`[onclick="seleccionarLista('${lista}')"]`);
  selectedCard.classList.add('selected-card');
}

function enviarSeleccion() {
  if (selectedLista) {
    const dni = prompt('Ingrese su DNI para verificar su identidad:');
    if (dni) {
      // Enviar el DNI al archivo verificar_dni.php usando una solicitud AJAX
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'verificar_dni.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          const response = xhr.responseText;
          if (response === 'true') {
            // El DNI está habilitado y se actualizó el contador, ejecutar el archivo contador_oficial.php
            const contadorXhr = new XMLHttpRequest();
            contadorXhr.open('POST', 'contador_oficial.php', true);
            contadorXhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            contadorXhr.onreadystatechange = function() {
              if (contadorXhr.readyState === 4 && contadorXhr.status === 200) {
                const contadorResponse = contadorXhr.responseText;
                if (contadorResponse === 'success') {
                  // La actualización del contador fue exitosa, cargar la página actual
                  window.location.href = 'listo.html';
                } else {
                  // Error en la actualización del contador, redireccionar a error.html
                  window.location.href = 'error.html';
                }
              }
            };
            contadorXhr.send(`lista=${selectedLista}`);
          } else if (response === 'duplicate' || response === 'not_allowed' || response === 'not_found') {
            // Redireccionar a error.html en caso de error en la verificación del DNI
            window.location.href = 'error.html';
          }
        }
      };
      xhr.send(`dni=${dni}`);
    } else {
      alert('Debes ingresar un DNI válido');
    }
  } else {
    alert('Debes seleccionar una lista antes de enviar');
  }
}
