<?php
// Obtener los valores enviados por POST
$presidencia = $_POST['presidencia'];
$secretarias = $_POST['secretarias'];

// Realizar la conexión a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dni_database';
$conn = new mysqli($host, $username, $password, $database);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Actualizar los votos en la base de datos
if ($presidencia == 'Voto En Blanco' && $secretarias == 'Voto En Blanco') {
    $query = "UPDATE escrutinio_final SET presidencia = presidencia + 1, secretarias = secretarias + 1 WHERE id = 3";
    if ($conn->query($query) === TRUE) {
        echo "Los votos se actualizaron correctamente";
    } else {
        echo "Error al actualizar los votos: " . $conn->error;
    }
} else {
    echo "No se cumple la condición para actualizar los votos";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
