<?php
include("conexion.php");
$datos = new db_restaurante();
$error = ""; // Inicializamos la variable de error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $usuario = $_POST['username'];
        $clave = $_POST['password'];

        // Llamada al método de autenticación
        $resultado = $datos->login($usuario, $clave);
        $array = mysqli_fetch_array($resultado);

        if (isset($array['registros']) && $array['registros'] > 0) {
            session_start();
            $_SESSION['username'] = $usuario;
            header("location:principal.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Por favor, complete todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="form-container">
            <h1 class=" text-white text-center mb-4">Iniciar Sesión</h1>
            <!-- Mostrar mensaje de error si existe -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Ingresar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
