<?php
include_once("verificar_sesion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header("location:listar.php"); // Redirige si no se pasa un ID válido
    exit();
}

include_once("conexion.php"); // Incluye la conexión solo una vez

$usuario = new db_restaurante();
$datos_usuario = $usuario->seleccionar_usuario($id); // Método para seleccionar un usuario por su ID

// Código para actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $id = $_POST['id'];
    $nombre = $_POST['usr_nombre'];
    $apellido = $_POST['usr_apellido'];
    $correo = $_POST['usr_correo'];
    $contrasena = $_POST['usr_contrasena'];
    $telefono = $_POST['usr_telefono'];
    $direccion = $_POST['usr_direccion'];
    $fecha_nacimiento = $_POST['usr_fecha_nacimiento'];
    $genero = $_POST['usr_genero'];
    $estado = $_POST['usr_estado'];

    $res = $usuario->actualizar_usuario($id, $nombre, $apellido, $correo, $contrasena, $telefono, $direccion, $fecha_nacimiento, $genero, $estado);

    if ($res) {
        echo '
			<script type="text/javascript">
				alert("Datos actualizados correctamente");
				window.location.href="listar.php";
			</script>';
    } else {
        echo '
			<script type="text/javascript">
				alert("Error al actualizar datos");
			</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
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

    <div class="container mt-5">
        <h1 class=" text-center mb-4">Actualizar Usuario</h1>
        <form method="post">
            <!-- Campo oculto para el ID del usuario -->
            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $datos_usuario->usr_id; ?>">

            <div class="mb-3">
                <label for="usr_nombre" class="form-label">Nombre:</label>
                <input type="text" name="usr_nombre" id="usr_nombre" class="form-control" required value="<?php echo $datos_usuario->usr_nombre; ?>">
            </div>

            <div class="mb-3">
                <label for="usr_apellido" class="form-label">Apellido:</label>
                <input type="text" name="usr_apellido" id="usr_apellido" class="form-control" required value="<?php echo $datos_usuario->usr_apellido; ?>">
            </div>

            <div class="mb-3">
                <label for="usr_correo" class="form-label">Correo Electrónico:</label>
                <input type="email" name="usr_correo" id="usr_correo" class="form-control" required value="<?php echo $datos_usuario->usr_correo; ?>">
            </div>

            <div class="mb-3">
                <label for="usr_contrasena" class="form-label">Contraseña:</label>
                <input type="password" name="usr_contrasena" id="usr_contrasena" class="form-control" required value="<?php echo $datos_usuario->usr_contrasena; ?>">
            </div>

            <div class="mb-3">
                <label for="usr_telefono" class="form-label">Teléfono:</label>
                <input type="tel" name="usr_telefono" id="usr_telefono" class="form-control" required value="<?php echo $datos_usuario->usr_telefono; ?>">
            </div>

            <div class="mb-3">
                <label for="usr_direccion" class="form-label">Dirección:</label>
                <input type="text" name="usr_direccion" id="usr_direccion" class="form-control" required value="<?php echo $datos_usuario->usr_direccion; ?>">
            </div>

            <div class="mb-3">
                <label for="usr_fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" name="usr_fecha_nacimiento" id="usr_fecha_nacimiento" class="form-control" required value="<?php echo $datos_usuario->usr_fecha_nacimiento; ?>">
            </div>

            <div class="mb-3">
                <label for="usr_genero" class="form-label">Género:</label>
                <select name="usr_genero" id="usr_genero" class="form-select" required>
                    <option value="M" <?php echo ($datos_usuario->usr_genero == 'M') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="F" <?php echo ($datos_usuario->usr_genero == 'F') ? 'selected' : ''; ?>>Femenino</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="usr_estado" class="form-label">Estado:</label>
                <select name="usr_estado" id="usr_estado" class="form-select" required>
                    <option value="activo" <?php echo ($datos_usuario->usr_estado == 'activo') ? 'selected' : ''; ?>>Activo</option>
                    <option value="inactivo" <?php echo ($datos_usuario->usr_estado == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-info w-100">Actualizar Usuario</button>
            <a href="listar.php" class="btn btn-warning w-100 mt-2">Listar Usuarios</a>
        </form>
    </div>
    <!-- Footer -->
    <footer class="footer text-center text-white py-3 mt-auto">
        <p>Restaurante &copy; 2024</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>