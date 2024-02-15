<?php
include("conexion.php");


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

        echo "<script>alert('Registro eliminado con éxito');</script>";
        echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
        <h2 style="margin-bottom:20px;">El registro fue eliminado correctamente.</h2>
        <a href="hembra-tabla.php" class="btn btn-success" ><i class="bi bi-arrow-left"></i>Regresar</a></div>';

    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
        echo "Error: " . $e->getMessage();
        echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
        <h2 style="margin-bottom:20px;">Error: el registro no fue eliminado.</h2>
        <a href="hembra-tabla.php" class="btn btn-warning" ><i class="bi bi-arrow-left"></i>Regresar</a></div>';
    }
} else {
    echo "<script>alert('Hubo un error al recibir el formulario.');</script>";
    echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
    <h2 style="margin-bottom:20px;">Error: el registro no fue eliminado.</h2>
    <a href="hembra-tabla.php" class="btn btn-warning" ><i class="bi bi-arrow-left"></i>Regresar</a></div>';
}
?>