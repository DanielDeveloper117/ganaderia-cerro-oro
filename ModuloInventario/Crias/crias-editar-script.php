<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<script src="https://kit.fontawesome.com/f7e7d9df55.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../styles/styles-crias.css">

<?php
include("../../conexion.php");


//------------------------------------------------------------------- si el campo de foto tiene una nueva foto actualizar todo, incluyendo la foto
            if (isset($_POST['id_cria']) 
            && isset($_POST['madre_numero'])
            && isset($_POST['cria_edad'])
            && isset($_POST['cria_sexo'])
            && isset($_POST['cria_fecha_nacimiento'])
            && isset($_POST['cria_numero'])
            && isset($_POST['cria_arete'])
            && isset($_POST['cria_tatuaje'])
            && isset($_POST['cria_estado_arete'])
            && isset($_POST['cria_raza'])
            && isset($_POST['cria_peso_actual'])

            && isset($_POST['cria_peso_nacimiento'])
            && isset($_POST['cria_peso_destete'])
            && isset($_POST['cria_peso_venta'])
            && isset($_POST['cria_finada'])
            && isset($_POST['cria_fecha_destete'])
            && isset($_POST['cria_fecha_aretado'])
            && isset($_POST['cria_fecha_tatuaje'])
            && isset($_POST['cria_fecha_fierro'])
            && isset($_POST['cria_fecha_venta'])
            && isset($_POST['cria_observaciones']) 
            && isset($_FILES['cria_foto'])
            && isset($_FILES['cria_foto_fierro'])){

            $random_number1 = rand(1, 1000);
            $random_number2 = rand(1, 1000);
            
            $cria_directorioDestino = 'crias_fotos/';
            $cria_nombreArchivo =  $_POST['cria_numero'] . "_" . $_FILES['cria_foto']['name'];
            $cria_ubicacionTemporal = $_FILES['cria_foto']['tmp_name'];
            
            $fierro_directorioDestino = 'crias_fotos_fierro/';
            $fierro_nombreArchivo = $_POST['cria_numero'] . "_" . $_FILES['cria_foto_fierro']['name'];
            $fierro_ubicacionTemporal = $_FILES['cria_foto_fierro']['tmp_name'];

            // Mueve la imagen al directorio deseado
            if (move_uploaded_file($cria_ubicacionTemporal, $cria_directorioDestino . $cria_nombreArchivo)) {
                //  echo "La imagen se ha guardado correctamente en la carpeta 'crias_fotos'";
                //  echo '</br>';
            } else {
                //echo "<script>alert('Informacion: No se seleccionó ninguna imagen.');</script>";
            }
            // Mueve la imagen al directorio deseado
            if (move_uploaded_file($fierro_ubicacionTemporal, $fierro_directorioDestino . $fierro_nombreArchivo)) {
                //  echo "La imagen se ha guardado correctamente en la carpeta 'crias_fotos_fierro'";
                //  echo '</br>';
            } else {
                 //echo "<script>alert('Informacion: No se seleccionó ninguna imagen.');</script>";
            }

            // Acceder y guardar en VARIABLES los datos del formulario recibido
            $id_cria= $_POST['id_cria'];
            $madre_numero= $_POST['madre_numero'];
            $cria_edad= $_POST['cria_edad'];
            $cria_sexo= $_POST['cria_sexo'];
            $cria_fecha_nacimiento= $_POST['cria_fecha_nacimiento'];
            
            $cria_numero= $_POST['cria_numero'];
            $cria_arete= $_POST['cria_arete'];
            $cria_tatuaje= $_POST['cria_tatuaje'];
            $cria_estado_arete= $_POST['cria_estado_arete'];
            $cria_raza= $_POST['cria_raza'];

            $cria_peso_actual= $_POST['cria_peso_actual'];
            $cria_peso_nacimiento= $_POST['cria_peso_nacimiento'];            
            $cria_peso_destete= $_POST['cria_peso_destete'];
            $cria_peso_venta= $_POST['cria_peso_venta'];
            $cria_finada= $_POST['cria_finada'];

            $cria_fecha_destete= $_POST['cria_fecha_destete'];
            $cria_fecha_aretado= $_POST['cria_fecha_aretado'];
            $cria_fecha_tatuaje= $_POST['cria_fecha_tatuaje'];
            $cria_fecha_fierro= $_POST['cria_fecha_fierro'];
            $cria_fecha_venta= $_POST['cria_fecha_venta'];
    
            $sql = "SELECT id_cria,
            cria_foto, cria_foto_fierro 
             FROM crias WHERE id_cria = :id_cria";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_cria', $id_cria); 
            $stmt->execute();

            $arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC);

            //si esta vacio el que me mandaste y esta vacio en la bd, llenar con ejemplo
            if (empty($_FILES['cria_foto']['name']) and empty($arreglo_sql['cria_foto'])){
                $cria_foto_ruta = $cria_directorioDestino . "ejemplo.jpg";
            }
            //si no esta vacio el que me mandaste o hay algo en la bd, llenar con el de la bd
            if(!empty($_FILES['cria_foto']['name']) or  !empty($arreglo_sql['cria_foto']) ){
                $cria_foto_ruta=$arreglo_sql['cria_foto'];
            }
            //si no esta vacio en la que me mandaste, llenar con lo que vas a mandar
            if(!empty($_FILES['cria_foto']['name'])){
                $cria_foto_ruta = $cria_directorioDestino . $cria_nombreArchivo;
            }
            //-------------------------------------------------------------------------------------------
            //si esta vacio el que me mandaste y esta vacio en la bd, llenar con ejemplo
            if (empty($_FILES['cria_foto_fierro']['name']) and empty($arreglo_sql['cria_foto_fierro'])){
                $fierro_foto_ruta = $fierro_directorioDestino . "ejemplo.jpg";
            }
            //si no esta vacio el que me mandaste o hay algo en la bd, llenar con el de la bd
            if(!empty($_FILES['cria_foto_fierro']['name']) or !empty($arreglo_sql['cria_foto_fierro']) ){
                $fierro_foto_ruta=$arreglo_sql['cria_foto_fierro'];
            }
            //si no esta vacio en la que me mandaste, llenar con lo que vas a mandar
            if(!empty($_FILES['cria_foto_fierro']['name'])){
               $fierro_foto_ruta = $fierro_directorioDestino . $fierro_nombreArchivo;
            }

            $cria_observaciones= $_POST['cria_observaciones'];

            //intentar la consulta de actualizar todos los campos
            try {
                //instancia que indica que la conexion "$conexion" de conexion.php sera usada aqui con PDO
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Construir la consulta de inserción con marcadores de posición
                $sql = "UPDATE crias SET 
                madre_numero = :madre_numero, 
                cria_edad = :cria_edad, 
                cria_sexo = :cria_sexo, 
                cria_fecha_nacimiento = :cria_fecha_nacimiento,
                cria_numero = :cria_numero, 
                cria_arete = :cria_arete, 
                cria_estado_arete = :cria_estado_arete, 
                cria_tatuaje = :cria_tatuaje, 
                cria_raza = :cria_raza, 
                cria_peso_actual = :cria_peso_actual, 
                cria_peso_nacimiento = :cria_peso_nacimiento, 
                cria_peso_destete = :cria_peso_destete, 
                cria_peso_venta = :cria_peso_venta, 
                cria_finada = :cria_finada, 
                cria_fecha_destete = :cria_fecha_destete, 
                cria_fecha_aretado = :cria_fecha_aretado, 
                cria_fecha_tatuaje = :cria_fecha_tatuaje, 
                cria_fecha_fierro = :cria_fecha_fierro, 
                cria_fecha_venta = :cria_fecha_venta,
                cria_foto = :cria_foto, 
                cria_foto_fierro = :cria_foto_fierro,   
                cria_observaciones = :cria_observaciones  
                WHERE id_cria = :id_cria";
                $stmt = $conexion->prepare($sql);

                // Vincular los valores a los marcadores de posición de las columnas de la consulta
                $stmt->bindParam(':id_cria', $id_cria);
                $stmt->bindParam(':madre_numero', $madre_numero);   
                $stmt->bindParam(':cria_edad', $cria_edad);   
                $stmt->bindParam(':cria_sexo', $cria_sexo);  
                $stmt->bindParam(':cria_fecha_nacimiento', $cria_fecha_nacimiento);

                $stmt->bindParam(':cria_numero', $cria_numero);
                $stmt->bindParam(':cria_arete', $cria_arete);
                $stmt->bindParam(':cria_tatuaje', $cria_tatuaje);
                $stmt->bindParam(':cria_estado_arete', $cria_estado_arete);
                $stmt->bindParam(':cria_raza', $cria_raza);

                $stmt->bindParam(':cria_peso_actual', $cria_peso_actual);
                $stmt->bindParam(':cria_peso_nacimiento', $cria_peso_nacimiento);
                $stmt->bindParam(':cria_peso_destete', $cria_peso_destete);
                $stmt->bindParam(':cria_peso_venta', $cria_peso_venta);
                $stmt->bindParam(':cria_finada', $cria_finada);

                $stmt->bindParam(':cria_fecha_destete', $cria_fecha_destete);
                $stmt->bindParam(':cria_fecha_aretado', $cria_fecha_aretado);
                $stmt->bindParam(':cria_fecha_tatuaje', $cria_fecha_tatuaje);
                $stmt->bindParam(':cria_fecha_fierro', $cria_fecha_fierro);
                $stmt->bindParam(':cria_fecha_venta', $cria_fecha_venta);
                $stmt->bindParam(':cria_foto', $cria_foto_ruta);
                $stmt->bindParam(':cria_foto_fierro', $fierro_foto_ruta);
                $stmt->bindParam(':cria_observaciones', $cria_observaciones);

                $stmt->execute();
                $conexion = null;

                echo "<script>alert('Registro actualizado con éxito');</script>";
                echo '
                <div class="d-flex flex-row justify-content-center col-12">
                    <div class="d-flex justify-content-center align-items-center flex-column mt-3 col-8" >
                        <h1 class="mb-4 text-center" style="font-size:3rem;">Los datos se han actualizado correctamente.</h1>
                        <i style="color:green;" class="col-8 col-xl-5 mb-5 text-center fa-solid fa-circle-check fa-3x"></i>
                        <a href="crias-tabla.php" class="col-8 col-xl-5 mb-4 btn-script" >
                            Ir a la tabla de crías
                        </a>                        
                        <a href="../Vacas/hembra-tabla.php" class="col-8 col-xl-5 mb-4 btn-script" >
                            Ir a la tabla de hembras
                        </a>
                        <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-4 btn-script" >
                            Ir al menú
                        </a>
                    </div> 
                </div>
                ';

            
            } catch (PDOException $e) {
                // Error cuando no se ejecuta la consulta SQL
                echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
                echo "Error: " . $e->getMessage();
                echo '
                <div class="d-flex flex-row justify-content-center col-12">
                    <div class="d-flex justify-content-center align-items-center flex-column mt-5 col-8" >
                        <h1 class="mb-4 text-center" style="font-size:3rem;">Los datos no fueron enviados</h1>
                        <i style="color:red;" class="col-8 col-xl-5 mb-5 text-center fa-regular fa-circle-xmark fa-3x"></i>
                        <a href="crias-tabla.php" class="col-8 col-xl-5 mb-4 btn-script" >
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
        
        }else {
            echo "<script>alert('Hubo un error al recibir el formulario.');</script>";
            echo '
            <div class="d-flex flex-row justify-content-center col-12">
                <div class="d-flex justify-content-center align-items-center flex-column mt-5 col-8" >
                    <h1 class="mb-4 text-center" style="font-size:3rem;">Los datos no fueron enviados</h1>
                    <i style="color:red;" class="col-8 col-xl-5 mb-5 text-center fa-regular fa-circle-xmark fa-3x"></i>
                    <a href="crias-tabla.php" class="col-8 col-xl-5 mb-4 btn-script" >
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