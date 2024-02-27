<?php
include("conexion.php");
// session_start();

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: login.html");
//     exit;
// } else {
//     echo 'Usuario autenticado con ID: '.$_SESSION['id_usuario'];
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/f7e7d9df55.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.0/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.0/datatables.min.js"></script>


    <title>Tabla de inventario - Vacas</title>
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
    .dt-layout-row{
        padding:10px;
    }
    .dt-search{
        margin-right:40px;
    }
    .dt-search label{
        margin-right:10px;
        font-weight:600;
    }
</style>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-1 mt-2">
    <div class="col-11 col-md-11">
          <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="" width="110" height="100"> -->
        <h1 class=" text-center mb-4">Inventario de registros de vacas</h1>

        <div class="d-flex flex-row justify-content-between mb-1 mb-0">

            <div class="col-0 col-xl-8"></div>

            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">

                <a class="mx-2 form-control btn btn-primary d-flex flex-row justify-content-evenly align-items-center" href="hembra.php">
                    <i class="fa-solid fa-circle-plus fa-2x"></i>
                    <span>Registrar una vaca</span>
                </a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a class="h-100 form-control btn btn-secondary d-flex flex-row justify-content-evenly align-items-center" href="menu-inventario.php">
                    <span>Regresar al menú</span>
                </a> 

            </div>

        </div>
        <!-- <div class="d-flex  flex-row mb-2 justify-content-start col-md-2 col-7">
            <button class="form-control btn btn-danger " style="font-size:12px;" onclick="habilitarBotonEliminar()">Habilitar Botón Eliminar</button>
        </div> -->
    </div> 
</section>
    
