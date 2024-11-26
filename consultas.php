<?php
include("verificar_sesion.php"); // Verifica que la sesión esté activa
include("conexion.php"); // Incluye la conexión a la base de datos


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Pedidos Completados</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Krona+One|Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
        <h1 class="text-white text-center mb-4">Pedidos Completados</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Nombre Usuario</th>
                    <th>Apellido Usuario</th>
                    <th>Platillo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $db = new db_restaurante(); // Instancia la conexión
                $pedidos = $db->listar_pedidos_completados(); // Llama al método para obtener los datos

                if ($pedidos) {
                    foreach ($pedidos as $pedido) {
                        $id = $pedido->pedido_id;
                        $nombreUsuario = $pedido->usr_nombre;
                        $apellidoUsuario = $pedido->usr_apellido;
                        $platillo = $pedido->menu_nombre;
                        $cantidad = $pedido->pedido_cantidad;
                        $precio = $pedido->menu_precio;
                        $fecha = $pedido->pedido_fecha;
                        $estado = ucfirst($pedido->pedido_estado); // Convierte la primera letra en mayúscula
                ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $nombreUsuario; ?></td>
                            <td><?php echo $apellidoUsuario; ?></td>
                            <td><?php echo $platillo; ?></td>
                            <td><?php echo $cantidad; ?></td>
                            <td><?php echo $precio; ?></td>
                            <td><?php echo $fecha; ?></td>
                            <td><?php echo $estado; ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No se encontraron pedidos completados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Footer -->
    <footer class="footer text-center text-white py-3 mt-auto">
        <p>Restaurante &copy; 2024</p>
    </footer>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>