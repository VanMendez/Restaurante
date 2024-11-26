<?php
class db_restaurante
{
    private $con;
    private $dbequipo = 'sql207.infinityfree.com';
    private $dbusuario = 'if0_37788176';
    private $dbclave = '5ipyKrk4a1EVzEx';
    private $dbnombre = 'if0_37788176_restaurante';

    function __construct()
    {
        $this->conectar();
    }

    public function conectar()
    {
        $this->con = mysqli_connect($this->dbequipo, $this->dbusuario, $this->dbclave, $this->dbnombre);

        if (mysqli_connect_error()) {
            die("Error: No se pudo conectar a la base de datos: " . mysqli_connect_error() . mysqli_connect_error());
        }
    }

    public function login($usuario, $clave)
    {
        $sql = "SELECT COUNT(*) as registros FROM usuarios where usr_nombre='$usuario' AND usr_contrasena='$clave';";
        echo $sql;
        $resultado = mysqli_query($this->con, $sql);
        return $resultado;
    }

    // Función para insertar datos en la tabla usuarios
    public function insertar_usuarios($nombre, $apellido, $correo, $contrasena, $telefono, $direccion, $fecha_nacimiento, $genero, $estado)
    {
        $sql = "INSERT INTO usuarios (usr_nombre, usr_apellido, usr_correo, usr_contrasena, usr_telefono, usr_direccion, usr_fecha_nacimiento, usr_genero, usr_estado)
                VALUES ('$nombre', '$apellido', '$correo', '$contrasena', '$telefono', '$direccion', '$fecha_nacimiento', '$genero', '$estado');";

        $resultado = mysqli_query($this->con, $sql);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }

    public function listar_usuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $resultado = mysqli_query($this->con, $sql);
        return $resultado; // Retorna el resultado de la consulta
    }

    public function seleccionar_usuario($id)
    {
        $sql = "SELECT * FROM usuarios WHERE usr_id = $id";
        $resultado = mysqli_query($this->con, $sql);
        return mysqli_fetch_object($resultado);
    }

    public function actualizar_usuario($id, $nombre, $apellido, $correo, $contrasena, $telefono, $direccion, $fecha_nacimiento, $genero, $estado)
    {
        $sql = "UPDATE usuarios 
            SET usr_nombre = '$nombre', 
                usr_apellido = '$apellido', 
                usr_correo = '$correo', 
                usr_contrasena = '$contrasena', 
                usr_telefono = '$telefono', 
                usr_direccion = '$direccion', 
                usr_fecha_nacimiento = '$fecha_nacimiento', 
                usr_genero = '$genero', 
                usr_estado = '$estado'
            WHERE usr_id = $id";

        $resultado = mysqli_query($this->con, $sql);

        if ($resultado == true) {
            return true;
        } else {
            return false;
        }
    }


    //metodo para eliminar un registro
	public function eliminar_usuario($id)
{
    $sql = "DELETE FROM usuarios WHERE usr_id = $id";
    echo "Consulta ejecutada: $sql<br>"; // Muestra la consulta
    
    $resultado = mysqli_query($this->con, $sql);

    if ($resultado == true) {
        return true;
    } else {
        echo "Error de MySQL: " . mysqli_error($this->con) . "<br>"; // Muestra el error de MySQL
        return false;
    }
}

public function listar_pedidos_completados()
{
    $sql = "SELECT 
                p.pedido_id,
                u.usr_nombre,
                u.usr_apellido,
                m.menu_nombre,
                p.pedido_cantidad,
                m.menu_precio,
                p.pedido_fecha,
                p.pedido_estado
            FROM pedidos p
            JOIN usuarios u ON p.pedido_usr_id = u.usr_id
            JOIN menu m ON p.pedido_menu_id = m.menu_id
            WHERE 
                p.pedido_estado = 'completado'
                AND m.menu_precio > 6.00
                AND p.pedido_fecha >= '2024-01-01'
                AND u.usr_genero = 'F';";

    $resultado = mysqli_query($this->con, $sql);

    if (!$resultado) {
        echo "Error en la consulta: " . mysqli_error($this->con) . "<br>";
        echo "Consulta ejecutada: " . $sql . "<br>";
        return false;
    }

    $pedidos = [];
    while ($fila = mysqli_fetch_object($resultado)) {
        $pedidos[] = $fila; // Guardar cada fila como un objeto
    }

    return $pedidos;
}




}
