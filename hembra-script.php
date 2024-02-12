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
if (isset($_POST['vaca_numero'])
    && isset($_POST['vaca_arete'])
    && isset($_POST['vaca_tatuaje'])
    && isset($_POST['vaca_raza'])
    && isset($_POST['madre_numero'])
    && isset($_POST['madre_arete'])
    && isset($_POST['madre_tatuaje'])
    && isset($_POST['madre_raza'])
    && isset($_POST['padre_numero'])
    && isset($_POST['padre_arete'])
    && isset($_POST['padre_tatuaje'])
    && isset($_POST['padre_raza'])
    && isset($_POST['vaca_color'])
    && isset($_POST['vaca_talla'])
    && isset($_POST['vaca_pelo'])
    && isset($_POST['vaca_condicion'])
    && isset($_POST['vaca_estatus'])
    && isset($_POST['vaca_potrero'])
    && isset($_POST['vaca_lote'])
    && isset($_POST['vaca_estado_re'])
    && isset($_POST['vaca_celo'])
    && isset($_POST['vaca_partos'])
    && isset($_POST['vaca_estado_pal'])
    && isset($_POST['vaca_finada'])
    && isset($_POST['vaca_edad_actual'])
    && isset($_POST['vaca_edad_destete'])
    && isset($_POST['vaca_edad_venta'])
    && isset($_POST['vaca_peso_nacimiento'])
    && isset($_POST['vaca_peso_actual'])
    && isset($_POST['vaca_peso_destete'])
    && isset($_POST['vaca_peso_venta'])
    && isset($_POST['vaca_gan_peso_dia'])
    && isset($_POST['vaca_gan_peso_mes'])
    && isset($_POST['vaca_peso_3meses'])
    && isset($_POST['vaca_fecha_nacimiento'])
    && isset($_POST['vaca_fecha_destete'])
    && isset($_POST['vaca_fecha_aretado'])
    && isset($_POST['vaca_fecha_tatuaje'])
    && isset($_POST['vaca_fecha_fierro'])
    && isset($_POST['vaca_fecha_probable'])
    && isset($_POST['vaca_fecha_venta'])
    && isset($_FILES['vaca_foto'])
    && isset($_FILES['vaca_foto_fierro'])
    && isset($_POST['vaca_observaciones'])) {

    $random_number1 = rand(1, 1000);
    $random_number2 = rand(1, 1000);
 
    $vaca_directorioDestino = 'vacas_fotos/';
    $vaca_nombreArchivo =  $_POST['vaca_numero'] . "_" . $_FILES['vaca_foto']['name'];
    $vaca_ubicacionTemporal = $_FILES['vaca_foto']['tmp_name'];

    $fierro_directorioDestino = 'vacas_fotos_fierro/';
    $fierro_nombreArchivo = $_POST['vaca_numero'] . "_" . $_FILES['vaca_foto_fierro']['name'];
    $fierro_ubicacionTemporal = $_FILES['vaca_foto_fierro']['tmp_name'];
    
    // Mueve la imagen al directorio deseado
    if (move_uploaded_file($vaca_ubicacionTemporal, $vaca_directorioDestino . $vaca_nombreArchivo)) {
       echo "La imagen se ha guardado correctamente en la carpeta 'vacas_fotos'.";
       echo '</br>';
    } else {
        echo "<script>alert('Informacion: No se seleccionó ninguna imagen.');</script>";
    }
       // Mueve la imagen al directorio deseado
       if (move_uploaded_file($fierro_ubicacionTemporal, $fierro_directorioDestino . $fierro_nombreArchivo)) {
        echo "La imagen se ha guardado correctamente en la carpeta 'vacas_fotos_fierro'.";
        echo '</br>';
     } else {
         echo "<script>alert('Informacion: No se seleccionó ninguna imagen.');</script>";
     }


    // Acceder y guardar en viariables los datos del formulario recibido
    $vaca_numero= $_POST['vaca_numero'];
    $vaca_arete= $_POST['vaca_arete'];
    $vaca_tatuaje= $_POST['vaca_tatuaje'];
    $vaca_raza= $_POST['vaca_raza'];
    $madre_numero= $_POST['madre_numero'];
    $madre_arete= $_POST['madre_arete'];
    $madre_tatuaje= $_POST['madre_tatuaje'];
    $madre_raza= $_POST['madre_raza'];
    $padre_numero= $_POST['padre_numero'];
    $padre_arete= $_POST['padre_arete'];
    $padre_tatuaje= $_POST['padre_tatuaje'];
    $padre_raza= $_POST['padre_raza'];
    $vaca_color= $_POST['vaca_color'];
    $vaca_talla = $_POST['vaca_talla'];
    $vaca_pelo= $_POST['vaca_pelo'];
    $vaca_condicion= $_POST['vaca_condicion'];
    $vaca_estatus= $_POST['vaca_estatus'];
    $vaca_potrero= $_POST['vaca_potrero'];
    $vaca_lote= $_POST['vaca_lote'];
    $vaca_estado_re= $_POST['vaca_estado_re'];
    $vaca_celo= $_POST['vaca_celo'];
    $vaca_partos= $_POST['vaca_partos'];
    $vaca_estado_pal= $_POST['vaca_estado_pal'];
    $vaca_finada= $_POST['vaca_finada'];
    $vaca_edad_actual= $_POST['vaca_edad_actual'];
    $vaca_edad_destete= $_POST['vaca_edad_destete'];
    $vaca_edad_venta= $_POST['vaca_edad_venta'];
    $vaca_peso_nacimiento= $_POST['vaca_peso_nacimiento'];
    $vaca_peso_actual= $_POST['vaca_peso_actual'];
    $vaca_peso_destete= $_POST['vaca_peso_destete'];
    $vaca_peso_venta= $_POST['vaca_peso_venta'];
    $vaca_gan_peso_dia= $_POST['vaca_gan_peso_dia'];
    $vaca_gan_peso_mes= $_POST['vaca_gan_peso_mes'];
    $vaca_peso_3meses= $_POST['vaca_peso_3meses'];
    $vaca_fecha_nacimiento= $_POST['vaca_fecha_nacimiento'];
    $vaca_fecha_destete= $_POST['vaca_fecha_destete'];
    $vaca_fecha_aretado= $_POST['vaca_fecha_aretado'];
    $vaca_fecha_tatuaje= $_POST['vaca_fecha_tatuaje'];
    $vaca_fecha_fierro= $_POST['vaca_fecha_fierro'];
    $vaca_fecha_probable= $_POST['vaca_fecha_probable'];
    $vaca_fecha_venta= $_POST['vaca_fecha_venta'];
    $vaca_foto_ruta = $vaca_directorioDestino . $vaca_nombreArchivo;
    $fierro_foto_ruta = $fierro_directorioDestino . $fierro_nombreArchivo;
    $vaca_observaciones= $_POST['vaca_observaciones'];
 

    try {  
        //instancia que indica que la conexion "$conexion" de conexion.php sera usada aqui con PDO
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Consulta SQL con marcadores de posición
        $sql = "INSERT INTO vacas (id_vaca, vaca_numero, vaca_arete, vaca_tatuaje, vaca_raza, 
            madre_numero, madre_arete, madre_tatuaje, madre_raza, 
            padre_numero, padre_arete, padre_tatuaje, padre_raza, 
            vaca_color, vaca_talla, vaca_pelo, vaca_condicion, vaca_estatus, vaca_potrero, 
            vaca_lote, vaca_estado_re, vaca_celo, vaca_partos, vaca_estado_pal, vaca_finada, 
            vaca_edad_actual, vaca_edad_destete, vaca_edad_venta, 
            vaca_peso_nacimiento, vaca_peso_actual, vaca_peso_destete, vaca_peso_venta, 
            vaca_gan_peso_dia, vaca_gan_peso_mes, vaca_peso_3meses, 
            vaca_fecha_nacimiento, vaca_fecha_destete, vaca_fecha_aretado, 
            vaca_fecha_tatuaje, vaca_fecha_fierro, vaca_fecha_probable, vaca_fecha_venta, 
            vaca_foto, vaca_foto_fierro, 
            vaca_observaciones) VALUES (null, :vaca_numero, :vaca_arete, :vaca_tatuaje, :vaca_raza, 
            :madre_numero, :madre_arete, :madre_tatuaje, :madre_raza, 
            :padre_numero, :padre_arete, :padre_tatuaje, :padre_raza, 
            :vaca_color, :vaca_talla, :vaca_pelo, :vaca_condicion, :vaca_estatus, :vaca_potrero, 
            :vaca_lote, :vaca_estado_re, :vaca_celo, :vaca_partos, :vaca_estado_pal, :vaca_finada, 
            :vaca_edad_actual, :vaca_edad_destete, :vaca_edad_venta, 
            :vaca_peso_nacimiento, :vaca_peso_actual, :vaca_peso_destete, :vaca_peso_venta, 
            :vaca_gan_peso_dia, :vaca_gan_peso_mes, :vaca_peso_3meses, 
            :vaca_fecha_nacimiento, :vaca_fecha_destete, :vaca_fecha_aretado, 
            :vaca_fecha_tatuaje, :vaca_fecha_fierro, :vaca_fecha_probable, :vaca_fecha_venta, 
            :vaca_foto, :vaca_foto_fierro, 
            :vaca_observaciones)";
        $stmt = $conexion->prepare($sql); // Preparar la consulta
        // Vincular los valores a los marcadores de posición
        #$id_usuario=$_SESSION['id_usuario']; //insertar id del usuario actual en sesion para clave foranea
        //$stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':vaca_numero', $vaca_numero);
        $stmt->bindParam(':vaca_arete', $vaca_arete);
        $stmt->bindParam(':vaca_tatuaje', $vaca_tatuaje);
        $stmt->bindParam(':vaca_raza', $vaca_raza);
        $stmt->bindParam(':madre_numero', $madre_numero);
        $stmt->bindParam(':madre_arete', $madre_arete);
        $stmt->bindParam(':madre_tatuaje', $madre_tatuaje);
        $stmt->bindParam(':madre_raza', $madre_raza);
        $stmt->bindParam(':padre_numero', $padre_numero);
        $stmt->bindParam(':padre_arete', $padre_arete);
        $stmt->bindParam(':padre_tatuaje', $padre_tatuaje);
        $stmt->bindParam(':padre_raza', $padre_raza);
        $stmt->bindParam(':vaca_color', $vaca_color);
        $stmt->bindParam(':vaca_talla', $vaca_talla);
        $stmt->bindParam(':vaca_pelo', $vaca_pelo);
        $stmt->bindParam(':vaca_condicion', $vaca_condicion);
        $stmt->bindParam(':vaca_estatus', $vaca_estatus);
        $stmt->bindParam(':vaca_potrero', $vaca_potrero);
        $stmt->bindParam(':vaca_lote', $vaca_lote);
        $stmt->bindParam(':vaca_estado_re', $vaca_estado_re);
        $stmt->bindParam(':vaca_celo', $vaca_celo);
        $stmt->bindParam(':vaca_partos', $vaca_partos);
        $stmt->bindParam(':vaca_estado_pal', $vaca_estado_pal);
        $stmt->bindParam(':vaca_finada', $vaca_finada);
        $stmt->bindParam(':vaca_edad_actual', $vaca_edad_actual);
        $stmt->bindParam(':vaca_edad_destete', $vaca_edad_destete);
        $stmt->bindParam(':vaca_edad_venta', $vaca_edad_venta);
        $stmt->bindParam(':vaca_peso_nacimiento', $vaca_peso_nacimiento);
        $stmt->bindParam(':vaca_peso_actual', $vaca_peso_actual);
        $stmt->bindParam(':vaca_peso_destete', $vaca_peso_destete);
        $stmt->bindParam(':vaca_peso_venta', $vaca_peso_venta);
        $stmt->bindParam(':vaca_gan_peso_dia', $vaca_gan_peso_dia);
        $stmt->bindParam(':vaca_gan_peso_mes', $vaca_gan_peso_mes);
        $stmt->bindParam(':vaca_peso_3meses', $vaca_peso_3meses);
        $stmt->bindParam(':vaca_fecha_nacimiento', $vaca_fecha_nacimiento);
        $stmt->bindParam(':vaca_fecha_destete', $vaca_fecha_destete);
        $stmt->bindParam(':vaca_fecha_aretado', $vaca_fecha_aretado);
        $stmt->bindParam(':vaca_fecha_tatuaje', $vaca_fecha_tatuaje);
        $stmt->bindParam(':vaca_fecha_fierro', $vaca_fecha_fierro);
        $stmt->bindParam(':vaca_fecha_probable', $vaca_fecha_probable);
        $stmt->bindParam(':vaca_fecha_venta', $vaca_fecha_venta);
        $stmt->bindParam(':vaca_foto', $vaca_foto_ruta);
        $stmt->bindParam(':vaca_foto_fierro', $fierro_foto_ruta);
        $stmt->bindParam(':vaca_observaciones', $vaca_observaciones);
        
        $stmt->execute();
        $conexion = null;
        echo "<script>alert('Registro guardado con éxito');</script>";
        echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
        <h2 style="margin-bottom:20px;">Los datos se han enviado correctamente.</h2>
        <a href="hembra.php" class="btn btn-success" ><i class="bi bi-arrow-left"></i>Regresar al formulario</a>
        <a href="hembra-tabla.php"><button class="form-control btn-primary mt-3" style="" >Ir a la tabla</button></a> </div> ';

    } catch (PDOException $e) {
        // Error cuando no se ejecuta la consulta SQL
        echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
        echo "Error: " . $e->getMessage();
        echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
        <h2 style="margin-bottom:20px;">Error: los datos no fueron enviados.</h2>
        <a href="hembra.php" class="btn btn-warning" ><i class="bi bi-arrow-left"></i>Regresar</a></div>';
    }  
    
}else {
    echo "<script>alert('Hubo un error al recibir el formulario.');</script>";
    echo '<div class="d-flex justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
    <h2 style="margin-bottom:20px;">Error: los datos no fueron enviados.</h2>
    <a href="hembra.php" class="btn btn-warning" ><i class="bi bi-arrow-left"></i>Regresar</a></div>';
}

?>
