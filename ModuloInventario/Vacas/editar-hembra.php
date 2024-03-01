<?php
include("conexion.php");
//session_start();
//
//if (!isset($_SESSION['id_usuario'])) {
//    header("Location: login.html");
//    exit;
//} else {
//    echo 'Usuario autenticado con ID: '.$_SESSION['id_usuario'];
//}

    if (isset($_POST['id_vaca'])) {
        $id_vaca = $_POST['id_vaca'];

        try {
            $sql = "SELECT id_vaca, vaca_numero, vaca_arete, vaca_tatuaje, vaca_raza, 
            madre_numero, madre_arete, madre_tatuaje, madre_raza, 
            padre_numero, padre_arete, padre_tatuaje, padre_raza, 
            vaca_color, vaca_talla, vaca_pelo, vaca_condicion, vaca_estatus, vaca_potrero, 
            vaca_lote, vaca_estado_re, vaca_celo, vaca_partos, vaca_estado_pal, vaca_finada, 
            vaca_edad_actual, vaca_edad_destete, vaca_edad_venta, 
            vaca_peso_nacimiento, vaca_peso_actual, vaca_peso_destete, vaca_peso_venta, 
            vaca_gan_peso_dia, vaca_gan_peso_mes, vaca_peso_3meses, 
            vaca_fecha_nacimiento, vaca_fecha_destete, vaca_fecha_aretado, 
            vaca_fecha_tatuaje, vaca_fecha_fierro, vaca_fecha_probable, vaca_fecha_venta, 
            vaca_leche_dia, vaca_leche_mes, vaca_leche_comentario, 
            vaca_foto, vaca_foto_fierro, 
            vaca_observaciones FROM vacas WHERE id_vaca = :id_vaca";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_vaca', $id_vaca);
            $stmt->execute();
            $arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Error cuando no se ejecuta la consulta SQL
            echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
            //echo "Error: " . $e->getMessage();
            echo '
            <div class="d-flex col-12 justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
                <h2 class="mb-3">Los datos no fueron enviados</h2>
                <i style="color:red;" class="col-8 col-xl-5 mb-3 text-center fa-regular fa-circle-xmark fa-3x"></i>
                <a href="hembra-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
                    Regresar a la tabla
                </a>
                <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-5 btn btn-secondary" >
                    Ir al menú
                </a>
                <p class="mb-3">Si el problema persiste, contactar a los desarrolladores</p>
            </div>

            '."            
            <script>
                var bodyElement = document.querySelector('body');
                bodyElement.style.overflowY = 'hidden';
            </script> ";
        }
    }else {
        echo "<script>alert('Hubo un error al recibir el id de la vaca.');</script>";
        //echo "Error: " . $e->getMessage();
        echo '
        <div class="d-flex col-12 justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
            <h2 class="mb-3">Los datos no fueron enviados</h2>
            <i style="color:red;" class="col-8 col-xl-5 mb-3 text-center fa-regular fa-circle-xmark fa-3x"></i>

            <a href="hembra-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
                Regresar a la tabla
            </a>
            <a href="../menu-inventario.php" class="col-8 col-xl-5 mb-5 btn btn-secondary" >
                Ir al menú
            </a>
            <p class="mb-3">Si el problema persiste, contactar a los desarrolladores</p>
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
    <meta value="<?php echo '' . $arreglo_sql['id_vaca'] . '';?>" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/f7e7d9df55.js" crossorigin="anonymous"></script>


    <title>Editar hoja de vida</title>
</head>
<body>

<style>
    section form div{
        width: 100%;
        margin-bottom: 20px;
    }
    .label-form{
        margin-bottom: 10px;
        font-weight: 400;
    }
    .option-hover{
        color: black !important;
        
    }
    .option-hover:hover{
        color: black !important;
        cursor:pointer !important;
    }

    section a{
        text-decoration: none;
    }
    .form-vaca{
        border: 1px solid #ccc;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        background-color: #f9f9f9;
        padding: 3%;
        border-radius:10px
    }
    .img-fotos-perfil{
        width: auto;
        height: -webkit-fill-available;
    }
    .div-imgs{
        height:auto;
        width:max-content;
    }
    .div-imgs-container{
        height:200px;
    }
    @media (min-width: 1px) and (max-width: 992px) {
        .div-imgs-container{
            height:120px;
        }

    }
   
</style>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-3">
    <div class="col-11 col-md-10">
        <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h2 class=" text-center mb-4">Editar hoja de vida de vaca: <?php echo '' . $arreglo_sql['vaca_numero'] . '';?></h2>

        <div class="justify-content-end d-flex flex-row col-12 mb-2 div-imgs-container">
 
            <div class="div-imgs justify-content-end d-flex px-1" >
                <img  class="img-fotos-perfil img-thumbnail" src="<?php echo '' . $arreglo_sql['vaca_foto_fierro'] . '';?>"  alt="Vacio">
            </div>

            <div class="div-imgs justify-content-end d-flex  px-1" >
                <img  class="img-fotos-perfil img-thumbnail" src="<?php echo '' . $arreglo_sql['vaca_foto'] . '';?>"  alt="Vacio">
            </div>

        </div>

        <div class="d-flex flex-row justify-content-between mb-1 mb-0">

            <div class="col-0 col-xl-8"></div>

            <div class="d-flex flex-row justify-content-around align-items-center col-6 col-md-4">

                <a class="mx-2  h-100 form-control btn btn-warning d-flex flex-row justify-content-evenly align-items-center" href="hembra-tabla.php">
                    <!-- <i class="fa-solid fa-circle-plus fa-2x"></i> -->
                    <span>Cancelar y regresar</span>
                </a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <!-- <a class=" h-100 form-control btn btn-secondary d-flex flex-row justify-content-evenly align-items-center" href="menu-inventario.php">
                    <span>Regresar al menú</span>
                </a>  -->

            </div>

        </div>
    </div>
</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    
<form class="form-vaca d-flex flex-column col-11 col-md-10 justify-content-center align-items-center"  action="editar-hembra-script.php" method="POST" enctype="multipart/form-data">
        <input type="hidden"  value="<?php echo '' . $arreglo_sql['id_vaca'] . '';?>" name="id_vaca">

        <p class="p-form">Formulario de editar datos de la hoja de vida.</p>
        <h3 class="mb-3">Vaca</h3> 

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_numero">Número de la vaca</label>
                <input type="number" class="form-control" id="vaca_numero" placeholder="Número de la vaca"  value="<?php echo '' . $arreglo_sql['vaca_numero'] . '';?>" name="vaca_numero" required>
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="vaca_arete">Arete de la vaca</label>
                <input type="text" class="form-control" id="vaca_arete" placeholder="Número del arete de la vaca" value="<?php echo '' . $arreglo_sql['vaca_arete'] . '';?>" name="vaca_arete" >
            </div>  
            
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_tatuaje">Tatuaje de la vaca</label>
                <input type="text" class="form-control" id="vaca_tatuaje" placeholder="Tatuaje de la vaca" value="<?php echo '' . $arreglo_sql['vaca_tatuaje'] . '';?>" name="vaca_tatuaje" >
            </div> 
        
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_raza">Raza de la vaca</label>
                <input type="text" class="form-control" id="vaca_raza" placeholder="Raza de la vaca" value="<?php echo '' . $arreglo_sql['vaca_raza'] . '';?>" name="vaca_raza" >
            </div>
        </div>
        
        <h3 class="pt-4 mb-3">Madre</h3>  
        
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2 " >
                <label class="label-form" for="madre_numero">Número de la madre</label>
                <input type="number" class="form-control" id="madre_numero" placeholder="Número de la vaca" value="<?php echo '' . $arreglo_sql['madre_numero'] . '';?>" name="madre_numero" >
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="madre_arete">Arete de la madre</label>
                <input type="text" class="form-control" id="madre_arete" placeholder="Número del arete de la madre" value="<?php echo '' . $arreglo_sql['madre_arete'] . '';?>" name="madre_arete" >
            </div> 

            <div class=" col-md-3" >
                <label class="label-form" for="madre_tatuaje">Tatuaje de la madre</label>
                <input type="text" class="form-control" id="madre_tatuaje" placeholder="Tatuaje de la madre" value="<?php echo '' . $arreglo_sql['madre_tatuaje'] . '';?>" name="madre_tatuaje" >
            </div>

            <div class="col-md-3 " >
                <label class="label-form" for="madre_raza">Raza de la madre</label>
                <input type="text" class="form-control" id="madre_raza" placeholder="Raza de la madre" value="<?php echo '' . $arreglo_sql['madre_raza'] . '';?>" name="madre_raza" >
            </div>
        </div>    

        <h3 class="pt-4 mb-3">Padre</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">

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

        <h3 class="pt-4 mb-3">Información de la vaca</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_color">Color</label>
                <input type="text" class="form-control" id="vaca_color" placeholder="Color de la vaca" value="<?php echo '' . $arreglo_sql['vaca_color'] . '';?>" name="vaca_color" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_talla">Talla</label>
                <input type="text" class="form-control" id="vaca_talla" placeholder="Talla de la vaca" value="<?php echo '' . $arreglo_sql['vaca_talla'] . '';?>" name="vaca_talla" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_pelo">Pelo</label>
                <input type="text" class="form-control" id="vaca_pelo" placeholder="Pelo de la vaca" value="<?php echo '' . $arreglo_sql['vaca_pelo'] . '';?>" name="vaca_pelo" >
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="vaca_condicion">Condición corporal</label>
                <input type="text" class="form-control" id="vaca_condicion" placeholder="Ingresar condicion corporal" value="<?php echo '' . $arreglo_sql['vaca_condicion'] . '';?>" name="vaca_condicion" >
            </div>
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12"> 
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_estatus">Estatus</label>
                <input type="text" class="form-control" id="vaca_estatus" placeholder="Estatus de la vaca" value="<?php echo '' . $arreglo_sql['vaca_estatus'] . '';?>" name="vaca_estatus" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_potrero">Potrero</label>
                <input type="text" class="form-control" id="vaca_potrero" placeholder="Potrero actual" value="<?php echo '' . $arreglo_sql['vaca_potrero'] . '';?>" name="vaca_potrero" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_lote">Lote</label>
                <input type="text" class="form-control" id="vaca_lote" placeholder="Lote" value="<?php echo '' . $arreglo_sql['vaca_lote'] . '';?>" name="vaca_lote" >
            </div>

            <div class="col-md-3 " >
                <label class="label-form" for="vaca_estado_re">Estado reproductivo</label>
                <input type="text" class="form-control" id="vaca_estado_re" placeholder="Estado reproductivo" value="<?php echo '' . $arreglo_sql['vaca_estado_re'] . '';?>" name="vaca_estado_re" >
            </div>        
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12"> 
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_celo">Celo</label>
                <input type="text" class="form-control" id="vaca_celo" placeholder="Celo" value="<?php echo '' . $arreglo_sql['vaca_celo'] . '';?>" name="vaca_celo" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_partos">Partos totales</label>
                <input type="number" class="form-control" id="vaca_partos" placeholder="Número de partos" value="<?php echo '' . $arreglo_sql['vaca_partos'] . '';?>" name="vaca_partos" >
            </div>

            <div class="col-md-3 " >
                <label class="label-form" for="vaca_estado_pal">Estado de palpación</label>
                <input type="text" class="form-control" id="vaca_estado_pal" placeholder="Estado de palpación" value="<?php echo '' . $arreglo_sql['vaca_estado_pal'] . '';?>" name="vaca_estado_pal" >
            </div>    
            
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_finada">Finado</label>
                <select class="form-select" style="cursor: pointer; " id="vaca_finada" name="vaca_finada">
                        <option class="option-hover" value="<?php echo '' . $arreglo_sql['vaca_finada'] . '';?>" selected><?php echo '' . $arreglo_sql['vaca_finada'] . '';?></option>
                        <option class="option-hover" value="si">Si</option>
                        <option class="option-hover" value="no" selected>No</option>
                </select>
            </div>
        </div>

        <h3 class="pt-4 mb-3">Edades</h3>
    
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-3" >
                <label class="label-form" for="vaca_edad_actual">Edad actual</label>
                <input type="text" class="form-control" id="vaca_edad_actual" placeholder="Edad en meses" value="<?php echo '' . $arreglo_sql['vaca_edad_actual'] . '';?>" name="vaca_edad_actual" >
            </div>
            <div class="col-md-3" >
                <label class="label-form" for="vaca_edad_destete">Edad de destete</label>
                <input type="text" class="form-control" id="vaca_edad_destete" placeholder="Edad en meses" value="<?php echo '' . $arreglo_sql['vaca_edad_destete'] . '';?>" name="vaca_edad_destete" >
            </div>
            <div class="col-md-3" >
                <label class="label-form" for="vaca_edad_venta">Edad de venta</label>
                <input type="text" class="form-control" id="vaca_edad_venta" placeholder="Edad en meses" value="<?php echo '' . $arreglo_sql['vaca_edad_venta'] . '';?>" name="vaca_edad_venta" >
            </div>
        </div>

        <h3 class="pt-4 mb-3">Pesos</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_peso_nacimiento">Peso de nacimiento</label>
                <input type="number" class="form-control" id="vaca_peso_nacimiento" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 32.565" value="<?php echo '' . $arreglo_sql['vaca_peso_nacimiento'] . '';?>" name="vaca_peso_nacimiento" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="vaca_peso_actual">Peso actual</label>
                <input type="number" class="form-control" id="vaca_peso_actual" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 689.705" value="<?php echo '' . $arreglo_sql['vaca_peso_actual'] . '';?>" name="vaca_peso_actual" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_peso_destete">Peso destete</label>
                <input type="number" class="form-control" id="vaca_peso_destete" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 125.345" value="<?php echo '' . $arreglo_sql['vaca_peso_destete'] . '';?>" name="vaca_peso_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_peso_venta">Peso de venta</label>
                <input type="number" class="form-control" id="vaca_peso_venta" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 813.552" value="<?php echo '' . $arreglo_sql['vaca_peso_venta'] . '';?>" name="vaca_peso_venta" >
            </div>              
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_gan_peso_dia">Ganancia de peso por día</label>
                <input type="number" class="form-control" id="vaca_gan_peso_dia" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 0.453" value="<?php echo '' . $arreglo_sql['vaca_gan_peso_dia'] . '';?>" name="vaca_gan_peso_dia" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_gan_peso_mes">Ganancia de peso por mes</label>
                <input type="number" class="form-control" id="vaca_gan_peso_mes" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 15.453" value="<?php echo '' . $arreglo_sql['vaca_gan_peso_mes'] . '';?>" name="vaca_gan_peso_mes" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_peso_3meses">Peso en 3 meses</label>
                <input type="number" class="form-control" id="vaca_peso_3meses" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 93.604" value="<?php echo '' . $arreglo_sql['vaca_peso_3meses'] . '';?>" name="vaca_peso_3meses" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>

        <h3 class="pt-4 mb-3">Fechas</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2" >
                <label class="label-form" for="vaca_fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="vaca_fecha_nacimiento" placeholder="Seleccionar fecha" value="<?php echo '' . $arreglo_sql['vaca_fecha_nacimiento'] . '';?>" name="vaca_fecha_nacimiento" >
            </div>      
            <div class="col-md-2" >
                <label class="label-form" for="vaca_fecha_destete">Fecha de destete</label>
                <input type="date" class="form-control" id="vaca_fecha_destete" placeholder="Seleccionar fecha" value="<?php echo '' . $arreglo_sql['vaca_fecha_destete'] . '';?>" name="vaca_fecha_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_fecha_aretado">Fecha aretado</label>
                <input type="date" class="form-control" id="vaca_fecha_aretado" placeholder="Fecha aretado" value="<?php echo '' . $arreglo_sql['vaca_fecha_aretado'] . '';?>" name="vaca_fecha_aretado" >
            </div>

            <div class="col-md-2" >
                <label class="label-form" for="vaca_fecha_tatuaje">Fecha de tatuaje</label>
                <input type="date" class="form-control" id="vaca_fecha_tatuaje" placeholder="Fecha aretado" value="<?php echo '' . $arreglo_sql['vaca_fecha_tatuaje'] . '';?>" name="vaca_fecha_tatuaje" >
            </div>
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">

            <div class="col-md-2 " >
                <label class="label-form" for="vaca_fecha_fierro">Fecha de fierro</label>
                <input type="date" class="form-control" id="vaca_fecha_fierro" placeholder="Fecha aretado" value="<?php echo '' . $arreglo_sql['vaca_fecha_fierro'] . '';?>" name="vaca_fecha_fierro" >
            </div>                               
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_fecha_probable">Fecha probable</label>
                <input type="date" class="form-control" id="vaca_fecha_probable" placeholder="Fecha probable" value="<?php echo '' . $arreglo_sql['vaca_fecha_probable'] . '';?>" name="vaca_fecha_probable" >
            </div>
            <div class="col-md-2" >
                <label class="label-form" for="vaca_fecha_venta">Fecha de venta</label>
                <input type="date" class="form-control" id="vaca_fecha_venta" placeholder="Seleccionar fecha" value="<?php echo '' . $arreglo_sql['vaca_fecha_venta'] . '';?>" name="vaca_fecha_venta" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>  

        <h3 class="pt-4 mb-3">Producción - Partos</h3>

        <div class="d-flex justify-content-md-around d-md-flex flex-md-row flex-column col-12">
            <a href="../Crias/crias-form.php" class="mb-3 mb-md-0 mx-1 text-center py-2 btn-primary col-12 col-xl-6 rounded-3">Formulario de partos</a> 
        </div>

        <h3 class="pt-4 mb-4">Producción - Leche</h3>


        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_leche_dia">Promedio de leche al día</label>
                <input type="number" class="form-control" id="vaca_leche_dia" step="0.001" min="0" max="9999.999" value="<?php echo '' . $arreglo_sql['vaca_leche_dia'] . '';?>"  name="vaca_leche_dia" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_leche_mes">Promedio de leche al mes</label>
                <input type="number" class="form-control" id="vaca_leche_mes" step="0.001" min="0" max="9999.999" value="<?php echo '' . $arreglo_sql['vaca_leche_mes'] . '';?>"  name="vaca_leche_mes" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_leche_comentario">Comentario</label>
                <input type="text" class="form-control" id="vaca_leche_comentario" value="<?php echo '' . $arreglo_sql['vaca_leche_comentario'] . '';?>" name="vaca_leche_comentario" >
            </div>
        </div>

        <h3 class="pt-4 mb-3">Información adicional</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
 
            <div class=" col-md-5" >
                <label class="label-form" for="foto">Seleccionar nueva fotografía de la vaca</label>
                <input class="form-control" type="file" id="vaca_foto"  accept="image/*" value="" name="vaca_foto">
                <label class="label-form mt-4 mt-md-0" for="foto">Fotografía actual</label>
                <img id="img-foto" class="mt-1 mt-md-4 img-fluid" src="<?php echo '' . $arreglo_sql['vaca_foto'] . '';?>"  alt="Vacio">
            </div>

            <div class=" col-md-5" >
                <label class="label-form" for="foto">Seleccionar nueva fotografía del fierro</label>
                <input class="form-control" type="file" id="vaca_foto"  accept="image/*" value="" name="vaca_foto_fierro">
                <label class="label-form mt-4 mt-md-0" for="foto">Fotografía actual</label>
                <img id="img-foto" class="mt-1 mt-md-4 img-fluid" src="<?php echo '' . $arreglo_sql['vaca_foto_fierro'] . '';?>"  alt="Vacio">
            </div>

        </div>
        
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-12" > 
                <label class="label-form" for="vaca_observaciones">Observaciones</label>
                <textarea class="form-control" id="vaca_observaciones"  rows="4" cols="50" value="<?php echo '' . $arreglo_sql['vaca_observaciones'] . '';?>" name="vaca_observaciones"><?php echo '' . $arreglo_sql['vaca_observaciones'] . '';?></textarea> 
            </div>           
        </div>

        <input type="submit" class="btn btn-success col-12 col-md-6 py-3" value="Actualizar datos" >

    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>