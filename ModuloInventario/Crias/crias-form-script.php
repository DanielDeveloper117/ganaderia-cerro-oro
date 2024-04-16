<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<script src="https://kit.fontawesome.com/f7e7d9df55.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../styles/styles-crias.css">

<?php
include("../../conexion.php");

//------------------------------------------------------------------- si el campo de foto tiene una nueva foto actualizar todo, incluyendo la foto
        if (isset($_POST['madre_numero'])
            && isset($_POST['cria_edad'])
            && isset($_POST['cria_sexo'])
            && isset($_POST['cria_fecha_nacimiento'])
            && isset($_POST['cria_numero'])
            && isset($_POST['cria_arete'])
            && isset($_POST['cria_tatuaje'])
            && isset($_POST['cria_estado_arete'])
            && isset($_POST['cria_raza'])
            && isset($_POST['cria_peso_nacimiento'])
            && isset($_POST['cria_peso_destete'])
            && isset($_POST['cria_peso_venta'])
            && isset($_POST['cria_finada'])
            && isset($_POST['cria_fecha_destete'])
            && isset($_POST['cria_fecha_aretado'])
            && isset($_POST['cria_fecha_tatuaje'])
            && isset($_POST['cria_fecha_fierro'])
            && isset($_POST['cria_fecha_venta'])
            && isset($_POST['cria_observaciones'])) {
            //&& isset($_FILES['cria_foto'])
            //&& isset($_FILES['cria_foto_fierro'])
            //establecer ruta para almacenar la foto
            // $random_number1 = rand(1, 1000);
            // $random_number2 = rand(1, 1000);
            //    
            // $cria_directorioDestino = 'crias_fotos/';
            // $cria_nombreArchivo =  $_POST['cria_numero'] . "_" . $_FILES['cria_foto']['name'];
            // $cria_ubicacionTemporal = $_FILES['cria_foto']['tmp_name'];
            //    
            // $fierro_directorioDestino = 'crias_fotos_fierro/';
            // $fierro_nombreArchivo = $_POST['cria_numero'] . "_" . $_FILES['cria_foto_fierro']['name'];
            // $fierro_ubicacionTemporal = $_FILES['cria_foto_fierro']['tmp_name'];
            //
            // // Mueve la imagen al directorio deseado
            // if (move_uploaded_file($cria_ubicacionTemporal, $cria_directorioDestino . $cria_nombreArchivo)) {
            //    echo "La imagen se ha guardado correctamente en la carpeta 'crias_fotos'";
            //    echo '</br>';
            // } else {
            //     echo "<script>alert('Informacion: No se seleccionó ninguna imagen.');</script>";
            // }
            //    // Mueve la imagen al directorio deseado
            //    if (move_uploaded_file($fierro_ubicacionTemporal, $fierro_directorioDestino . $fierro_nombreArchivo)) {
            //     echo "La imagen se ha guardado correctamente en la carpeta 'crias_fotos_fierro'";
            //     echo '</br>';
            //  } else {
            //      echo "<script>alert('Informacion: No se seleccionó ninguna imagen.');</script>";
            //  }

            // Acceder y guardar en VARIABLES los datos del formulario recibido
            $madre_numero= $_POST['madre_numero'];
            $cria_edad= $_POST['cria_edad'];
            $cria_sexo= $_POST['cria_sexo'];
            $cria_fecha_nacimiento= $_POST['cria_fecha_nacimiento'];
            
            $cria_numero= $_POST['cria_numero'];
            $cria_arete= $_POST['cria_arete'];
            $cria_tatuaje= $_POST['cria_tatuaje'];
            $cria_estado_arete= $_POST['cria_estado_arete'];
            $cria_raza= $_POST['cria_raza'];

            $cria_peso_nacimiento= $_POST['cria_peso_nacimiento'];            
            $cria_peso_destete= $_POST['cria_peso_destete'];
            $cria_peso_venta= $_POST['cria_peso_venta'];
            $cria_finada= $_POST['cria_finada'];

            $cria_fecha_destete= $_POST['cria_fecha_destete'];
            $cria_fecha_aretado= $_POST['cria_fecha_aretado'];
            $cria_fecha_tatuaje= $_POST['cria_fecha_tatuaje'];
            $cria_fecha_fierro= $_POST['cria_fecha_fierro'];
            $cria_fecha_venta= $_POST['cria_fecha_venta'];
            // $sql = "SELECT id_cria,
            // cria_foto, cria_foto_fierro 
            //  FROM crias WHERE id_cria = :id_cria";
            // $stmt = $conexion->prepare($sql);
            // $stmt->bindParam(':id_cria', $id_cria); 
            // $stmt->execute();
            //   
            // $arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC);
            //        
            // //si esta vacio el que me mandaste y esta vacio en la bd, llenar con ejemplo
            // if (empty($_FILES['cria_foto']['name']) and empty($arreglo_sql['cria_foto'])){
            //     $cria_foto_ruta = $cria_directorioDestino . "ejemplo.jpg";
            // }
            // //si no esta vacio el que me mandaste o hay algo en la bd, llenar con el de la bd
            // if(!empty($_FILES['cria_foto']['name']) or  !empty($arreglo_sql['cria_foto']) ){
            //     $cria_foto_ruta=$arreglo_sql['cria_foto'];
            // }
            // //si no esta vacio en la que me mandaste, llenar con lo que vas a mandar
            // if(!empty($_FILES['cria_foto']['name'])){
            //     $cria_foto_ruta = $cria_directorioDestino . $cria_nombreArchivo;
            // }
            // //-------------------------------------------------------------------------------------------
            // //si esta vacio el que me mandaste y esta vacio en la bd, llenar con ejemplo
            // if (empty($_FILES['cria_foto_fierro']['name']) and empty($arreglo_sql['cria_foto_fierro'])){
            //     $fierro_foto_ruta = $fierro_directorioDestino . "ejemplo.jpg";
            // }
            // //si no esta vacio el que me mandaste o hay algo en la bd, llenar con el de la bd
            // if(!empty($_FILES['cria_foto_fierro']['name']) or !empty($arreglo_sql['cria_foto_fierro']) ){
            //     $fierro_foto_ruta=$arreglo_sql['cria_foto_fierro'];
            // }
            // //si no esta vacio en la que me mandaste, llenar con lo que vas a mandar
            // if(!empty($_FILES['cria_foto_fierro']['name'])){
            //    $fierro_foto_ruta = $fierro_directorioDestino . $fierro_nombreArchivo;
            // }
            $cria_observaciones= $_POST['cria_observaciones'];
            //intentar la consulta de actualizar todos los campos
            try {
                $madre_numero = $_POST['madre_numero'];
                
                // Obtener el valor actual de vaca_partos
                $sql_select = "SELECT vaca_numero, vaca_partos FROM vacas WHERE vaca_numero = :madre_numero";
                $stmt_select = $conexion->prepare($sql_select);
                $stmt_select->bindParam(':madre_numero', $madre_numero);
                $stmt_select->execute();
                $arreglo_sql = $stmt_select->fetch(PDO::FETCH_ASSOC); 
                
                if ($arreglo_sql) {
                    // Sumar 1 al valor actual de vaca_partos
                    $vaca_partos_actualizado = $arreglo_sql['vaca_partos'] + 1;
                    
                    // Actualizar el registro en la base de datos
                    $sql_update = "UPDATE vacas SET vaca_partos = :vaca_partos WHERE vaca_numero = :madre_numero";
                    $stmt_update = $conexion->prepare($sql_update);
                    $stmt_update->bindParam(':vaca_partos', $vaca_partos_actualizado);
                    $stmt_update->bindParam(':madre_numero', $madre_numero);
                    $stmt_update->execute();
                } else {
                    echo '<h4 class="mt-4 mb-2 text-warning text-center">Aviso: Cría agregada con exito, pero no se encontró ninguna vaca con el número de madre especificado.</h4>';
                }
            } catch (PDOException $e) {
                // Manejo de excepciones PDO
                echo '<h5 class="mb-3 text-warning text-center">Aviso: Ocurrió un error al procesar la solicitud.</h5>';
            }

            try {  
                //instancia que indica que la conexion "$conexion" de conexion.php sera usada aqui con PDO
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Consulta SQL con marcadores de posición
                $sql = "INSERT INTO crias (id_cria, madre_numero, cria_edad, cria_sexo, 
                    cria_fecha_nacimiento, cria_numero, cria_arete, cria_tatuaje, cria_estado_arete, cria_raza,  
                    cria_peso_nacimiento, cria_peso_destete, cria_peso_venta, cria_finada, 
                    cria_fecha_destete, cria_fecha_aretado, cria_fecha_tatuaje, 
                    cria_fecha_fierro, cria_fecha_venta, cria_observaciones) 
                    VALUES (null, :madre_numero, :cria_edad, :cria_sexo, 
                    :cria_fecha_nacimiento, :cria_numero, :cria_arete, :cria_tatuaje, :cria_estado_arete, :cria_raza, 
                    :cria_peso_nacimiento, :cria_peso_destete, :cria_peso_venta, :cria_finada, 
                    :cria_fecha_destete, :cria_fecha_aretado, :cria_fecha_tatuaje, 
                    :cria_fecha_fierro, :cria_fecha_venta, :cria_observaciones)";
                $stmt = $conexion->prepare($sql); // Preparar la consulta
                // Vincular los valores a los marcadores de posición
                #$id_usuario=$_SESSION['id_usuario']; //insertar id del usuario actual en sesion para clave foranea
                //$stmt->bindParam(':id_usuario', $id_usuario);
                $stmt->bindParam(':madre_numero', $madre_numero);   
                $stmt->bindParam(':cria_edad', $cria_edad);   
                $stmt->bindParam(':cria_sexo', $cria_sexo);  
                $stmt->bindParam(':cria_fecha_nacimiento', $cria_fecha_nacimiento);

                $stmt->bindParam(':cria_numero', $cria_numero);
                $stmt->bindParam(':cria_arete', $cria_arete);
                $stmt->bindParam(':cria_tatuaje', $cria_tatuaje);
                $stmt->bindParam(':cria_estado_arete', $cria_estado_arete);
                $stmt->bindParam(':cria_raza', $cria_raza);

                $stmt->bindParam(':cria_peso_nacimiento', $cria_peso_nacimiento);
                $stmt->bindParam(':cria_peso_destete', $cria_peso_destete);
                $stmt->bindParam(':cria_peso_venta', $cria_peso_venta);
                $stmt->bindParam(':cria_finada', $cria_finada);

                $stmt->bindParam(':cria_fecha_destete', $cria_fecha_destete);
                $stmt->bindParam(':cria_fecha_aretado', $cria_fecha_aretado);
                $stmt->bindParam(':cria_fecha_tatuaje', $cria_fecha_tatuaje);
                $stmt->bindParam(':cria_fecha_fierro', $cria_fecha_fierro);
                $stmt->bindParam(':cria_fecha_venta', $cria_fecha_venta);
                // $stmt->bindParam(':cria_foto', $cria_foto_ruta);
                // $stmt->bindParam(':cria_foto_fierro', $fierro_foto_ruta);
                $stmt->bindParam(':cria_observaciones', $cria_observaciones);
                
                $stmt->execute();
                echo "<script>alert('Registro guardado con éxito');</script>";
                echo '
                <div class="d-flex flex-row justify-content-center col-12">
                    <div class="d-flex justify-content-center align-items-center flex-column mt-3 col-8" >
                        <h1 class="mb-4 text-center" style="font-size:3rem;">Los datos se han enviado correctamente.</h1>
                        <i style="color:green;" class="col-8 col-xl-5 mb-5 text-center fa-solid fa-circle-check fa-3x"></i>
                        <a href="crias-form.php" class="col-8 col-xl-5 mb-4 btn-script" >
                            Dar de alta otra cría
                        </a>
                        <a href="crias-tabla.php" class="col-8 col-xl-5 mb-4 btn-script" >
                            Ir a la tabla de crías
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
                //echo "Error: " . $e->getMessage();
                echo '
                <div class="d-flex flex-row justify-content-center col-12">
                    <div class="d-flex justify-content-center align-items-center flex-column mt-5 col-8" >
                        <h1 class="mb-4 text-center" style="font-size:3rem;">Los datos no fueron enviados</h1>
                        <i style="color:red;" class="col-8 col-xl-5 mb-5 text-center fa-regular fa-circle-xmark fa-3x"></i>
                        <a href="crias-form.php" class="col-8 col-xl-5 mb-4 btn-script" >
                            Regresar al formulario
                        </a>
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
            //echo "Error: " . $e->getMessage();
            echo '
            <div class="d-flex flex-row justify-content-center col-12">
                <div class="d-flex justify-content-center align-items-center flex-column mt-5 col-8" >
                    <h1 class="mb-4 text-center" style="font-size:3rem;">Los datos no fueron enviados</h1>
                    <i style="color:red;" class="col-8 col-xl-5 mb-5 text-center fa-regular fa-circle-xmark fa-3x"></i>
                    <a href="cria-form.php" class="col-8 col-xl-5 mb-4 btn-script" >
                        Regresar al formulario
                    </a>
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
        