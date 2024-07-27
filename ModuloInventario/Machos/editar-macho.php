<?php
include("../../conexion.php");
//session_start();
//
//if (!isset($_SESSION['id_usuario'])) {
//    header("Location: login.html");
//    exit;
//} else {
//    echo 'Usuario autenticado con ID: '.$_SESSION['id_usuario'];
//}

    if (isset($_POST['id_macho'])) {
        $id_macho = $_POST['id_macho'];

        try {
            $sql = "SELECT id_macho, macho_numero, macho_arete, macho_tatuaje, macho_raza, 
            madre_numero, madre_arete, madre_tatuaje, madre_raza, 
            padre_numero, padre_arete, padre_tatuaje, padre_raza, 
            macho_color, macho_talla, macho_pelo, macho_condicion, macho_estatus, macho_potrero, 
            macho_lote, macho_estado_re, macho_finado, 
            macho_edad_actual, macho_edad_destete, macho_edad_venta, 
            macho_peso_nacimiento, macho_peso_actual, macho_peso_destete, macho_peso_venta, 
            macho_gan_peso_dia, macho_gan_peso_mes, macho_peso_3meses, 
            macho_fecha_nacimiento, macho_fecha_destete, macho_fecha_aretado, 
            macho_fecha_tatuaje, macho_fecha_fierro, macho_fecha_venta, 
            macho_foto, macho_foto_fierro, 
            macho_observaciones FROM machos WHERE id_macho = :id_macho";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_macho', $id_macho);
            $stmt->execute();
            $arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Error cuando no se ejecuta la consulta SQL
            echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
            //echo "Error: " . $e->getMessage();
            echo '
            <div class="d-flex flex-row justify-content-center col-12" style="padding-bottom: 200px;">
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
            '."            
            <script>
                var bodyElement = document.querySelector('body');
                bodyElement.style.overflowY = 'hidden';
            </script> ";
        }
    }else {
        echo "<script>alert('Hubo un error al recibir el id del macho.');</script>";
        //echo "Error: " . $e->getMessage();
        echo '
        <div class="d-flex flex-row justify-content-center col-12" style="padding-bottom: 200px;">
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
        '."            
        <script>
            var bodyElement = document.querySelector('body');
            bodyElement.style.overflowY = 'hidden';
        </script> ";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta value="<?php echo '' . $arreglo_sql['id_macho'] . '';?>" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/f7e7d9df55.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="../../jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../styles/styles-machos.css">


    <title>Editar hoja de vida</title>
</head>
<body>

<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-5 section-buttons">
    <div class="col-11 col-md-10">
        <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h2 class=" text-center mb-4">Editar hoja de vida de macho: <?php echo '' . $arreglo_sql['macho_numero'] . '';?></h2>

        <div class="justify-content-end d-flex flex-row col-12 mb-2 div-imgs-container">
            <div class="div-imgs justify-content-end d-flex px-1" >
                <a data-fancybox="gallery" href="<?php echo '' . $arreglo_sql['macho_foto_fierro'] . '';?>" >
                    <img  class="img-fotos-perfil img-thumbnail" src="<?php echo '' . $arreglo_sql['macho_foto_fierro'] . '';?>"  alt="Vacio">
                </a>
            </div>
            <div class="div-imgs justify-content-end d-flex  px-1" >
                <a data-fancybox="gallery" href="<?php echo '' . $arreglo_sql['macho_foto'] . '';?>" >
                    <img  class="img-fotos-perfil img-thumbnail" src="<?php echo '' . $arreglo_sql['macho_foto'] . '';?>"  alt="Vacio">
                </a>    
            </div>
        </div>

        <div class="d-flex flex-row justify-content-end mb-1 mb-0">
            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">
                <a class="h-100 w-100 d-flex flex-row justify-content-evenly align-items-center" href="macho-tabla.php">
                    <button class="btn-principal" >Cancelar y regresar</button>
                </a>
            </div>
        </div>
    </div>
</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    
    <form class=" d-flex flex-column col-11 col-md-10 justify-content-center align-items-center formulario"  action="editar-macho-script.php" method="POST" enctype="multipart/form-data">
        <input type="hidden"  value="<?php echo '' . $arreglo_sql['id_macho'] . '';?>" name="id_macho">

        <p class="p-form">Formulario de editar datos de la hoja de vida del macho.</p>

        <h3 class="">Información principal</h3> 

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" col-md-2" >
                <label class="label-form" for="macho_numero">Número del macho</label>
                <input type="number" class="form-control" id="macho_numero" placeholder="Número del macho"  value="<?php echo '' . $arreglo_sql['macho_numero'] . '';?>" name="macho_numero" required>
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="macho_arete">Arete del macho</label>
                <input type="text" class="form-control" id="macho_arete" placeholder="Número del arete del macho" value="<?php echo '' . $arreglo_sql['macho_arete'] . '';?>" name="macho_arete" >
            </div>  
            
            <div class=" col-md-3" >
                <label class="label-form" for="macho_tatuaje">Tatuaje del macho</label>
                <input type="text" class="form-control" id="macho_tatuaje" placeholder="Tatuaje del macho" value="<?php echo '' . $arreglo_sql['macho_tatuaje'] . '';?>" name="macho_tatuaje" >
            </div> 
        
            <div class=" col-md-3" >
                <label class="label-form" for="macho_raza">Raza del macho</label>
                <input type="text" class="form-control" id="macho_raza" placeholder="Raza del macho" value="<?php echo '' . $arreglo_sql['macho_raza'] . '';?>" name="macho_raza" >
            </div>
        </div>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-3 " >
                <label class="label-form" for="macho_estado_re">Estado reproductivo</label>
                <select class="form-select" style="cursor: pointer; " id="macho_estado_re" name="macho_estado_re" required>
                    <option class="option-hover" value="<?php echo '' . $arreglo_sql['macho_estado_re'] . '';?>" selected><?php echo '' . $arreglo_sql['macho_estado_re'] . '';?></option>
                    <option class="option-hover" value="Torete">Torete</option>
                    <option class="option-hover" value="Toro semental">Toro semental</option>
                </select>             
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="macho_estatus">Estatus del arete</label>
                <select class="form-select" style="cursor: pointer; " id="macho_estatus" name="macho_estatus" required>
                        <option class="option-hover" value="<?php echo '' . $arreglo_sql['macho_estatus'] . '';?>" selected><?php echo '' . $arreglo_sql['macho_estatus'] . '';?></option>
                        <option class="option-hover" value="Vigente">Vigente</option>
                        <option class="option-hover" value="Pendiente">Pendiente</option>
                        <option class="option-hover" value="Baja">Baja</option>
                </select>  
            </div>
        </div>
        
        <h3 class="">Madre</h3>  
        
        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-2 " >
                <label class="label-form" for="madre_numero">Número del madre</label>
                <input type="number" class="form-control" id="madre_numero" placeholder="Número del macho" value="<?php echo '' . $arreglo_sql['madre_numero'] . '';?>" name="madre_numero" >
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="madre_arete">Arete del madre</label>
                <input type="text" class="form-control" id="madre_arete" placeholder="Número del arete del madre" value="<?php echo '' . $arreglo_sql['madre_arete'] . '';?>" name="madre_arete" >
            </div> 

            <div class=" col-md-3" >
                <label class="label-form" for="madre_tatuaje">Tatuaje del madre</label>
                <input type="text" class="form-control" id="madre_tatuaje" placeholder="Tatuaje del madre" value="<?php echo '' . $arreglo_sql['madre_tatuaje'] . '';?>" name="madre_tatuaje" >
            </div>

            <div class="col-md-3 " >
                <label class="label-form" for="madre_raza">Raza del madre</label>
                <input type="text" class="form-control" id="madre_raza" placeholder="Raza del madre" value="<?php echo '' . $arreglo_sql['madre_raza'] . '';?>" name="madre_raza" >
            </div>
        </div>    

        <h3 class="">Padre</h3>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        

            <div class=" col-md-2" >
                <label class="label-form" for="padre_numero">Número del padre</label>
                <input type="number" class="form-control" id="padre_numero" placeholder="Número del padre" value="<?php echo '' . $arreglo_sql['padre_numero'] . '';?>" name="padre_numero" >
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="padre_arete">Arete del padre</label>
                <input type="text" class="form-control" id="padre_arete" placeholder="Número del arete del padre" value="<?php echo '' . $arreglo_sql['padre_arete'] . '';?>" name="padre_arete" >
            </div> 

            <div class=" col-md-3" >
                <label class="label-form" for="padre_tatuaje">Tatuaje del padre</label>
                <input type="text" class="form-control" id="padre_tatuaje" placeholder="Tatuaje del padre" value="<?php echo '' . $arreglo_sql['padre_tatuaje'] . '';?>" name="padre_tatuaje" >
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="padre_raza">Raza del padre</label>
                <input type="text" class="form-control" id="padre_raza" placeholder="Raza del padre" value="<?php echo '' . $arreglo_sql['padre_raza'] . '';?>" name="padre_raza" >
            </div>
        </div>

        <h3 class="">Información del macho</h3>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        

            <div class=" col-md-2" >
                <label class="label-form" for="macho_color">Color</label>
                <input type="text" class="form-control" id="macho_color" placeholder="Color del macho" value="<?php echo '' . $arreglo_sql['macho_color'] . '';?>" name="macho_color" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="macho_talla">Talla</label>
                <input type="text" class="form-control" id="macho_talla" placeholder="Talla del macho" value="<?php echo '' . $arreglo_sql['macho_talla'] . '';?>" name="macho_talla" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="macho_pelo">Pelo</label>
                <input type="text" class="form-control" id="macho_pelo" placeholder="Pelo del macho" value="<?php echo '' . $arreglo_sql['macho_pelo'] . '';?>" name="macho_pelo" >
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="macho_condicion">Condición corporal</label>
                <input type="text" class="form-control" id="macho_condicion" placeholder="Ingresar condicion corporal" value="<?php echo '' . $arreglo_sql['macho_condicion'] . '';?>" name="macho_condicion" >
            </div>
        </div>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" col-md-2" >
                <label class="label-form" for="macho_potrero">Potrero</label>
                <input type="text" class="form-control" id="macho_potrero" placeholder="Potrero actual" value="<?php echo '' . $arreglo_sql['macho_potrero'] . '';?>" name="macho_potrero" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="macho_lote">Lote</label>
                <input type="text" class="form-control" id="macho_lote" placeholder="Lote" value="<?php echo '' . $arreglo_sql['macho_lote'] . '';?>" name="macho_lote" >
            </div>   
            <div class=" col-md-2" >
                <label class="label-form" for="macho_finado">Finado</label>
                <select class="form-select" style="cursor: pointer; " id="macho_finado" name="macho_finado">
                        <option class="option-hover" value="<?php echo '' . $arreglo_sql['macho_finado'] . '';?>" selected><?php echo '' . $arreglo_sql['macho_finado'] . '';?></option>
                        <option class="option-hover" value="Si">Si</option>
                        <option class="option-hover" value="No">No</option>
                </select>
            </div> 
            <div class="col-md-3"></div>
        </div>

        <h3 class="">Edades</h3>
    
        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-3" >
                <label class="label-form" for="macho_edad_actual">Edad actual</label>
                <input type="number" class="form-control" id="macho_edad_actual" placeholder="Edad en meses" step="1" min="13" value="<?php echo '' . $arreglo_sql['macho_edad_actual'] . '';?>" name="macho_edad_actual" >
            </div>
            <div class="col-md-3" >
                <label class="label-form" for="macho_edad_destete">Edad de destete</label>
                <input type="text" class="form-control" id="macho_edad_destete" placeholder="Edad en meses" value="<?php echo '' . $arreglo_sql['macho_edad_destete'] . '';?>" name="macho_edad_destete" >
            </div>
            <div class="col-md-3" >
                <label class="label-form" for="macho_edad_venta">Edad de venta</label>
                <input type="text" class="form-control" id="macho_edad_venta" placeholder="Edad en meses" value="<?php echo '' . $arreglo_sql['macho_edad_venta'] . '';?>" name="macho_edad_venta" >
            </div>
        </div>

        <h3 class="">Pesos</h3>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-2 " >
                <label class="label-form" for="macho_peso_nacimiento">Peso de nacimiento</label>
                <input type="number" class="form-control" id="macho_peso_nacimiento" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 32.565" value="<?php echo '' . $arreglo_sql['macho_peso_nacimiento'] . '';?>" name="macho_peso_nacimiento" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="macho_peso_actual">Peso actual</label>
                <input type="number" class="form-control" id="macho_peso_actual" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 689.705" value="<?php echo '' . $arreglo_sql['macho_peso_actual'] . '';?>" name="macho_peso_actual" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="macho_peso_destete">Peso destete</label>
                <input type="number" class="form-control" id="macho_peso_destete" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 125.345" value="<?php echo '' . $arreglo_sql['macho_peso_destete'] . '';?>" name="macho_peso_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="macho_peso_venta">Peso de venta</label>
                <input type="number" class="form-control" id="macho_peso_venta" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 813.552" value="<?php echo '' . $arreglo_sql['macho_peso_venta'] . '';?>" name="macho_peso_venta" >
            </div>              
        </div>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" col-md-2" >
                <label class="label-form" for="macho_gan_peso_dia">Ganancia de peso por día</label>
                <input type="number" class="form-control" id="macho_gan_peso_dia" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 0.453" value="<?php echo '' . $arreglo_sql['macho_gan_peso_dia'] . '';?>" name="macho_gan_peso_dia" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="macho_gan_peso_mes">Ganancia de peso por mes</label>
                <input type="number" class="form-control" id="macho_gan_peso_mes" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 15.453" value="<?php echo '' . $arreglo_sql['macho_gan_peso_mes'] . '';?>" name="macho_gan_peso_mes" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="macho_peso_3meses">Peso en 3 meses</label>
                <input type="number" class="form-control" id="macho_peso_3meses" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 93.604" value="<?php echo '' . $arreglo_sql['macho_peso_3meses'] . '';?>" name="macho_peso_3meses" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>

        <h3 class="">Fechas</h3>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-2" >
                <label class="label-form" for="macho_fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="macho_fecha_nacimiento" placeholder="Seleccionar fecha" value="<?php echo '' . $arreglo_sql['macho_fecha_nacimiento'] . '';?>" name="macho_fecha_nacimiento" >
            </div>      
            <div class="col-md-2" >
                <label class="label-form" for="macho_fecha_destete">Fecha de destete</label>
                <input type="date" class="form-control" id="macho_fecha_destete" placeholder="Seleccionar fecha" value="<?php echo '' . $arreglo_sql['macho_fecha_destete'] . '';?>" name="macho_fecha_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="macho_fecha_aretado">Fecha aretado</label>
                <input type="date" class="form-control" id="macho_fecha_aretado" placeholder="Fecha aretado" value="<?php echo '' . $arreglo_sql['macho_fecha_aretado'] . '';?>" name="macho_fecha_aretado" >
            </div>

            <div class="col-md-2" >
                <label class="label-form" for="macho_fecha_tatuaje">Fecha de tatuaje</label>
                <input type="date" class="form-control" id="macho_fecha_tatuaje" placeholder="Fecha aretado" value="<?php echo '' . $arreglo_sql['macho_fecha_tatuaje'] . '';?>" name="macho_fecha_tatuaje" >
            </div>
        </div>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-2 " >
                <label class="label-form" for="macho_fecha_fierro">Fecha de fierro</label>
                <input type="date" class="form-control" id="macho_fecha_fierro" placeholder="Fecha aretado" value="<?php echo '' . $arreglo_sql['macho_fecha_fierro'] . '';?>" name="macho_fecha_fierro" >
            </div>                               

            <div class="col-md-2" >
                <label class="label-form" for="macho_fecha_venta">Fecha de venta</label>
                <input type="date" class="form-control" id="macho_fecha_venta" placeholder="Seleccionar fecha" value="<?php echo '' . $arreglo_sql['macho_fecha_venta'] . '';?>" name="macho_fecha_venta" >
            </div>
            <div class=" col-md-2" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>  


        <h3 class="">Información adicional</h3>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">   
            <div class=" col-md-5" >
                <label class="label-form" for="foto">Seleccionar nueva fotografía del fierro</label>
                <input class="form-control" type="file" id="macho_foto"  accept="image/*" value="" name="macho_foto_fierro">
                <label class="label-form mt-4 mt-md-0" for="foto">Fotografía actual</label>
                <img id="img-foto" class="mt-1 mt-md-4 img-fluid" src="<?php echo '' . $arreglo_sql['macho_foto_fierro'] . '';?>"  alt="Vacio">
            </div>                 
            <div class=" col-md-5" >
                <label class="label-form" for="foto">Seleccionar nueva fotografía del macho</label>
                <input class="form-control" type="file" id="macho_foto"  accept="image/*" value="" name="macho_foto">
                <label class="label-form mt-4 mt-md-0" for="foto">Fotografía actual</label>
                <img id="img-foto" class="mt-1 mt-md-4 img-fluid" src="<?php echo '' . $arreglo_sql['macho_foto'] . '';?>"  alt="Vacio">
            </div>
        </div>
        
        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-12" > 
                <label class="label-form" for="macho_observaciones">Observaciones</label>
                <textarea class="form-control" id="macho_observaciones"  rows="4" cols="50" value="<?php echo '' . $arreglo_sql['macho_observaciones'] . '';?>" name="macho_observaciones"><?php echo '' . $arreglo_sql['macho_observaciones'] . '';?></textarea> 
            </div>           
        </div>

        <button type="submit" class=" col-12 col-xl-6 py-3 btn-submit" >Actualizar datos</button>

    </form>
</section>

<!-- ------------------scripts section----------------- -->
<script>
    $(document).ready(function() {
        // Detecta cambios en el input de ganancia de peso por día
        $('#macho_gan_peso_dia').on('input', function() {
            // Obtiene el valor del input de ganancia de peso por día
            var ganPesoDia = parseFloat($(this).val());
            // Calcula la ganancia de peso por mes (multiplica por 30)
            var ganPesoMes = ganPesoDia * 30;
            // Calcula el peso en 3 meses (multiplica por 90)
            var peso3Meses = ganPesoDia * 90; 
            // Asigna los valores a los inputs correspondientes
            $('#macho_gan_peso_mes').val(ganPesoMes.toFixed(3)); // Limita a 3 decimales
            $('#macho_peso_3meses').val(peso3Meses.toFixed(3)); // Limita a 3 decimales
        });
    });

        //VALIDACION EDAD RELACION CON FECHA DE NACIMIENTO
        document.addEventListener('DOMContentLoaded', function() {
        // Obtener el input de Edad y el input de Fecha
        var inputEdad = document.getElementById('macho_edad_actual');
        var inputFecha = document.getElementById('macho_fecha_nacimiento');

        // Función para actualizar la fecha según la edad ingresada
        function actualizarFecha() {
            // Obtener la fecha actual
            var fechaActual = new Date();
            // Obtener la edad ingresada en meses
            var edadMeses = parseInt(inputEdad.value);
            // Calcular la nueva fecha restando la edad en meses y estableciendo el día como 1
            var nuevaFecha = new Date(fechaActual.getFullYear(), fechaActual.getMonth() - edadMeses, 1);
            // Formatear la nueva fecha como YYYY-MM-DD
            var nuevaFechaFormateada = nuevaFecha.toISOString().split('T')[0];
            // Actualizar el valor del input de Fecha
            inputFecha.value = nuevaFechaFormateada;
        }

        // Agregar un listener para detectar cambios en el input de Edad
        inputEdad.addEventListener('input', actualizarFecha);

        // Función para actualizar la edad según la fecha de nacimiento seleccionada
        function actualizarEdad() {
            // Obtener la fecha de nacimiento seleccionada
            var fechaNacimiento = new Date(inputFecha.value);
            // Obtener la fecha actual
            var fechaActual = new Date();
            // Calcular la diferencia en meses entre la fecha actual y la fecha de nacimiento
            var edadMeses = (fechaActual.getFullYear() - fechaNacimiento.getFullYear()) * 12 + (fechaActual.getMonth() - fechaNacimiento.getMonth());

            // Actualizar el valor del input de Edad
            inputEdad.value = edadMeses;
        }

        // Agregar un listener para detectar cambios en el input de Fecha
        inputFecha.addEventListener('input', actualizarEdad);
    });
</script>
<!-- codigo de fancybox -->
<script>
    $(document).ready(function() {
        // Inicializar FancyBox
        $('[data-fancybox="gallery"]').fancybox({
          // Opciones adicionales aquí
        });
    });
</script>
</body>
</html>