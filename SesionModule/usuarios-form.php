<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit;
} else {
    echo 'Usuario autenticado con ID: '.$_SESSION['id_usuario'].'</br>';
}


// Verificar si se han enviado los datos del formulario
if (isset($_POST['nombre'])&& isset($_POST['usuario']) && isset($_POST['correo']) && isset($_POST['pass']) && isset($_POST['rol'])) {
    // Acceder a los datos del formulario
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];

    try {
        //instancia que indica que la conexion "$conn" de conexion.php sera usada aqui con PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Construir la consulta de inserción con marcadores de posición
        $sql = "INSERT INTO registro_usuarios (id_usuario, nombre, usuario, correo, pass, rol) VALUES (null, :nombre, :usuario, :correo, :pass, :rol)";
        // Preparar la consulta
        $stmt = $conn->prepare($sql);
        // Vincular los valores a los marcadores de posición
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':rol', $rol);
        // Ejecutar la consulta
        $stmt->execute();
        $conn = null;
        echo "<script>alert('Registro guardado con éxito');</script>";

    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        echo "<script>alert('Hubo un error al enviar los datos.');</script>";
        echo "Error: " . $e->getMessage();
    }
    
    echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;"><h2 style="margin-bottom:20px;">Los datos se han enviado correctamente.</h2><a href="usuarios.php" class="btn btn-success" >Regresar</a></div>';

    
}else {
    echo "<script>alert('Hubo un error al recibir el formulario.');</script>";
    echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;"><h2 style="margin-bottom:20px;">Error: los datos no fueron enviados.</h2><a href="usuarios.php" class="btn btn-warning" >Regresar</a></div>';

}

?>