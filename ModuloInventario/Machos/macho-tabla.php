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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <title>Tabla de inventario - machos</title>
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
        <h1 class=" text-center mb-4">Inventario de registros de machos</h1>

        <div class="d-flex flex-row justify-content-between mb-1 mb-0">

            <div class="col-0 col-xl-8"></div>

            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">

                <a class="mx-2 form-control btn btn-dark d-flex flex-row justify-content-evenly align-items-center" href="macho-form.php">
                    <i class="fa-solid fa-circle-plus fa-2x"></i>
                    <span>Capturar un macho</span>
                </a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a class="h-100 form-control btn btn-secondary d-flex flex-row justify-content-evenly align-items-center" href="../menu-inventario.php">
                    <span>Regresar al menú</span>
                </a> 

            </div>

        </div>

    </div> 
</section>
    
<section class="mb-5 mt-4" style=" padding-right: 3%; padding-left: 3%;">
    <div style=" border: 1px solid #000; overflow-x:auto;">
    <?php
        try {
            // Consulta SQL con prepared statement filtrando por rol=agente
            //$sql = "SELECT id_macho, padre_num, padre_raza, madre_num, madere_raza FROM hembra WHERE rol = 'agente'";
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
            macho_observaciones, fecha_registro FROM machos";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            // Mostrar los resultados en una tabla HTML
            echo '<table id="tabla_machos" class="table table-bordered table-striped border border-2 " >
                    <thead>
                    <tr>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar hoja de vida</th>

                        <th scope="col">Número del macho</th>
                        <th scope="col">Número de arete</th>
                        <th scope="col">Tatuaje</th>
                        <th scope="col">Raza de la macho</th>
                        <th scope="col">Estado reproductivo</th>
                        <th scope="col">Estatus del arete</th>
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
                        <th scope="col">Potrero</th>
                        <th scope="col">Lote</th>                        
                        <th scope="col">Finado</th>
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
                        <th scope="col">Fecha de venta</th>
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
                            <form action="eliminar-macho.php" method="POST">
                                <input type="hidden" name="id_macho"  value="'. $arreglo_sql['id_macho'].'" >
                                <button type="submit" id="botonEliminar" class="form-control btn-danger" style="font-size:12px; " ><i style="margin-right:5px;" class="bi bi-trash"></i>
                                     Eliminar
                                </button>
                            </form>
                         </td>';

                    echo '<td> 
                            <form action="editar-macho.php" method="POST">
                                <input type="hidden" name="id_macho" value="'. $arreglo_sql['id_macho'].'">
                                <button type="submit" class="form-control btn-info"><i style="margin-right:5px;" class="bi bi-pencil-square"></i>Editar</button>
                            </form>
                         </td>';
                   
                        echo '<td>' . $arreglo_sql['macho_numero'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_arete'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_tatuaje'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_raza'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_estado_re'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_estatus'] . '</td>';
                        echo '<td>' . $arreglo_sql['madre_numero'] . '</td>';
                        echo '<td>' . $arreglo_sql['madre_arete'] . '</td>';
                        echo '<td>' . $arreglo_sql['madre_tatuaje'] . '</td>';
                        echo '<td>' . $arreglo_sql['madre_raza'] . '</td>';
                        echo '<td>' . $arreglo_sql['padre_numero'] . '</td>';
                        echo '<td>' . $arreglo_sql['padre_arete'] . '</td>';
                        echo '<td>' . $arreglo_sql['padre_tatuaje'] . '</td>';
                        echo '<td>' . $arreglo_sql['padre_raza'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_color'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_talla'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_pelo'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_condicion'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_potrero'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_lote'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_finado'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_edad_actual'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_edad_destete'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_edad_venta'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_peso_nacimiento'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_peso_actual'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_peso_destete'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_peso_venta'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_gan_peso_dia'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_gan_peso_mes'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_peso_3meses'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_fecha_nacimiento'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_fecha_destete'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_fecha_aretado'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_fecha_tatuaje'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_fecha_fierro'] . '</td>';
                        echo '<td>' . $arreglo_sql['macho_fecha_venta'] . '</td>';
                        echo '<td> <a data-fancybox="gallery" href="' . $arreglo_sql['macho_foto'] .'"><img src="' . $arreglo_sql['macho_foto'] .'" width="50" height="40" alt="Vacio"></a></td>';
                        echo '<td> <a data-fancybox="gallery" href="' . $arreglo_sql['macho_foto_fierro'] .'"><img src="' . $arreglo_sql['macho_foto_fierro'] .'" width="50" height="40" alt="Vacio"></a></td>';
                        echo '<td>' . $arreglo_sql['macho_observaciones'] . '</td>';
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
    ?>
    </div>
</section>

<div class="d-flex col-12 justify-content-center" style="margin-bottom: 20px;">
    <h5 class="col-11">Resumen de inventario de machos</h5>
</div>

<?php
    /// ESTADO REPRODUCTIVO /////////////////////////////////////////////////////////////////////////
    // Realizar la consulta para machos toretes
    $sql_toretes = "SELECT COUNT(*) as total_toretes FROM machos WHERE macho_estado_re = 'Torete'";
    $stmt_toretes = $conexion->prepare($sql_toretes);
    $stmt_toretes->execute();
    $result_toretes = $stmt_toretes->fetch(PDO::FETCH_ASSOC);
    $machos_toretes = $result_toretes['total_toretes'];

    // Realizar la consulta para machos preñadas
    $sql_sementales = "SELECT COUNT(*) as total_sementales FROM machos WHERE macho_estado_re = 'Toro semental'";
    $stmt_sementales = $conexion->prepare($sql_sementales);
    $stmt_sementales->execute();
    $result_sementales = $stmt_sementales->fetch(PDO::FETCH_ASSOC);
    $machos_sementales = $result_sementales['total_sementales'];


    // ARETADOS //////////////////////////////////////////////////////////////////////////////////////////
    $sql_vigentes = "SELECT COUNT(*) as total_vigentes FROM machos WHERE macho_estatus = 'Vigente'";
    $stmt_vigentes = $conexion->prepare($sql_vigentes);
    $stmt_vigentes->execute();
    $arreglo_vigentes = $stmt_vigentes->fetch(PDO::FETCH_ASSOC);
    $aretes_vigentes = $arreglo_vigentes['total_vigentes'];

    $sql_pendientes = "SELECT COUNT(*) as total_pendientes FROM machos WHERE macho_estatus = 'Pendiente'";
    $stmt_pendientes = $conexion->prepare($sql_pendientes);
    $stmt_pendientes->execute();
    $arreglo_pendientes = $stmt_pendientes->fetch(PDO::FETCH_ASSOC);
    $aretes_pendientes = $arreglo_pendientes['total_pendientes'];
    
    $sql_bajas = "SELECT COUNT(*) as total_bajas FROM machos WHERE macho_estatus = 'Baja'";
    $stmt_bajas = $conexion->prepare($sql_bajas);
    $stmt_bajas->execute();
    $arreglo_bajas = $stmt_bajas->fetch(PDO::FETCH_ASSOC);
    $aretes_bajas = $arreglo_bajas['total_bajas'];

    // FINADAS ////////////////////////////////////////////////////////////////////////////
    $sql_finados = "SELECT COUNT(*) as total_finados FROM machos WHERE macho_finado = 'Si'";
    $stmt_finados = $conexion->prepare($sql_finados);
    $stmt_finados->execute();
    $arreglo_finados = $stmt_finados->fetch(PDO::FETCH_ASSOC);
    $finados = $arreglo_finados['total_finados'];

?>

<section class="d-flex col-12 justify-content-center" style="margin-bottom: 200px;">
    <div class="d-flex col-11 justify-content-md-around justify-content-center flex-md-row flex-column " style=" border: #000 solid 1px; padding: 20px; ">
        <div class="col-md-3">
            <table class="table table-bordered">
                <tr>
                    <th>Estado reproductivo</th>
                    <th>Cantidad</th>
                </tr>
                <tr>
                    <td>Toretes</td>
                    <td><?php echo $machos_toretes; ?></td>
                </tr>
                <tr>
                    <td>Toro semental</td>
                    <td><?php echo $machos_sementales; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td class="fw-bold"><?php echo ($machos_toretes + $machos_sementales); ?></td>
                </tr>
            </table>
        </div>

        <div class="col-md-3">
            <table class="table table-bordered">
                <tr>
                    <th>Aretes</th>
                    <th>Cantidad</th>
                </tr>

                <tr>
                    <td>Vigente</td>
                    <td><?php echo $aretes_vigentes; ?></td>
                </tr>
                <tr>
                    <td>Pendiente</td>
                    <td><?php echo $aretes_pendientes; ?></td>
                </tr>
                <tr>
                    <td>Baja</td>
                    <td><?php echo $aretes_bajas; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td class="fw-bold"><?php echo ($aretes_vigentes + $aretes_pendientes + $aretes_bajas); ?></td>
                </tr>
            </table>
        </div>

        <div class="col-md-3">
            <table class="table table-bordered">
                <tr>
                    <th>Fallecidos</th>
                </tr>

                <tr>
                    <td><?php echo $finados; ?></td>
                </tr>
            </table>
        </div>
    </div>
</section>

<!-- codigo de fancybox -->
<script>
    $(document).ready(function() {
  // Inicializar FancyBox
  $('[data-fancybox="gallery"]').fancybox({
    // Opciones adicionales aquí
  });
});
</script>

<!-- codigo de datatables -->
<script>
    $(document).ready(function() {
        $('#tabla_machos').DataTable({
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