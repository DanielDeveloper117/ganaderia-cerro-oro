<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<script src="https://kit.fontawesome.com/f7e7d9df55.js" crossorigin="anonymous"></script>

<?php
include("../../conexion.php");


if (isset($_POST['id_vaca'])) {
    $id_vaca = $_POST['id_vaca'];

    try {
        // Establecer la conexión PDO aquí

        $sql = "DELETE FROM vacas WHERE id_vaca = :id_vaca";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_vaca', $id_vaca);
        $stmt->execute();
        // Cerrar la conexión
        $conexion = null;
        // Redireccionar a la página anterior o mostrar un mensaje de éxito
        header("Location: hembra-tabla.php");
        exit();

    } catch (PDOException $e) {
        // Error cuando no se ejecuta la consulta SQL
        echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
        //echo "Error: " . $e->getMessage();
        echo '
        <div class="d-flex col-12 justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
            <h2 class="mb-3">No fue posible eliminar el registro</h2>
            <i style="color:red;" class="col-8 col-xl-5 mb-3 text-center fa-regular fa-circle-xmark fa-3x"></i>
            <a href="hembra-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
                Regresar a la tabla
            </a>
            <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-5 btn btn-secondary" >
                Ir al menú
            </a>
            <p class="mb-3">Si el problema persiste, contactar a los desarrolladores</p>
        </div> 
        ';
    }
} else {
    echo "<script>alert('Hubo un error al recibir la peticion.');</script>";
    //echo "Error: " . $e->getMessage();
    echo '
    <div class="d-flex col-12 justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
        <h2 class="mb-3">No fue posible eliminar el registro</h2>
        <i style="color:red;" class="col-8 col-xl-5 mb-3 text-center fa-regular fa-circle-xmark fa-3x"></i>
        <a href="hembra-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
            Ir a la tabla
        </a>
        <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-5 btn btn-secondary" >
            Ir al menú
        </a>
        <p class="mb-3">Si el problema persiste, contactar a los desarrolladores</p>
    </div> 
    ';
}
?>