<section class="mb-5 mt-4" style=" padding-right: 3%; padding-left: 3%;">
    <div style=" border: 1px solid #000; overflow-x:auto;">
    <?php
        try {
            // Consulta SQL con prepared statement filtrando por rol=agente
            //$sql = "SELECT id_vaca, padre_num, padre_raza, madre_num, madere_raza FROM hembra WHERE rol = 'agente'";
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
            vaca_observaciones, fecha_registro FROM vacas";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            // Mostrar los resultados en una tabla HTML
            echo '<table id="tabla_vacas" class="table table-bordered table-striped border border-2 " >
                    <thead>
                    <tr>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar hoja de vida</th>
                        <th scope="col">Agregar parto</th>
                        <th scope="col">Número de la vaca</th>
                        <th scope="col">Número de arete</th>
                        <th scope="col">Tatuaje</th>
                        <th scope="col">Raza de la vaca</th>
                        <th scope="col">Número de la madre</th>
                        <th scope="col">Número de arete de la madre</th>
                        <th scope="col">Tatuaje de la madre</th>
                        <th scope="col">Raza de la madre</th>
                        <th scope="col">Número del padre</th>
                        <th scope="col">Número de arete del padre</th>
                        <th scope="col">Tatuaje del padre</th>
                        <th scope="col">Raza del padre</th>
                        <th scope="col">Color</th>
                        <th scope="col">Talla</th>
                        <th scope="col">Pelo</th>
                        <th scope="col">Condición</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Potrero</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Estado reproductivo</th>
                        <th scope="col">Celo</th>
                        <th scope="col">Partos totales</th>
                        <th scope="col">Estado de palpación</th>
                        <th scope="col">Finada</th>
                        <th scope="col">Edad actual</th>
                        <th scope="col">Edad destete</th>
                        <th scope="col">Edad de venta</th>
                        <th scope="col">Peso de nacimiento</th>
                        <th scope="col">Peso actual</th>
                        <th scope="col">Peso destete</th>
                        <th scope="col">Peso de venta</th>
                        <th scope="col">Ganancia de peso por día</th>
                        <th scope="col">Ganancia de peso por mes</th>
                        <th scope="col">Peso en 3 meses</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Fecha de destete</th>
                        <th scope="col">Fecha de aretado</th>
                        <th scope="col">Fecha de tatuaje</th>
                        <th scope="col">Fecha de fierro</th>
                        <th scope="col">Fecha probable</th>
                        <th scope="col">Fecha de venta</th>
                        <th scope="col">Leche al día</th>
                        <th scope="col">Leche al mes</th>
                        <th scope="col">Comentario de leche</th>
                        <th scope="col">Fotografía</th>
                        <th scope="col">Fotografía del fierro</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Fecha de registro</th>

                    </tr>
                    </thead>
                    <tbody>';
        
            while ($arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';

                    echo '<td> 
                            <form action="eliminar-hembra.php" method="POST">
                                <input type="hidden" name="id_vaca"  value="'. $arreglo_sql['id_vaca'].'" >
                                <button type="submit" id="botonEliminar" class="form-control btn-danger" style="font-size:12px; " ><i style="margin-right:5px;" class="bi bi-trash"></i>
                                     Eliminar
                                </button>
                            </form>
                         </td>';

                    echo '<td> 
                            <form action="editar-hembra.php" method="POST">
                                <input type="hidden" name="id_vaca" value="'. $arreglo_sql['id_vaca'].'">
                                <button type="submit" class="form-control btn-info"><i style="margin-right:5px;" class="bi bi-pencil-square"></i>Editar</button>
                            </form>
                         </td>';
                        
                    echo '<td> 
                         <form action="crias-form.php" method="POST">
                             <input type="hidden" name="id_vaca" value="'. $arreglo_sql['id_vaca'].'">
                             <button type="submit" class="form-control btn-info"><i style="color:white;" class="fa-solid fa-circle-plus"></i>Agregar</button>
                         </form>
                      </td>';
                   
                         echo '<td>' . $arreglo_sql['vaca_numero'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_arete'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_tatuaje'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_raza'] . '</td>';
                         echo '<td>' . $arreglo_sql['madre_numero'] . '</td>';
                         echo '<td>' . $arreglo_sql['madre_arete'] . '</td>';
                         echo '<td>' . $arreglo_sql['madre_tatuaje'] . '</td>';
                         echo '<td>' . $arreglo_sql['madre_raza'] . '</td>';
                         echo '<td>' . $arreglo_sql['padre_numero'] . '</td>';
                         echo '<td>' . $arreglo_sql['padre_arete'] . '</td>';
                         echo '<td>' . $arreglo_sql['padre_tatuaje'] . '</td>';
                         echo '<td>' . $arreglo_sql['padre_raza'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_color'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_talla'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_pelo'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_condicion'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_estatus'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_potrero'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_lote'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_estado_re'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_celo'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_partos'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_estado_pal'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_finada'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_edad_actual'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_edad_destete'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_edad_venta'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_peso_nacimiento'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_peso_actual'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_peso_destete'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_peso_venta'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_gan_peso_dia'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_gan_peso_mes'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_peso_3meses'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_fecha_nacimiento'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_fecha_destete'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_fecha_aretado'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_fecha_tatuaje'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_fecha_fierro'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_fecha_probable'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_fecha_venta'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_leche_dia'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_leche_mes'] . '</td>';
                         echo '<td>' . $arreglo_sql['vaca_leche_comentario'] . '</td>';
                         echo '<td> <img src="' . $arreglo_sql['vaca_foto'] .'" width="50" height="40" alt="Vacio"></td>';
                         echo '<td> <img src="' . $arreglo_sql['vaca_foto_fierro'] .'" width="50" height="40" alt="Vacio"></td>';
                         echo '<td>' . $arreglo_sql['vaca_observaciones'] . '</td>';
                         echo '<td>' . $arreglo_sql['fecha_registro'] . '</td>';
                    // echo '<td><a href="fpdf/reporte-agente.php?id=' . $arreglo_sql['id_usuario'] . '" target="_blank" class="btn btn-success">Generar reporte<svg style="padding-left:5px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                    //      <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                    //     </svg></a></td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
        // Cerrar la conexión
        $conexion = null;
    ?>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#tabla_vacas').DataTable({
            ordering: true, //botones de ordenacion de las columnas
            "orderable": true,
            "searching": true, // función de búsqueda activada
            search: {
               return: false
            },
            "language": { 
              "decimal" : "",
              "emptyTable":"No hay registros",
              "info": "Mostrando _END_ de _TOTAL_ registros",
              "infoEmpty": "Mostrando 0 de 0 registros",
              "infoFiltered": "(Se filtraron _MAX_ registros)",
              "infoPostFix":"",
              "thousands": ", ",
              "lengthMenu": "Mostrar _MENU_ registros",
              "loadingRecords":"Cargando...",
              "processing": "Procesando...",
              "search": "Buscar: ",
              "zeroRecords":"No se encontraron resultados.",
              "paginate":{
                "first":"<<",
                "last":">>",
                "next": "Siguiente",
                "previous": "Anterior"
              }
            },
            "lengthMenu": [ [10, 20, 30, 40, 50, 100, 1000], [10, 20, 30, 40, 50, 100, 1000] ],
            "scrollY": "500px", // Altura del área de desplazamiento vertical
            "scrollCollapse": true // Colapso del scroll cuando no es necesario
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>