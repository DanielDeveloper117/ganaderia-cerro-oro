<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<?php
include("conexion.php");
// session_start();

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: login.html");
//     exit;
// } else {
//     echo 'Usuario autenticado con ID: '.$_SESSION['id_usuario'].'</br>';
// }

// Verificar si se han recibido los datos desde el formulario
if (isset($_POST['padre_raza']) && isset($_POST['madre_num']) && isset($_POST['madre_raza']) 
    && isset($_POST['fecha_nacimiento']) && isset($_POST['fecha_destete']) && isset($_POST['fecha_venta']) 
    && isset($_POST['edad_actual']) && isset($_POST['edad_destete']) && isset($_POST['edad_venta']) 
    && isset($_POST['peso_nacimiento']) && isset($_POST['peso_3meses']) && isset($_POST['peso_destete']) && isset($_POST['peso_venta']) 
    && isset($_POST['ganancia_peso_dia']) && isset($_POST['ganancia_peso_mes']) && isset($_POST['finado']) 
    && isset($_POST['cria_num']) && isset($_POST['cria_arete']) && isset($_POST['destino_cria']) 
    && isset($_POST['toro_num']) && isset($_POST['toro_arete']) && isset($_POST['toro_raza']) && isset($_POST['fecha_aretado']) 
    && isset($_POST['estatus']) && isset($_POST['potrero']) && isset($_POST['lote'])&& isset($_POST['estado_reproductivo'])
    && isset($_POST['celo']) 
    && isset($_FILES['foto']) 
    && isset($_POST['observaciones'])) {

    $directorioDestino = 'fotografias/';
    $nombreArchivo = $_FILES['foto']['name'];
    $ubicacionTemporal = $_FILES['foto']['tmp_name'];
    
    // Mueve la imagen al directorio deseado
    if (move_uploaded_file($ubicacionTemporal, $directorioDestino . $nombreArchivo)) {
       // echo "La imagen se ha guardado correctamente en la carpeta 'fotografias'.";
    } else {
       // echo "<script>alert('No se seleccionó ninguna imagen.');</script>";
    }
    // Acceder y guardar en viariables los datos del formulario recibido
    $padre_num = $_POST['padre_num'];
    $padre_raza = $_POST['padre_raza'];
    $madre_num = $_POST['madre_num'];
    $madre_raza = $_POST['madre_raza'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_destete = $_POST['fecha_destete'];
    $fecha_venta = $_POST['fecha_venta'];
    $edad_actual = $_POST['edad_actual'];
    $edad_destete = $_POST['edad_destete'];
    $edad_venta = $_POST['edad_venta'];
    $peso_nacimiento = $_POST['peso_nacimiento'];
    $peso_3meses = $_POST['peso_3meses'];
    $peso_destete = $_POST['peso_destete'];
    $peso_venta = $_POST['peso_venta'];
    $ganancia_peso_dia = $_POST['ganancia_peso_dia'];
    $ganancia_peso_mes = $_POST['ganancia_peso_mes'];
    $finado = $_POST['finado'];
    $cria_num = $_POST['cria_num'];
    $cria_arete = $_POST['cria_arete'];
    $destino_cria = $_POST['destino_cria'];
    $toro_num = $_POST['toro_num'];
    $toro_arete = $_POST['toro_arete'];
    $toro_raza = $_POST['toro_raza'];
    $fecha_aretado = $_POST['fecha_aretado'];
    $estatus = $_POST['estatus'];
    $potrero = $_POST['potrero'];
    $lote = $_POST['lote'];
    $estado_reproductivo = $_POST['estado_reproductivo'];
    $celo = $_POST['celo'];
    $observaciones = $_POST['observaciones'];
    $foto_ruta = $directorioDestino . $nombreArchivo;

    try {
        //instancia que indica que la conexion "$conexion" de conexion.php sera usada aqui con PDO
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Construir la consulta de inserción con marcadores de posición
        $sql = "INSERT INTO macho (id_toro, padre_num, padre_raza, madre_num, madre_raza, 
        fecha_nacimiento, fecha_destete, fecha_venta, edad_actual, edad_destete, edad_venta,
        peso_nacimiento, peso_3meses, peso_destete, peso_venta, ganancia_peso_dia, ganancia_peso_mes,
        finado, cria_num, cria_arete, destino_cria, toro_num, toro_arete, toro_raza, fecha_aretado,
        estatus, potrero, lote, estado_reproductivo, celo, foto, observaciones)
         VALUES (null, :padre_num, :padre_raza, :madre_num, :madre_raza, 
        :fecha_nacimiento, :fecha_destete, :fecha_venta, :edad_actual, :edad_destete, :edad_venta,
        :peso_nacimiento, :peso_3meses, :peso_destete, :peso_venta, :ganancia_peso_dia, :ganancia_peso_mes,
        :finado, :cria_num, :cria_arete, :destino_cria, :toro_num, :toro_arete, :toro_raza, :fecha_aretado,
        :estatus, :potrero, :lote, :estado_reproductivo, :celo, :foto, :observaciones)";
        $stmt = $conexion->prepare($sql); // Preparar la consulta
        // Vincular los valores a los marcadores de posición
        #$id_usuario=$_SESSION['id_usuario']; //insertar id del usuario actual en sesion para clave foranea
        //$stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':padre_num', $padre_num);
        $stmt->bindParam(':padre_raza', $padre_raza);
        $stmt->bindParam(':madre_num', $madre_num);
        $stmt->bindParam(':madre_raza', $madre_raza);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':fecha_destete', $fecha_destete);
        $stmt->bindParam(':fecha_venta', $fecha_venta);
        $stmt->bindParam(':edad_actual', $edad_actual);
        $stmt->bindParam(':edad_destete', $edad_destete);
        $stmt->bindParam(':edad_venta', $edad_venta);
        $stmt->bindParam(':peso_nacimiento', $peso_nacimiento);
        $stmt->bindParam(':peso_3meses', $peso_3meses);
        $stmt->bindParam(':peso_destete', $peso_destete);
        $stmt->bindParam(':peso_venta', $peso_venta);
        $stmt->bindParam(':ganancia_peso_dia', $ganancia_peso_dia);
        $stmt->bindParam(':ganancia_peso_mes', $ganancia_peso_mes);
        $stmt->bindParam(':finado', $finado);
        $stmt->bindParam(':cria_num', $cria_num);
        $stmt->bindParam(':cria_arete', $cria_arete);
        $stmt->bindParam(':destino_cria', $destino_cria);
        $stmt->bindParam(':toro_num', $toro_num);
        $stmt->bindParam(':toro_arete', $toro_arete);
        $stmt->bindParam(':toro_raza', $toro_raza);
        $stmt->bindParam(':fecha_aretado', $fecha_aretado);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':potrero', $potrero);
        $stmt->bindParam(':lote', $lote);
        $stmt->bindParam(':estado_reproductivo', $estado_reproductivo);
        $stmt->bindParam(':celo', $celo);
        $stmt->bindParam(':foto', $foto_ruta);
        $stmt->bindParam(':observaciones', $observaciones);
        $stmt->execute();
        $conexion = null;
        echo "<script>alert('Registro guardado con éxito');</script>";
        echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
        <h2 style="margin-bottom:20px;">Los datos se han enviado correctamente.</h2>
        <a href="macho.php" class="btn btn-success" ><i class="bi bi-arrow-left"></i>Regresar al formulario</a>
        <a href="macho-tabla.php"><button class="form-control btn-primary mt-3" style="" >Ir a la tabla</button></a> </div> ';

    } catch (PDOException $e) {
        // Error cuando no se ejecuta la consulta SQL
        echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
        echo "Error: " . $e->getMessage();
        echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
        <h2 style="margin-bottom:20px;">Error: los datos no fueron enviados.</h2>
        <a href="macho.php" class="btn btn-warning" ><i class="bi bi-arrow-left"></i>Regresar</a></div>';
    }  
    
}else {
    echo "<script>alert('Hubo un error al recibir el formulario.');</script>";
    echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
    <h2 style="margin-bottom:20px;">Error: los datos no fueron enviados.</h2>
    <a href="macho.php" class="btn btn-warning" ><i class="bi bi-arrow-left"></i>Regresar</a></div>';
}

?>