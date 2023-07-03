let selectedCard = null;
let presidenteSeleccion = '';
let secretariasSeleccion = '';

function seleccionarLista(lista) {
  if (selectedCard) {
    selectedCard.classList.remove('selected-card');
  }

  selectedCard = document.getElementById(lista + '-card');
  selectedCard.classList.add('selected-card');
}

function seleccionarVotoBlanco() {
  if (selectedCard) {
    selectedCard.classList.remove('selected-card');
  }

  selectedCard = document.getElementById('voto-blanco-card');
  selectedCard.classList.add('selected-card');
}

function siguientePresidencia() {
  if (selectedCard) {
    console.log('Has seleccionado:', selectedCard.id);
    presidenteSeleccion = selectedCard.innerText;
    document.getElementById('presidente-section').classList.add('hidden');
    document.getElementById('secretarias-section').classList.remove('hidden');
  } else {
    alert('Debes seleccionar una opción antes de continuar');
  }
}

function seleccionarListaSecretarias(lista) {
  if (selectedCard) {
    selectedCard.classList.remove('selected-card');
  }

  selectedCard = document.getElementById(lista + '-card');
  selectedCard.classList.add('selected-card');
}

function seleccionarVotoBlancoSecretarias() {
  if (selectedCard) {
    selectedCard.classList.remove('selected-card');
  }

  selectedCard = document.getElementById('voto-blanco-secretarias-card');
  selectedCard.classList.add('selected-card');
}

function siguienteSecretarias() {
  const selectedCardSecretarias = document.querySelector('#secretarias-section .selected-card');

  if (selectedCardSecretarias) {
    console.log('Has seleccionado:', selectedCardSecretarias.id);
    secretariasSeleccion = selectedCardSecretarias.innerText;
    mostrarResumen();
  } else {
    alert('Debes seleccionar una opción antes de continuar');
  }
}

function mostrarResumen() {
  document.getElementById('secretarias-section').classList.add('hidden');
  document.getElementById('resumen-section').classList.remove('hidden');

  document.getElementById('presidencia-seleccion').innerText = presidenteSeleccion;
  document.getElementById('secretarias-seleccion').innerText = secretariasSeleccion;

  // Verificar las posibilidades de selección
  const errorText = document.getElementById('error-text');
  errorText.textContent = '';

  if (presidenteSeleccion.includes('Lista 453') && secretariasSeleccion.includes('Lista 453')) {
    errorText.textContent = 'No puedes seleccionar la Lista 453 en ambas secciones.';
  } else if (presidenteSeleccion.includes('Lista 101') && secretariasSeleccion.includes('Lista 101')) {
    errorText.textContent = 'No puedes seleccionar la Lista 101 en ambas secciones.';
  }

  const enviarVotoBtn = document.getElementById('btn-enviar');
  if (errorText.textContent !== '') {
    document.getElementById('error-message').classList.remove('hidden');
    enviarVotoBtn.disabled = true;
  } else {
    enviarVotoBtn.disabled = false;
  }
}

function modificarSeleccion() {
  // Redireccionar a elegir.html después de recargar la página
  window.location.href = 'elegir.html';
}

function enviarVoto() {
    // Verificar si se muestra el mensaje de error
    const errorMessage = document.getElementById('error-message');
    if (errorMessage.classList.contains('hidden')) {
      // Solicitar el DNI al usuario
      const dni = prompt('Por favor, ingresa tu DNI:');
      
      // Verificar el DNI en el archivo "dni.php"
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'dni.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // El servidor respondió correctamente
            const response = JSON.parse(xhr.responseText);
            if (response.exists) {
              // El DNI existe en el archivo "dni.php"
              // Lógica para enviar el voto
              
              // Redireccionar a listo.html
              window.location.href = 'listo.html';
            } else {
              alert('VOTO EMITIDO!');
              window.location.href = 'listo.html'
            }
          } else {
            // Error en la solicitud al servidor
            alert('Ocurrió un error al verificar el DNI. Por favor, intenta nuevamente más tarde.');
          }
        }
      };
      
      // Enviar el DNI al archivo "dni.php"
      xhr.send('dni=' + encodeURIComponent(dni));
    }
  }