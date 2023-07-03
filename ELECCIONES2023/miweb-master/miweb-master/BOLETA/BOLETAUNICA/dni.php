<?php
// Obtener el DNI enviado por POST
if (isset($_POST['dni'])) {
    $dni = $_POST['dni'];

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

    // Consulta SQL para verificar si el DNI está habilitado para votar
    $query = "SELECT habilitado FROM padron_electoral_general___hoja_1 WHERE dni = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró algún registro
    if ($result->num_rows > 0) {
        // Obtener el estado de habilitación del DNI
        $row = $result->fetch_assoc();
        $habilitado = $row['habilitado'];

        if ($habilitado == 'si') {
            // El DNI está habilitado, continuar con el proceso completo

            // Consulta SQL para verificar si el DNI está en la base de datos y si ya se ingresó
            $checkQuery = "SELECT * FROM padron_electoral_general___hoja_1 WHERE dni = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param('s', $dni);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            // Verificar si se encontró algún registro
            if ($checkResult->num_rows > 0) {
                // Verificar si el DNI ya se ingresó
                $checkRow = $checkResult->fetch_assoc();
                if ($checkRow['boleta_count'] > 0) {
                    echo "duplicate"; // El DNI ya se ingresó anteriormente
                } else {
                    // Actualizar el contador en la base de datos
                    $updateQuery = "UPDATE padron_electoral_general___hoja_1 SET boleta_count = 1, hora = CURRENT_TIMESTAMP WHERE dni = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param('s', $dni);
                    $updateStmt->execute();
                    echo "true"; // El DNI está en la base de datos y se actualizó el contador
                }
            } else {
                echo "false"; // El DNI no está en la base de datos
            }
        } else {
            echo "not_allowed"; // El DNI no está habilitado para votar
        }
    } else {
        echo "not_found"; // El DNI no está en la base de datos
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>