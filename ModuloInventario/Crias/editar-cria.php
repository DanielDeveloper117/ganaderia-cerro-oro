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
    if (isset($_POST['id_cria'])) {
        $id_cria = $_POST['id_cria'];

        try {
            // Consulta SQL con prepared statement filtrando por rol=agente
            //$sql = "SELECT id_cria, padre_num, padre_raza, madre_num, madere_raza FROM hembra WHERE rol = 'agente'";
            $sql = "SELECT id_cria, madre_numero, cria_edad, cria_sexo, 
            cria_fecha_nacimiento, cria_numero, cria_arete, cria_estado_arete, cria_tatuaje, cria_raza, 
            cria_peso_nacimiento, cria_peso_destete, cria_peso_venta, cria_finada, 
            cria_fecha_destete, cria_fecha_aretado, cria_fecha_tatuaje, 
            cria_fecha_fierro, cria_fecha_venta, cria_observaciones FROM crias WHERE id_cria = :id_cria";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_cria', $id_cria);
            $stmt->execute();
            $arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC);
 

        }catch (PDOException $e) {
            // Error cuando no se ejecuta la consulta SQL
            echo "<script>alert('Hubo un error al ejecutar la consulta SQL.');</script>";
            //echo "Error: " . $e->getMessage();
            echo '
            <div class="d-flex col-12 justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
                <h2 class="mb-3">Los datos no fueron enviados</h2>
                <i style="color:red;" class="col-8 col-xl-5 mb-3 text-center fa-regular fa-circle-xmark fa-3x"></i>
                <a href="cria-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
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
    } else {
        echo "<script>alert('Hubo un error al recibir el id de la cría.');</script>";
        //echo "Error: " . $e->getMessage();
        echo '
        <div class="d-flex col-12 justify-content-center align-items-center flex-column" style="width:100%; margin-top:100px;">
            <h2 class="mb-3">Los datos no fueron enviados</h2>
            <i style="color:red;" class="col-8 col-xl-5 mb-3 text-center fa-regular fa-circle-xmark fa-3x"></i>

            <a href="cria-tabla.php" class="col-8 col-xl-5 mb-3 btn btn-primary" >
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
    <meta value="<?php echo '' . $arreglo_sql['id_cria'] . '';?>" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../../jquery-3.7.1.min.js"></script>

    <title>Editar registro de cria</title>
</head>
<body>

<style>
    section form div{
        width: 100%;
       margin-bottom: 15px;
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
    form{
        border: 1px solid #ccc;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        background-color: #f9f9f9;
        padding: 3%;
        border-radius:10px
    }
    form h3{
        text-align:left;
        padding-bottom:15px;
    }
   .btn-prod{
        text-align:center;
   }
   .p-form{
        text-align:center;
        margin-bottom: 20px;
   }
</style>

<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-5">

    <div class="col-11 col-md-10">
        <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h1 class=" text-center mb-4">Cría número: <?php echo '' . $arreglo_sql['cria_numero'] . '';?></h1>

        <div class="d-flex flex-row justify-content-between mb-1 mb-0">

            <div class="col-0 col-xl-8"></div>

            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">

                <a class="mx-2  h-100 form-control btn btn-warning d-flex flex-row justify-content-evenly align-items-center" href="crias-tabla.php">
                    <!-- <i class="fa-solid fa-circle-plus fa-2x"></i> -->
                    <span>Cancelar y regresar</span>
                </a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a class=" h-100 form-control btn btn-secondary d-flex flex-row justify-content-evenly align-items-center" href="../menu-inventario.php">
                    <span>Regresar al menú</span>
                </a> 

            </div>

        </div>
    </div> 

</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    

    <form class=" d-flex flex-column col-11 col-md-10 justify-content-center align-items-center"  action="crias-editar-script.php" method="POST" >
        <input type="hidden"  value="<?php echo '' . $arreglo_sql['id_cria'] . '';?>" name="id_cria">

        <p class="p-form">Formulario de editar informacion de la cría.</p>
        <h3>Editar cría</h3> 

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        
            <div class=" col-md-3" >
                <label class="label-form" for="cria_numero">Número de la madre</label>
                <input type="number" class="form-control" id="cria_numero" value="<?php echo '' . $arreglo_sql['madre_numero'] . '';?>" placeholder="Número de la madre" name="madre_numero" >
            </div>
 
            <div class=" col-md-2" >
                <label class="label-form" for="cria_sexo">Estado productivo</label>
                <select class="form-select" style="cursor: pointer; " id="cria_sexo" name="cria_sexo" required>
                    <option class="option-hover" value="<?php echo '' . $arreglo_sql['cria_sexo'] . '';?>" selected><?php echo '' . $arreglo_sql['cria_sexo'] . '';?></option>
                    <option class="option-hover" value="Ternera">Ternera 0-6 meses</option>
                    <option class="option-hover" value="Ternero">Ternero 0-6 meses</option>
                    <option class="option-hover" value="Becerra">Becerra 7-12 meses</option>
                    <option class="option-hover" value="Becerro">Becerro 7-12 meses</option>
                    <option class="option-hover" value="Novillona">Novillona 13-36 meses</option>
                    <option class="option-hover" value="Torete">Torete 13-18 meses</option>
                </select>
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="cria_edad">Edad</label>
                <input type="number" class="form-control" id="cria_edad" step="1" min="" max="" pattern="" maxlength="" title="" placeholder="Edad actual" value="<?php echo '' . $arreglo_sql['cria_edad'] . '';?>" name="cria_edad" required>
            </div> 

            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="cria_fecha_nacimiento" value="<?php echo '' . $arreglo_sql['cria_fecha_nacimiento'] . '';?>" placeholder="Seleccionar fecha" name="cria_fecha_nacimiento" >
            </div>  
        
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        
            <div class=" col-md-2" >
                <label class="label-form" for="cria_numero">Número de la cria</label>
                <input type="number" class="form-control" id="cria_numero" value="<?php echo '' . $arreglo_sql['cria_numero'] . '';?>" placeholder="Número de la cría" name="cria_numero" >
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="cria_arete">Arete de la cria</label>
                <input type="text" class="form-control" id="cria_arete" value="<?php echo '' . $arreglo_sql['cria_arete'] . '';?>" placeholder="Número del arete de la cria" name="cria_arete" >
            </div>  
            
            <div class=" col-md-2" >
                <label class="label-form" for="cria_estado_arete">Estatus del arete</label>
                <select class="form-select" style="cursor: pointer; " id="cria_estado_arete" name="cria_estado_arete">
                    <option class="option-hover" value="<?php echo '' . $arreglo_sql['cria_estado_arete'] . '';?>" selected><?php echo '' . $arreglo_sql['cria_estado_arete'] . '';?></option>
                    <option class="option-hover" value="Vigente">Vigente</option>
                    <option class="option-hover" value="Pendiente">Pendiente</option>
                    <option class="option-hover" value="Baja">Baja</option>
                </select>  
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="cria_tatuaje">Tatuaje de la cria</label>
                <input type="text" class="form-control" id="cria_tatuaje" placeholder="Tatuaje de la cria" name="cria_tatuaje" >
            </div> 
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">    
            <div class=" col-md-3" >
                <label class="label-form" for="cria_raza">Raza</label>
                <input type="text" class="form-control" id="cria_raza" placeholder="Raza de la cria" name="cria_raza" >
            </div>
        </div>
        
            <div class=" col-md-3" >
                <label class="label-form" for="cria_raza">Raza</label>
                <input type="text" class="form-control" id="cria_raza" value="<?php echo '' . $arreglo_sql['cria_raza'] . '';?>" placeholder="Raza de la cria" name="cria_raza" >
            </div>
        </div>
        
        <h3 class="pt-4">Pesos</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_nacimiento">Peso de nacimiento</label>
                <input type="number" class="form-control" id="cria_peso_nacimiento" step="0.001" min="0" max="9999.999" value="<?php echo '' . $arreglo_sql['cria_peso_nacimiento'] . '';?>" placeholder="Ejemplo 32.565" name="cria_peso_nacimiento" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_destete">Peso destete</label>
                <input type="number" class="form-control" id="cria_peso_destete" step="0.001" min="0" max="9999.999" value="<?php echo '' . $arreglo_sql['cria_peso_destete'] . '';?>" placeholder="Ejemplo 125.345" name="cria_peso_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_venta">Peso de venta</label>
                <input type="number" class="form-control" id="cria_peso_venta" step="0.001" min="0" max="9999.999" value="<?php echo '' . $arreglo_sql['cria_peso_venta'] . '';?>" placeholder="Digitar peso de venta" name="cria_peso_venta" >
            </div>              

            <div class=" col-md-2" >
                <label class="label-form" for="cria_finada">Cría finada</label>
                <select class="form-select" style="cursor: pointer; " id="cria_finada" name="cria_finada">
                        <option class="option-hover" value="<?php echo '' . $arreglo_sql['cria_finada'] . '';?>" selected><?php echo '' . $arreglo_sql['cria_finada'] . '';?></option>
                        <option class="option-hover" value="si">Si</option>
                        <option class="option-hover" value="no">No</option>
                </select>
            </div>
        </div>


        <h3 class="pt-4">Otras fechas</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
      
            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_destete">Fecha de destete</label>
                <input type="date" class="form-control" id="cria_fecha_destete" value="<?php echo '' . $arreglo_sql['cria_fecha_destete'] . '';?>" placeholder="Seleccionar fecha" name="cria_fecha_destete" >
            </div>
            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_aretado">Fecha aretado</label>
                <input type="date" class="form-control" id="cria_fecha_aretado" value="<?php echo '' . $arreglo_sql['cria_fecha_aretado'] . '';?>" placeholder="Fecha aretado" name="cria_fecha_aretado" >
            </div>

            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_tatuaje">Fecha de tatuaje</label>
                <input type="date" class="form-control" id="cria_fecha_tatuaje" value="<?php echo '' . $arreglo_sql['cria_fecha_tatuaje'] . '';?>" placeholder="Fecha aretado" name="cria_fecha_tatuaje" >
            </div>
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <!-- Nuevo input -->
            <div class="col-md-2 " >
                <label class="label-form" for="cria_fecha_fierro">Fecha de fierro</label>
                <input type="date" class="form-control" id="cria_fecha_fierro" value="<?php echo '' . $arreglo_sql['cria_fecha_fierro'] . '';?>" placeholder="Fecha aretado" name="cria_fecha_fierro" >
            </div>                               

            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_venta">Fecha de venta</label>
                <input type="date" class="form-control" id="cria_fecha_venta" value="<?php echo '' . $arreglo_sql['cria_fecha_venta'] . '';?>" placeholder="Seleccionar fecha" name="cria_fecha_venta" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>  

        <!-- <h3 class="pt-4">Información adicional</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-5" >
                <label class="label-form" for="cria_foto">Fotografía de la cria</label>
                <input class="form-control" type="file" id="cria_foto"  accept="image/*" name="cria_foto">
            </div>   
            <div class=" col-md-5" >
                <label class="label-form" for="cria_foto_fierro">Fotografía fierro</label>
                <input class="form-control" type="file" id="cria_foto_fierro"  accept="image/*" name="cria_foto_fierro">
        </div>
        </div> -->
        
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-12" > 
                <label class="label-form" for="cria_observaciones">Observaciones</label>
                <textarea class="form-control" id="cria_observaciones"  rows="4" cols="50" value="<?php echo '' . $arreglo_sql['cria_fecha_venta'] . '';?>" name="cria_observaciones"></textarea> 
            </div>           
        </div>

        <input type="submit" class="btn btn-success col-12 col-xl-6 py-3" value="Actualizar datos" >

    </form>
</section>

<!-- scripts section -->
<script>
    //VALIDACIONES DE ESTADO PRODUCTIVO EN RELACION A LA EDAD
    $(document).ready(function(){
        // Detectar cambios en el selector
        $('#cria_sexo').change(function(){
            // Obtener el valor seleccionado del selector
            var opcionSeleccionada = $(this).val();
            
            // Definir las propiedades del input según la opción seleccionada
            switch(opcionSeleccionada) {
                case 'Ternera':
                case 'Ternero':
                    $('#cria_edad').attr({
                        'min': '0',
                        'max': '6',
                        'pattern': '[0-6]',
                        'maxlength': '1',
                        'title': 'Ingrese un número del 0 al 6'
                    });
                    $('label[for="cria_edad"]').text('Edad 0-6 meses');
                    break;
                case 'Becerra':
                case 'Becerro':
                    $('#cria_edad').attr({
                        'min': '7',
                        'max': '12',
                        'pattern': '[7-12]',
                        'maxlength': '2',
                        'title': 'Ingrese un número del 7 al 12'
                    });
                    $('label[for="cria_edad"]').text('Edad 7-12 meses');
                    break;
                case 'Novillona':
                    $('#cria_edad').attr({
                        'min': '13',
                        'max': '36',
                        'pattern': '[13-36]',
                        'maxlength': '2',
                        'title': 'Ingrese un número del 13 al 36'
                    });
                    $('label[for="cria_edad"]').text('Edad 13-36 meses');                
                    break;
                case 'Torete':
                    $('#cria_edad').attr({
                        'min': '13',
                        'max': '18',
                        'pattern': '[13-18]',
                        'maxlength': '2',
                        'title': 'Ingrese un número del 13 al 18'
                    });
                    $('label[for="cria_edad"]').text('Edad 13-18 meses');                 
                    break;
                default:
                    // En caso de opción no válida, restaurar valores predeterminados
                    $('#cria_edad').attr({
                        'min': '',
                        'max': '',
                        'pattern': '',
                        'maxlength': '',
                        'title': ''
                    });
                    $('label[for="cria_edad"]').text('Edad');
            }
        });
    });
    //VALIDACIONES EDAD RELACION CON FECHA DE NACIMIENTO
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el input de Edad y el input de Fecha
        var inputEdad = document.getElementById('cria_edad');
        var inputFecha = document.getElementById('cria_fecha_nacimiento');
    
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
    
        // Obtener el input de Edad y el input de Fecha
        var inputEdad = document.getElementById('cria_edad');
        var inputFecha = document.getElementById('cria_fecha_nacimiento');
    
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
</body>
</html>