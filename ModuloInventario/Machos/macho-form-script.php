<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<script src="https://kit.fontawesome.com/f7e7d9df55.js" crossorigin="anonymous"></script>


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
if (isset($_POST['macho_numero'])
    && isset($_POST['macho_arete'])
    && isset($_POST['macho_tatuaje'])
    && isset($_POST['macho_raza'])
    && isset($_POST['madre_numero'])
    && isset($_POST['madre_arete'])
    && isset($_POST['madre_tatuaje'])
    && isset($_POST['madre_raza'])
    && isset($_POST['padre_numero'])
    && isset($_POST['padre_arete'])
    && isset($_POST['padre_tatuaje'])
    && isset($_POST['padre_raza'])
    && isset($_POST['macho_color'])
    && isset($_POST['macho_talla'])
    && isset($_POST['macho_pelo'])
    && isset($_POST['macho_condicion'])
    && isset($_POST['macho_estatus'])
    && isset($_POST['macho_potrero'])
    && isset($_POST['macho_lote'])
    && isset($_POST['macho_estado_re'])
    && isset($_POST['macho_celo'])

    
    && isset($_POST['macho_finado'])
    && isset($_POST['macho_edad_actual'])
    && isset($_POST['macho_edad_destete'])
    && isset($_POST['macho_edad_venta'])
    && isset($_POST['macho_peso_nacimiento'])
    && isset($_POST['macho_peso_actual'])
    && isset($_POST['macho_peso_destete'])
    && isset($_POST['macho_peso_venta'])
    && isset($_POST['macho_gan_peso_dia'])
    && isset($_POST['macho_gan_peso_mes'])
    && isset($_POST['macho_peso_3meses'])
    && isset($_POST['macho_fecha_nacimiento'])
    && isset($_POST['macho_fecha_destete'])
    && isset($_POST['macho_fecha_aretado'])
    && isset($_POST['macho_fecha_tatuaje'])
    && isset($_POST['macho_fecha_fierro'])
  
    && isset($_POST['macho_fecha_venta'])



    && isset($_FILES['macho_foto'])
    && isset($_FILES['macho_foto_fierro'])
    && isset($_POST['macho_observaciones'])) {

    $random_number1 = rand(1, 1000);
    $random_number2 = rand(1, 1000);
    $macho_numero= $_POST['macho_numero'];
 
    $macho_directorioDestino = 'machos_fotos/';
    $macho_nombreArchivo = $macho_numero  . "_" . $_FILES['macho_foto']['name'];
    $macho_ubicacionTemporal = $_FILES['macho_foto']['tmp_name'];

    $fierro_directorioDestino = 'machos_fotos_fierro/';
    $fierro_nombreArchivo = $macho_numero . "_" . $_FILES['macho_foto_fierro']['name'];
    $fierro_ubicacionTemporal = $_FILES['macho_foto_fierro']['tmp_name'];
    
    // Mueve la imagen al directorio deseado
    if (move_uploaded_file($macho_ubicacionTemporal, $macho_directorioDestino . $macho_nombreArchivo)) {
       echo '<p class="text-center mt-4 mb-2 text-secondary">Imagen guardada en la carpeta: ' . $macho_directorioDestino . $macho_nombreArchivo . '</p>';
     
    } else {
        //echo "<script>alert('Informacion: No se seleccionó ninguna imagen.');</script>";
    }
       // Mueve la imagen al directorio deseado
    if (move_uploaded_file($fierro_ubicacionTemporal, $fierro_directorioDestino . $fierro_nombreArchivo)) {
        echo '<p class="text-center mb-0 pb-0 text-secondary">Imagen guardada en la carpeta: ' . $fierro_directorioDestino . $fierro_nombreArchivo . '</p>';
    
     } else {
         //echo "<script>alert('Informacion: No se seleccionó ninguna imagen.');</script>";
     }


    // Acceder y guardar en viariables los datos del formulario recibido
    
    $macho_arete= $_POST['macho_arete'];
    $macho_tatuaje= $_POST['macho_tatuaje'];
    $macho_raza= $_POST['macho_raza'];
    $madre_numero= $_POST['madre_numero'];
    $madre_arete= $_POST['madre_arete'];
    $madre_tatuaje= $_POST['madre_tatuaje'];
    $madre_raza= $_POST['madre_raza'];
    $padre_numero= $_POST['padre_numero'];
    $padre_arete= $_POST['padre_arete'];
    $padre_tatuaje= $_POST['padre_tatuaje'];
    $padre_raza= $_POST['padre_raza'];
    $macho_color= $_POST['macho_color'];
    $macho_talla = $_POST['macho_talla'];
    $macho_pelo= $_POST['macho_pelo'];
    $macho_condicion= $_POST['macho_condicion'];
    $macho_estatus= $_POST['macho_estatus'];
    $macho_potrero= $_POST['macho_potrero'];
    $macho_lote= $_POST['macho_lote'];
    $macho_estado_re= $_POST['macho_estado_re'];
    $macho_celo= $_POST['macho_celo'];


    $macho_finado= $_POST['macho_finado'];
    $macho_edad_actual= $_POST['macho_edad_actual'];
    $macho_edad_destete= $_POST['macho_edad_destete'];
    $macho_edad_venta= $_POST['macho_edad_venta'];
    $macho_peso_nacimiento= $_POST['macho_peso_nacimiento'];
    $macho_peso_actual= $_POST['macho_peso_actual'];
    $macho_peso_destete= $_POST['macho_peso_destete'];
    $macho_peso_venta= $_POST['macho_peso_venta'];
    $macho_gan_peso_dia= $_POST['macho_gan_peso_dia'];
    $macho_gan_peso_mes= $_POST['macho_gan_peso_mes'];
    $macho_peso_3meses= $_POST['macho_peso_3meses'];
    $macho_fecha_nacimiento= $_POST['macho_fecha_nacimiento'];
    $macho_fecha_destete= $_POST['macho_fecha_destete'];
    $macho_fecha_aretado= $_POST['macho_fecha_aretado'];
    $macho_fecha_tatuaje= $_POST['macho_fecha_tatuaje'];
    $macho_fecha_fierro= $_POST['macho_fecha_fierro'];
   
    $macho_fecha_venta= $_POST['macho_fecha_venta'];




    //si esta vacio el campo, llenar con ejemplo
    if (empty($_FILES['macho_foto']['name'])){
        $macho_foto_ruta = $macho_directorioDestino . "ejemplo.jpg";
    }
    //si no esta vacio, llenar con lo que vas a mandar
    else{
        $macho_foto_ruta = $macho_directorioDestino . $macho_nombreArchivo;
    }
    //-------------------------------------------------------------------------------------------
    //si esta vacio el campo, llenar con ejemplo
    if (empty($_FILES['macho_foto_fierro']['name'])){
        $fierro_foto_ruta = $fierro_directorioDestino . "ejemplo.jpg";
    }
    //si no esta vacio, llenar con lo que vas a mandar
    else{
       $fierro_foto_ruta = $fierro_directorioDestino . $fierro_nombreArchivo;
    }
    //$macho_foto_ruta = $macho_directorioDestino . $macho_nombreArchivo;
    //$fierro_foto_ruta = $fierro_directorioDestino . $fierro_nombreArchivo;
    $macho_observaciones= $_POST['macho_observaciones'];
 

    try {  
        //instancia que indica que la conexion "$conexion" de conexion.php sera usada aqui con PDO
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Consulta SQL con marcadores de posición
        $sql = "INSERT INTO machos (id_macho, macho_numero, macho_arete, macho_tatuaje, macho_raza, 
            madre_numero, madre_arete, madre_tatuaje, madre_raza, 
            padre_numero, padre_arete, padre_tatuaje, padre_raza, 
            macho_color, macho_talla, macho_pelo, macho_condicion, macho_estatus, macho_potrero, 
            macho_lote, macho_estado_re, macho_celo,  macho_finado, 
            macho_edad_actual, macho_edad_destete, macho_edad_venta, 
            macho_peso_nacimiento, macho_peso_actual, macho_peso_destete, macho_peso_venta, 
            macho_gan_peso_dia, macho_gan_peso_mes, macho_peso_3meses, 
            macho_fecha_nacimiento, macho_fecha_destete, macho_fecha_aretado, 
            macho_fecha_tatuaje, macho_fecha_fierro, macho_fecha_venta, 
            
            macho_foto, macho_foto_fierro, 
            macho_observaciones) VALUES (null, :macho_numero, :macho_arete, :macho_tatuaje, :macho_raza, 
            :madre_numero, :madre_arete, :madre_tatuaje, :madre_raza, 
            :padre_numero, :padre_arete, :padre_tatuaje, :padre_raza, 
            :macho_color, :macho_talla, :macho_pelo, :macho_condicion, :macho_estatus, :macho_potrero, 
            :macho_lote, :macho_estado_re, :macho_celo, :macho_finado, 
            :macho_edad_actual, :macho_edad_destete, :macho_edad_venta, 
            :macho_peso_nacimiento, :macho_peso_actual, :macho_peso_destete, :macho_peso_venta, 
            :macho_gan_peso_dia, :macho_gan_peso_mes, :macho_peso_3meses, 
            :macho_fecha_nacimiento, :macho_fecha_destete, :macho_fecha_aretado, 
            :macho_fecha_tatuaje, :macho_fecha_fierro, :macho_fecha_venta, 
             
            :macho_foto, :macho_foto_fierro, 
            :macho_observaciones)";
        $stmt = $conexion->prepare($sql); // Preparar la consulta
        // Vincular los valores a los marcadores de posición
        #$id_usuario=$_SESSION['id_usuario']; //insertar id del usuario actual en sesion para clave foranea
        //$stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':macho_numero', $macho_numero);
        $stmt->bindParam(':macho_arete', $macho_arete);
        $stmt->bindParam(':macho_tatuaje', $macho_tatuaje);
        $stmt->bindParam(':macho_raza', $macho_raza);
        $stmt->bindParam(':madre_numero', $madre_numero);
        $stmt->bindParam(':madre_arete', $madre_arete);
        $stmt->bindParam(':madre_tatuaje', $madre_tatuaje);
        $stmt->bindParam(':madre_raza', $madre_raza);
        $stmt->bindParam(':padre_numero', $padre_numero);
        $stmt->bindParam(':padre_arete', $padre_arete);
        $stmt->bindParam(':padre_tatuaje', $padre_tatuaje);
        $stmt->bindParam(':padre_raza', $padre_raza);
        $stmt->bindParam(':macho_color', $macho_color);
        $stmt->bindParam(':macho_talla', $macho_talla);
        $stmt->bindParam(':macho_pelo', $macho_pelo);
        $stmt->bindParam(':macho_condicion', $macho_condicion);
        $stmt->bindParam(':macho_estatus', $macho_estatus);
        $stmt->bindParam(':macho_potrero', $macho_potrero);
        $stmt->bindParam(':macho_lote', $macho_lote);
        $stmt->bindParam(':macho_estado_re', $macho_estado_re);
        $stmt->bindParam(':macho_celo', $macho_celo);


        $stmt->bindParam(':macho_finado', $macho_finado);
        $stmt->bindParam(':macho_edad_actual', $macho_edad_actual);
        $stmt->bindParam(':macho_edad_destete', $macho_edad_destete);
        $stmt->bindParam(':macho_edad_venta', $macho_edad_venta);
        $stmt->bindParam(':macho_peso_nacimiento', $macho_peso_nacimiento);
        $stmt->bindParam(':macho_peso_actual', $macho_peso_actual);
        $stmt->bindParam(':macho_peso_destete', $macho_peso_destete);
        $stmt->bindParam(':macho_peso_venta', $macho_peso_venta);
        $stmt->bindParam(':macho_gan_peso_dia', $macho_gan_peso_dia);
        $stmt->bindParam(':macho_gan_peso_mes', $macho_gan_peso_mes);
        $stmt->bindParam(':macho_peso_3meses', $macho_peso_3meses);
        $stmt->bindParam(':macho_fecha_nacimiento', $macho_fecha_nacimiento);
        $stmt->bindParam(':macho_fecha_destete', $macho_fecha_destete);
        $stmt->bindParam(':macho_fecha_aretado', $macho_fecha_aretado);
        $stmt->bindParam(':macho_fecha_tatuaje', $macho_fecha_tatuaje);
        $stmt->bindParam(':macho_fecha_fierro', $macho_fecha_fierro);

        $stmt->bindParam(':macho_fecha_venta', $macho_fecha_venta);



        $stmt->bindParam(':macho_foto', $macho_foto_ruta);
        $stmt->bindParam(':macho_foto_fierro', $fierro_foto_ruta);
        $stmt->bindParam(':macho_observaciones', $macho_observaciones);
        
        $stmt->execute();
        $conexion = null;
        echo "<script>alert('Registro guardado con éxito');</script>";
        echo '
        <div class="d-flex col-12 justify-content-center align-items-center flex-column mt-5" style="width:100%;">
            <h2 class="mb-3 text-center">Los datos se han enviado correctamente.</h2>
            <i style="color:green;" class="col-8 col-xl-5 mb-3 text-center fa-solid fa-circle-check fa-3x"></i>
            <a href="macho-form.php" class="col-8 col-xl-5 mb-3 btn btn-success" >
                Registrar otra hoja de vida
            </a>
            <a href="macho-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
                Ir a la tabla
            </a>
            <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-3 btn btn-secondary" >
                Ir al menú
            </a>
        </div> 
        ';

    } catch (PDOException $e) {
        // Error cuando no se ejecuta la consulta SQL
        echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
        //echo "Error: " . $e->getMessage();
        echo '
        <div class="d-flex col-12 justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
            <h2 class="mb-3">Los datos no fueron enviados</h2>
            <i style="color:red;" class="col-8 col-xl-5 mb-3 text-center fa-regular fa-circle-xmark fa-3x"></i>
            <a href="macho-form.php" class="col-8 col-xl-5 mb-3 btn btn-warning" >
                Regresar al formulario
            </a>
            <a href="macho-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
                Ir a la tabla
            </a>
            <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-5 btn btn-secondary" >
                Ir al menú
            </a>
            <p class="mb-3">Si el problema persiste, contactar a los desarrolladores</p>
        </div> 
        ';
    }  
    
}else {
    echo "<script>alert('Hubo un error al recibir el formulario.');</script>";
    //echo "Error: " . $e->getMessage();
    echo '
    <div class="d-flex col-12 justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
        <h2 class="mb-3">Los datos no fueron enviados</h2>
        <i style="color:red;" class="col-8 col-xl-5 mb-3 text-center fa-regular fa-circle-xmark fa-3x"></i>
        <a href="macho-form.php" class="col-8 col-xl-5 mb-3 btn btn-warning" >
            Regresar al formulario
        </a>
        <a href="macho-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
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
