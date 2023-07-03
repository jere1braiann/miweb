<?php
// Obtener la lista seleccionada enviada por POST
if (isset($_POST['lista'])) {
    $lista = $_POST['lista'];

    // Realizar la conexión a la base de datos
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'boleta_database';
    $conn = new mysqli($host, $username, $password, $database);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die('Error de conexión: ' . $conn->connect_error);
    }

    // Verificar la lista seleccionada y realizar la actualización correspondiente en la tabla "escrutinio_final"
    // Verificar la lista seleccionada y realizar la actualización correspondiente en la tabla "escrutinio_final"
if ($lista === '453') {
    $query = "UPDATE `escrutinio_final` SET `presidencia` = `presidencia` + 1, `secretarias` = `secretarias` + 1 WHERE `escrutinio_final`.`id` = 1";
} elseif ($lista === '101') {
    $query = "UPDATE `escrutinio_final` SET `presidencia` = `presidencia` + 1, `secretarias` = `secretarias` + 1 WHERE `escrutinio_final`.`id` = 2";
} else {
    die('Lista seleccionada inválida');
}


    // Ejecutar la consulta SQL de actualización
    if ($conn->query($query) === true) {
        echo 'success';
    } else {
        echo 'error';
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    die('Lista no especificada');
}
?>
