<?php
include("conexion.php");
session_start();

// Verificar si se han enviado los datos del formulario
if (isset($_POST['usuario']) && isset($_POST['pass'])) {
    // Acceder a los datos del formulario

    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
   

    try {
        // Crear una instancia de PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $conn->prepare("SELECT id_usuario, rol FROM registro_usuarios WHERE usuario=:usuario AND pass=:pass");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();


        if ($row = $stmt->fetch()) {
            // Obtener el id_usuario del usuario autenticado
            $id_usuario = $row['id_usuario'];
            $rol = $row['rol'];
            // Establecer el id_usuario en la variable de sesión
            $_SESSION['id_usuario'] = $id_usuario;
            // Redirigir según el rol usando PHP
            if ($rol === 'lider') {
                header("Location: menu-lider.php");
                exit(); // Asegúrate de detener el script después de la redirección
            } else if ($rol === 'agente') {
                header("Location: menu-agente.php");
                exit(); // Asegúrate de detener el script después de la redirección
            }
        } else {
            echo "Credenciales inválidas";
            header("Location: login.html");
            exit(); // Asegúrate de detener el script después de la redirección
        }
      
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        echo "Error: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        $conn = null;
    }  

} else {
    echo "Error: No se recibieron los datos del formulario correctamente.";

}
?>
