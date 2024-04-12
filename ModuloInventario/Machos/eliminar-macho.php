<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<script src="https://kit.fontawesome.com/f7e7d9df55.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../styles/styles-machos.css">

<?php
include("../../conexion.php");


if (isset($_POST['id_macho'])) {
    $id_macho = $_POST['id_macho'];

    try {
        // Establecer la conexión PDO aquí

        $sql = "DELETE FROM machos WHERE id_macho = :id_macho";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_macho', $id_macho);
        $stmt->execute();
        // Cerrar la conexión
        $conexion = null;
        // Redireccionar a la página anterior o mostrar un mensaje de éxito
        header("Location: macho-tabla.php");
        exit();

    } catch (PDOException $e) {
        // Error cuando no se ejecuta la consulta SQL
        echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
        //echo "Error: " . $e->getMessage();
        echo '
        <div class="d-flex flex-row justify-content-center col-12">
            <div class="d-flex justify-content-center align-items-center flex-column mt-5 col-8" >
                <h1 class="mb-4 text-center" style="font-size:3rem;">Los datos no fueron enviados</h1>
                <i style="color:red;" class="col-8 col-xl-5 mb-5 text-center fa-regular fa-circle-xmark fa-3x"></i>

                <a href="macho-tabla.php" class="col-8 col-xl-5 mb-4 btn-script" >
                    Ir a la tabla
                </a>
                <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-4 btn-script" >
                    Ir al menú
                </a>
                <p class="mb-3" style="font-size:1.5rem;">Si el problema persiste, contactar a los desarrolladores.</p>
            </div> 
        </div>
        ';
    }
} else {
    echo "<script>alert('Hubo un error al recibir la peticion.');</script>";
    //echo "Error: " . $e->getMessage();
    echo '
    <div class="d-flex flex-row justify-content-center col-12">
        <div class="d-flex justify-content-center align-items-center flex-column mt-5 col-8" >
            <h1 class="mb-4 text-center" style="font-size:3rem;">Los datos no fueron enviados</h1>
            <i style="color:red;" class="col-8 col-xl-5 mb-5 text-center fa-regular fa-circle-xmark fa-3x"></i>

            <a href="macho-tabla.php" class="col-8 col-xl-5 mb-4 btn-script" >
                Ir a la tabla
            </a>
            <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-4 btn-script" >
                Ir al menú
            </a>
            <p class="mb-3" style="font-size:1.5rem;">Si el problema persiste, contactar a los desarrolladores.</p>
        </div> 
    </div> 
    ';
}
?>