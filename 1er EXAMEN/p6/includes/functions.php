<?php
// Conexión a la base de datos
include 'conexion.php';

// Función para verificar si el usuario tiene un permiso
function usuario_tiene_permiso($id_usuario) {
    global $conexion; // Usa la conexión global a la base de datos

    // Consulta para obtener todos los permisos del usuario
    $query = "SELECT p.nombre_permiso
              FROM persona per
              JOIN rol_usuarios r ON per.id_rol_usuario = r.id
              JOIN roles_permisos rp ON r.id = rp.id_rol
              JOIN permisos p ON rp.id_permiso = p.id_permiso
              WHERE per.id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $permisos = array(); // Array para almacenar los permisos del usuario

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $permisos[] = $row['nombre_permiso']; // Agregar permiso al array
        }
    }

    return $permisos; // Devuelve un array con los permisos del usuario
}

function verficar_permiso($id_usuario, $nombre_permiso) {
    global $conexion; // Usa la conexión global a la base de datos
    echo $id_usuario. " -->". $nombre_permiso;
    // Consulta para obtener el rol del usuario
    $query = "SELECT p.id_rol_usuario 
              FROM persona p
              WHERE p.id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $rol = $result->fetch_assoc();

        // Verificar si el rol tiene el permiso
        $query = "SELECT * FROM roles_permisos WHERE id_rol = ? AND id_rol = (SELECT id FROM rol_usuarios WHERE nombre = ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("is", $rol['id_rol_usuario'], $nombre_permiso);
        $stmt->execute();
        $result = $stmt->get_result();

        // Devuelve verdadero si encuentra un permiso coincidente
        return $result->num_rows > 0;
    }

    return false; // Si el usuario no tiene el permiso
}

function obtener_modulos_usuario($id_usuario) {
    global $conexion; // Usa la conexión global a la base de datos
    
    // Consulta para obtener el rol del usuario
    $query_rol = "SELECT id_rol_usuario FROM persona WHERE id = ?";
    $stmt = $conexion->prepare($query_rol);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result_rol = $stmt->get_result();
    if ($result_rol->num_rows > 0) {
        $rol = $result_rol->fetch_assoc();

        // Consulta para obtener los módulos a los que el rol tiene acceso
        $query_modulos = "SELECT * FROM modulos WHERE id_permiso IN (
                          SELECT id_permiso FROM roles_permisos WHERE id_rol = ?)";
                          
        $stmt = $conexion->prepare($query_modulos);
        $stmt->bind_param("i", $rol['id_rol_usuario']);
       
        $stmt->execute();
       
        $result_modulos = $stmt->get_result();
        
        return $result_modulos;
    }

    return null; // Si no se encuentra el rol
}
function obtener_tiporol($id_usuario) {
    global $conexion; // Usa la conexión global a la base de datos
    
    // Consulta para obtener el rol del usuario
    $query_rol = "SELECT r.nombre 
                    FROM persona p 
                    INNER JOIN rol_usuarios r ON p.id_rol_usuario = r.id
                    WHERE p.id = ?";
    $stmt = $conexion->prepare($query_rol);
    
    if ($stmt) {
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Si hay resultados, obtenemos el primer elemento
        if ($result->num_rows > 0) {
            $rol = $result->fetch_assoc();
            $stmt->close(); // Cerramos el `stmt`
            return $rol['nombre']; // Devolvemos el nombre del rol
        }

        $stmt->close(); // Cerramos el `stmt`
    }

    return null; // Si no se encuentra el rol o hay error en la consulta
}
