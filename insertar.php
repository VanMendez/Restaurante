<?php
include("verificar_sesion.php");
include("conexion.php"); // Incluye la clase de conexión

$datos = new db_restaurante();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($_POST['usr_nombre']) && !empty($_POST['usr_apellido']) && !empty($_POST['usr_correo'])
        && !empty($_POST['usr_contrasena']) && !empty($_POST['usr_telefono']) && !empty($_POST['usr_direccion'])
        && !empty($_POST['usr_fecha_nacimiento']) && !empty($_POST['usr_genero']) && !empty($_POST['usr_estado'])
    ) {

        $nombre = $_POST['usr_nombre'];
        $apellido = $_POST['usr_apellido'];
        $correo = $_POST['usr_correo'];
        $contrasena = $_POST['usr_contrasena'];
        $telefono = $_POST['usr_telefono'];
        $direccion = $_POST['usr_direccion'];
        $fecha_nacimiento = $_POST['usr_fecha_nacimiento'];
        $genero = $_POST['usr_genero'];
        $estado = $_POST['usr_estado'];

        $res = $datos->insertar_usuarios($nombre, $apellido, $correo, $contrasena, $telefono, $direccion, $fecha_nacimiento, $genero, $estado);

        if ($res) {
            echo '<script>
                    alert("Usuario insertado correctamente");
                    window.location.href="listar.php"; // Redirige a listar.php
                  </script>';
        } else {
            echo '<script>
                    alert("Error al insertar usuario");
                  </script>';
        }
    } else {
        echo '<script>
                alert("Por favor completa todos los campos");
              </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Insertar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Header con menú de navegación -->
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

    <!-- Contenido principal -->
    <div class="container flex-grow-1">
        <div class="form-container mt-5">
            <h1 class=" text-white text-center mb-4">Insertar Nuevo Usuario</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="usr_nombre" class="form-label">Nombre:</label>
                    <input type="text" name="usr_nombre" id="usr_nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="usr_apellido" class="form-label">Apellido:</label>
                    <input type="text" name="usr_apellido" id="usr_apellido" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="usr_correo" class="form-label">Correo Electrónico:</label>
                    <input type="email" name="usr_correo" id="usr_correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="usr_contrasena" class="form-label">Contraseña:</label>
                    <input type="password" name="usr_contrasena" id="usr_contrasena" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="usr_telefono" class="form-label">Teléfono:</label>
                    <input type="tel" name="usr_telefono" id="usr_telefono" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="usr_direccion" class="form-label">Dirección:</label>
                    <input type="text" name="usr_direccion" id="usr_direccion" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="usr_fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" name="usr_fecha_nacimiento" id="usr_fecha_nacimiento" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="usr_genero" class="form-label">Género:</label>
                    <select name="usr_genero" id="usr_genero" class="form-select" required>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="usr_estado" class="form-label">Estado:</label>
                    <select name="usr_estado" id="usr_estado" class="form-select" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Guardar Usuario</button>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <footer class=" footer text-center text-white py-3 mt-auto">
        <p>&copy; 2024 Restaurante</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>