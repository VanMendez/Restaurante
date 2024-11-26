<?php
include("verificar_sesion.php"); // Verifica que la sesión esté activa
include("conexion.php"); // Incluye la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Listar Usuarios</title>
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
		<h1 class=" text-white text-center mb-4">Listado de Usuarios</h1>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Correo Electrónico</th>
					<th>Teléfono</th>
					<th>Dirección</th>
					<th>Fecha de Nacimiento</th>
					<th>Género</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$tabla = new db_restaurante(); // Instancia la conexión
				$listado = $tabla->listar_usuarios(); // Llama al método para obtener los datos

				while ($row = mysqli_fetch_assoc($listado)) {
					$id = $row['usr_id'];
					$nombre = $row['usr_nombre'];
					$apellido = $row['usr_apellido'];
					$correo = $row['usr_correo'];
					$telefono = $row['usr_telefono'];
					$direccion = $row['usr_direccion'];
					$fecha_nacimiento = $row['usr_fecha_nacimiento'];
					$genero = $row['usr_genero'] == 'M' ? 'Masculino' : 'Femenino';
					$estado = ucfirst($row['usr_estado']); // Convierte la primera letra en mayúscula
				?>
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $nombre; ?></td>
						<td><?php echo $apellido; ?></td>
						<td><?php echo $correo; ?></td>
						<td><?php echo $telefono; ?></td>
						<td><?php echo $direccion; ?></td>
						<td><?php echo $fecha_nacimiento; ?></td>
						<td><?php echo $genero; ?></td>
						<td><?php echo $estado; ?></td>
						<td>
							<a href="actualizar.php?id=<?php echo $id; ?>" class="edit" title="Editar" data-toggle="tooltip">
								<i class="material-icons">&#xE254;</i>
							</a>
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>

	<!-- Footer -->
	<footer class=" footer text-center text-white py-3 mt-auto">
		<p>Restaurante &copy; 2024</p>
	</footer>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>