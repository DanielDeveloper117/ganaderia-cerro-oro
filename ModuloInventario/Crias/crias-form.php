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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../../jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../styles/styles-crias.css">

    <title>Alta de crías</title>
</head>
<body>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-5 section-buttons">
    <div class="col-11 col-md-10">
        <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h1 class=" text-center mb-4">Producción de crías</h1>

        <div class="d-flex flex-row justify-content-end mb-1 mb-0">
            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">
                <a class="mx-lg-2  h-100 w-100 d-flex flex-row justify-content-evenly align-items-center" href="crias-tabla.php">
                    <button class="btn-principal" >Ver registros</button>
                </a>
                <a class=" h-100  d-flex w-100 flex-row justify-content-evenly align-items-center" href="../menu-inventario.php">
                    <button class="btn-principal" >Regresar al menú</button>
                </a> 
            </div>
        </div>
    </div> 
</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    
    <form class="d-flex flex-column col-11 col-md-10 justify-content-center align-items-center formulario"  action="crias-form-script.php" method="POST" >
        <p class="p-form">Formulario para dar de alta una cría.</p>
        <?php
            if (isset($_POST['id_vaca'])) {
                echo '<h5>Capturar parto</h5> ';
            }else{
                echo '<h5>Capturar cría</h5> ';
            }
        ?>
        
        <h3 class="mb-4">Información principal</h3> 

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" col-md-3" >
                <label class="label-form" for="cria_numero">Número de la madre</label>
                <?php
                    if (isset($_POST['id_vaca'])) {
                        $id_vaca = $_POST['id_vaca'];
                        $sql = "SELECT id_vaca, vaca_numero FROM vacas WHERE id_vaca = :id_vaca";
                        $stmt = $conexion->prepare($sql);
                        $stmt->bindParam(':id_vaca', $id_vaca);
                        $stmt->execute();
                        $arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo '<input type="number" class="form-control" id="cria_numero" value="'.$arreglo_sql['vaca_numero'].'" name="madre_numero" required>';
                        //echo '<input type="hidden" name="id_vaca" value="'. $id_vaca.'">';
                    } else{
                        echo '<input type="number" class="form-control" id="cria_numero" placeholder="Número de la madre" name="madre_numero" required>';
                    }
                ?>
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="cria_sexo">Estado productivo</label>
                <select class="form-select" style="cursor: pointer; " id="cria_sexo" name="cria_sexo" required>
                        <?php
                            if (isset($_POST['id_vaca'])) {
                                echo '
                                    <option class="option-hover" value="" selected>Seleccionar</option>
                                    <option class="option-hover" value="Ternera">Ternera 0-6 meses</option>
                                    <option class="option-hover" value="Ternero">Ternero 0-6 meses</option>
                                ';
                            } else{
                                echo '
                                    <option class="option-hover" value="">Seleccionar</option>
                                    <option class="option-hover" value="Ternera">Ternera 0-6 meses</option>
                                    <option class="option-hover" value="Ternero">Ternero 0-6 meses</option>
                                    <option class="option-hover" value="Becerra">Becerra 7-12 meses</option>
                                    <option class="option-hover" value="Becerro">Becerro 7-12 meses</option>
                                    <option class="option-hover" value="Torete">Torete 13-18 meses</option>
                                ';
                            }
                        ?>
                </select>
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="cria_edad">Edad
                <?php
                    if (isset($_POST['id_vaca'])) {
                        echo ' 0-6 meses';
                    }else{
                        echo '';
                    }
                ?>
                </label>
                <input type="number" class="form-control" id="cria_edad" step="1" min="" max="" pattern="" maxlength="" title="" placeholder="Edad actual" name="cria_edad" required>
            </div>  
            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="cria_fecha_nacimiento" placeholder="Seleccionar fecha" name="cria_fecha_nacimiento" >
            </div>  
        </div>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" col-md-3" >
                <label class="label-form" for="cria_numero">Número de la cria</label>
                <input type="number" class="form-control" id="cria_numero" placeholder="Número de la cría" name="cria_numero" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="cria_arete">Arete de la cria</label>
                <input type="text" class="form-control" id="cria_arete" placeholder="Número del arete de la cria" name="cria_arete" >
            </div>  
            <div class=" col-md-2" >
                <label class="label-form" for="cria_estado_arete">Estatus del arete</label>
                <select class="form-select" style="cursor: pointer; " id="cria_estado_arete" name="cria_estado_arete" required>
                        <option class="option-hover" value="" selected>Seleccionar</option>
                        <option class="option-hover" value="Vigente">Vigente</option>
                        <option class="option-hover" value="Pendiente">Pendiente</option>
                        <option class="option-hover" value="Baja">Baja</option>
                </select>  
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="cria_tatuaje">Tatuaje de la cria</label>
                <input type="text" class="form-control" id="cria_tatuaje" placeholder="Tatuaje de la cria" name="cria_tatuaje" >
            </div> 
        </div>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" col-md-3" >
                <label class="label-form" for="cria_raza">Raza</label>
                <input type="text" class="form-control" id="cria_raza" placeholder="Raza de la cria" name="cria_raza" >
            </div>
        </div>

        <h3 class="">Pesos</h3>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_nacimiento">Peso de nacimiento</label>
                <input type="number" class="form-control" id="cria_peso_nacimiento" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 32.565" name="cria_peso_nacimiento" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_destete">Peso destete</label>
                <input type="number" class="form-control" id="cria_peso_destete" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 125.345" name="cria_peso_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_venta">Peso de venta</label>
                <input type="number" class="form-control" id="cria_peso_venta" step="0.001" min="0" max="9999.999" placeholder="Digitar peso de venta" name="cria_peso_venta" >
            </div>              
            <div class=" col-md-2" >
                <label class="label-form" for="cria_finada">Cría finada</label>
                <select class="form-select" style="cursor: pointer; " id="cria_finada" name="cria_finada">
                        <option class="option-hover" value="Si">Si</option>
                        <option class="option-hover" value="No" selected>No</option>
                </select>
            </div>
        </div>

        <h3 class="">Otras fechas</h3>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_destete">Fecha de destete</label>
                <input type="date" class="form-control" id="cria_fecha_destete" placeholder="Seleccionar fecha" name="cria_fecha_destete" >
            </div>
            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_aretado">Fecha aretado</label>
                <input type="date" class="form-control" id="cria_fecha_aretado" placeholder="Fecha aretado" name="cria_fecha_aretado" >
            </div>

            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_tatuaje">Fecha de tatuaje</label>
                <input type="date" class="form-control" id="cria_fecha_tatuaje" placeholder="Fecha aretado" name="cria_fecha_tatuaje" >
            </div>
        </div>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-2 " >
                <label class="label-form" for="cria_fecha_fierro">Fecha de fierro</label>
                <input type="date" class="form-control" id="cria_fecha_fierro" placeholder="Fecha aretado" name="cria_fecha_fierro" >
            </div>                               
            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_venta">Fecha de venta</label>
                <input type="date" class="form-control" id="cria_fecha_venta" placeholder="Seleccionar fecha" name="cria_fecha_venta" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>  

        <!-- <h3 class="">Información adicional</h3>

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
        
        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class="col-md-12" > 
                <label class="label-form" for="cria_observaciones">Observaciones</label>
                <textarea class="form-control" id="cria_observaciones"  rows="4" cols="50" name="cria_observaciones"></textarea> 
            </div>           
        </div>

        <button id="btn-submit" type="submit" class=" col-12 col-xl-6 py-3 btn-submit">Enviar datos</button>

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
                case '':
                    alert('Por favor seleccione un estado productivo.');
                    break;
                case 'Ternera':
                case 'Ternero':
                    $('button[type="submit"]').prop('disabled', false); 
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
                    $('button[type="submit"]').prop('disabled', false); 
                    $('#cria_edad').attr({
                        'min': '7',
                        'max': '12',
                        'pattern': '[7-12]',
                        'maxlength': '2',
                        'title': 'Ingrese un número del 7 al 12'
                    });
                    $('label[for="cria_edad"]').text('Edad 7-12 meses');
                    break;
                // case 'Novillona':
                //     $('button[type="submit"]').prop('disabled', false); 
                //     $('#cria_edad').attr({
                //         'min': '13',
                //         'max': '36',
                //         'pattern': '[13-36]',
                //         'maxlength': '2',
                //         'title': 'Ingrese un número del 13 al 36'
                //     });
                //     $('label[for="cria_edad"]').text('Edad 13-36 meses');                
                //     break;
                case 'Torete':
                    $('button[type="submit"]').prop('disabled', false); 
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
                    alert('Por favor seleccione un estado productivo.');
                    $('button[type="submit"]').prop('disabled', true);
                    $('#cria_edad').attr({
                        'min': '',
                        'max': '',
                        'pattern': '',
                        'maxlength': '',
                        'title': ''
                    });
                    $('label[for="cria_edad"]').text('Edad');
                    break;
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