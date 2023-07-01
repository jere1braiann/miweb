<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dni_database';
$conn = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: consulta_dni.php");
    exit;
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar las credenciales de inicio de sesión
    $dni = $_POST['login_dni'];
    $password = $_POST['login_password'];

    // Consulta a la base de datos para verificar las credenciales del administrador
    $loginQuery = "SELECT * FROM admins WHERE dni = '$dni'";
    $loginResult = $conn->query($loginQuery);

    // Verificar si se encontraron resultados
    if ($loginResult->num_rows > 0) {
        $row = $loginResult->fetch_assoc();
        if ($row['password'] === $password) {
            // Inicio de sesión exitoso, establecer las variables de sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];

            // Redireccionar al archivo deseado después del inicio de sesión exitoso
            header("Location: consulta_dni.php");
            exit;
        } else {
            // Contraseña incorrecta, mostrar mensaje de error
            $error_message = "Contraseña incorrecta. Por favor, inténtalo de nuevo.";
        }
    } else {
        // DNI no encontrado en la base de datos, mostrar mensaje de error
        $error_message = "DNI no encontrado. Por favor, inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

* {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}
    body {
  background-image: url("imagen.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  }

    
    .container {
      max-width: 400px;
      margin: 100px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 30px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    
    .container h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #000000;
    }
    
    .form-group label {
      font-weight: bold;
      color: #000000;
    }
    
    .form-control {
      border-radius: 5px;
      background-color: #fff;
      color: #ffffff;
    }
    
    .btn-primary {
      width: 100%;
      background-color: #9752e6;
      border-color: #9752e6;
    }
    
    .btn-primary:hover {
      background-color: #8e47d2;
      border-color: #8e47d2;
    }
    
    .fa-lock {
      margin-right: 10px;
    }
    
    .alert-danger {
      margin-top: 20px;
      text-align: center;
    }
    
    /* Estilos adicionales para la estructura de la página */
    
    /* Estilos para el pie de página */
    .footer {
      text-align: center;
      color: #ffffff;
      margin-top: 40px;
      font-size: 14px;
    }
  </style>
</head>
<body>

  
  <div class="container">
    <h1><i class="fas fa-lock"></i> Iniciar sesión</h1>
    <?php if (isset($error_message)) { ?>
      <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="login_dni"><i class="fas fa-user"></i> Usuario:</label>
            <input type="text" id="login_dni" name="login_dni" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="login_password"><i class="fas fa-lock"></i> Contraseña:</label>
            <input type="password" id="login_password" name="login_password" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</button>
        </div>
    </form>
  </div>
  
  <footer class="footer">
    <p>Creado por <strong>Tu Nombre</strong> y <strong>Otro Nombre</strong></p>
    <p>&copy; 2023 Todos los derechos reservados</p>
  </footer>
  
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
