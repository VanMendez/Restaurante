<?php
session_start();
$usuario = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Redirigir al login si no hay sesión activa
if (!$usuario) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Header con el menú de navegación -->
    <header>
        <nav class="container">
            <ul class="nav justify-content-center py-3">
                <li class="nav-item"><a class="nav-link text-white" href="./insertar.php">Insertar Registros</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="./actualizar.php">Actualizar Registros</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="./eliminar.php">Eliminar Registros</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="./listar.php">Listar Registros</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="./consultas.php">Consultas</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="./salir.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <!-- Footer -->
    <footer class=" footer text-center text-white py-3 mt-auto">
        <p>&copy; 2024 Restaurante</p>
    </footer>
</body>

</html>