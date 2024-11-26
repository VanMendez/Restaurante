

-- Tabla de usuarios (10 campos mínimos)
CREATE TABLE usuarios (
    usr_id INT AUTO_INCREMENT,
    usr_nombre VARCHAR(50),
    usr_apellido VARCHAR(50),
    usr_correo VARCHAR(100) UNIQUE,
    usr_contrasena VARCHAR(255),
    usr_telefono VARCHAR(15),
    usr_direccion VARCHAR(150),
    usr_fecha_nacimiento DATE,
    usr_genero CHAR(1),
    usr_estado ENUM('activo', 'inactivo', 'suspendido') DEFAULT 'activo',
    PRIMARY KEY (usr_id)
);

-- Tabla de menú
CREATE TABLE menu (
    menu_id INT AUTO_INCREMENT,
    menu_nombre VARCHAR(50),
    menu_descripcion TEXT,
    menu_precio DECIMAL(10, 2),
    menu_disponible BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (menu_id)
);

-- Tabla de pedidos (relacionada con usuarios y menú)
CREATE TABLE pedidos (
    pedido_id INT AUTO_INCREMENT,
    pedido_usr_id INT,
    pedido_menu_id INT,
    pedido_cantidad INT,
    pedido_fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    pedido_estado ENUM('pendiente', 'completado', 'cancelado') DEFAULT 'pendiente',
    PRIMARY KEY (pedido_id),
    FOREIGN KEY (pedido_usr_id) REFERENCES usuarios(usr_id) ON DELETE CASCADE,
    FOREIGN KEY (pedido_menu_id) REFERENCES menu(menu_id) ON DELETE CASCADE
);

-- Insertar datos iniciales en la tabla usuarios
INSERT INTO usuarios (usr_nombre, usr_apellido, usr_correo, usr_contrasena, usr_telefono, usr_direccion, usr_fecha_nacimiento, usr_genero, usr_estado) VALUES
('Jose', 'Gomez', 'joseG@restaurante.com','3356', '1234567890', 'Calle Principal 123', '1980-01-01', 'M', 'activo'),
('Juan', 'Perez', 'juan@correo.com', '4422', '9876543210', 'Carrera Secundaria 456', '1995-05-15', 'M', 'activo'),
('Maria', 'Gomez', 'maria@correo.com','2367', '5555555555', 'Avenida Tercera 789', '1998-12-25', 'F', 'inactivo');

-- Insertar datos iniciales en la tabla menú
INSERT INTO menu (menu_nombre, menu_descripcion, menu_precio, menu_disponible) VALUES
('Pizza Margarita', 'Pizza clásica con tomate, queso y albahaca', 10.99, TRUE),
('Ensalada César', 'Ensalada con lechuga, crutones y aderezo César', 7.50, TRUE),
('Brownie con Helado', 'Brownie caliente con helado de vainilla', 5.99, TRUE);

-- Insertar datos iniciales en la tabla pedidos
INSERT INTO pedidos (pedido_usr_id, pedido_menu_id, pedido_cantidad, pedido_estado) VALUES
(2, 1, 2, 'pendiente'),
(3, 3, 1, 'completado');

-- Consulta SQL con JOIN y tres condiciones
SELECT 
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
    p.pedido_estado = 'completado'            -- Condición 1: Estado del pedido
    AND m.menu_precio > 6.00                 -- Condición 2: Precio del plato
    AND p.pedido_fecha >= '2024-01-01'       -- Condición 3: Fecha del pedido reciente
    AND u.usr_genero = 'F';                  -- Condición 4: Género del usuario
