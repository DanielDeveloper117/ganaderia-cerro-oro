<?php
include("../../conexion.php");
// session_start();

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: login.html");
//     exit;
// } else {
//     echo 'Usuario autenticado con ID: '.$_SESSION['id_usuario'];
// }

// CODIGO PARA SUMAR 1 MES A LA EDAD AUTOMATICAMENTE CADA QUE TRANSCURRA 1 MES COMPARADO CON SU FECHA DE NACIMIENTO, ADEMAS EL CODIGO SE EJECUTA 1 VEZ AL DIA
// Obtener la fecha actual
$fechaActual = new DateTime();
// Verificar si el script ya se ejecutó hoy
$fechaInicioDia = new DateTime($fechaActual->format('Y-m-d') . ' 00:00:00');
$fechaFinDia = new DateTime($fechaActual->format('Y-m-d') . ' 23:59:59');

$sqlVerificarEjecucion = "SELECT COUNT(*) as conteo FROM crias WHERE ultima_ejecucion >= :fechaInicioDia AND ultima_ejecucion <= :fechaFinDia";
$stmtVerificarEjecucion = $conexion->prepare($sqlVerificarEjecucion);
$fechaInicioDiaFormatted = $fechaInicioDia->format('Y-m-d H:i:s');
$fechaFinDiaFormatted = $fechaFinDia->format('Y-m-d H:i:s');

$stmtVerificarEjecucion->bindParam(':fechaInicioDia', $fechaInicioDiaFormatted);
$stmtVerificarEjecucion->bindParam(':fechaFinDia', $fechaFinDiaFormatted);
$stmtVerificarEjecucion->execute();
$resultadoVerificarEjecucion = $stmtVerificarEjecucion->fetch(PDO::FETCH_ASSOC);

if ($resultadoVerificarEjecucion['conteo'] > 0) {
    echo "Ya se han actualizado las edades hoy.\n";
} else {
    // Actualizar la ultima_ejecucion
    $sqlActualizarUltimaEjecucion = "UPDATE crias SET ultima_ejecucion = :fechaActual";
    $stmtActualizarUltimaEjecucion = $conexion->prepare($sqlActualizarUltimaEjecucion);
    $fechaActualFormatted = $fechaActual->format('Y-m-d H:i:s');
    $stmtActualizarUltimaEjecucion->bindParam(':fechaActual', $fechaActualFormatted);
    $stmtActualizarUltimaEjecucion->execute();
    // Consultar las crias
    $sqlConsultaCrias = "SELECT id_cria, cria_edad, cria_fecha_nacimiento FROM crias";
    $stmtConsultaCrias = $conexion->prepare($sqlConsultaCrias);
    $stmtConsultaCrias->execute();
    $crias = $stmtConsultaCrias->fetchAll(PDO::FETCH_ASSOC);
    // Iterar sobre las crias
    foreach ($crias as $cria) {
        $idCria = $cria['id_cria'];
        $edadCria = $cria['cria_edad'];
        $fechaNacimiento = new DateTime($cria['cria_fecha_nacimiento']);
        // Verificar condiciones para sumar 1 a la edad de la cria
        if ($fechaActual->format('m') !== $fechaNacimiento->format('m') && $fechaActual->format('d') === $fechaNacimiento->format('d')) {
            $nuevaEdad = $edadCria + 1;
        } elseif ($fechaActual->format('m') === $fechaNacimiento->format('m') && $fechaActual->format('d') === $fechaNacimiento->format('d') && $fechaActual->format('Y') !== $fechaNacimiento->format('Y')) {
            $nuevaEdad = $edadCria + 1;
        } else {
            $nuevaEdad = $edadCria;
        }
        // Actualizar la edad de la cria en la base de datos
        $sqlActualizarEdad = "UPDATE crias SET cria_edad = :nuevaEdad WHERE id_cria = :idCria";
        $stmtActualizarEdad = $conexion->prepare($sqlActualizarEdad);
        $stmtActualizarEdad->bindParam(':nuevaEdad', $nuevaEdad, PDO::PARAM_INT);
        $stmtActualizarEdad->bindParam(':idCria', $idCria, PDO::PARAM_INT);
        $stmtActualizarEdad->execute();
    }
    echo "Edades actualizadas con éxito.\n";
}

// CODIGO PARA CAMBIAR ESTADO PRODUCTIVO DE ACUERDO A SU EDAD
// Consulta SQL para actualizar el campo cria_sexo de cada registro
$sql = "
    UPDATE crias
    SET cria_sexo = 
        CASE 
            WHEN cria_sexo = 'Ternera' AND cria_edad BETWEEN 7 AND 12 THEN 'Becerra'
            WHEN cria_sexo = 'Becerra' AND cria_edad BETWEEN 13 AND 36 THEN 'Novillona'
            WHEN cria_sexo = 'Ternero' AND cria_edad BETWEEN 7 AND 12 THEN 'Becerro'
            WHEN cria_sexo = 'Becerro' AND cria_edad BETWEEN 13 AND 18 THEN 'Torete'
            ELSE cria_sexo
        END;
";

// Preparar y ejecutar la consulta SQL
$stmt = $conexion->prepare($sql);
$stmt->execute();

// Verificar si hay Novillonas con más de 36 meses de edad
$sqlNovillona = "SELECT COUNT(*) AS total_novillonas FROM crias WHERE cria_sexo = 'Novillona' AND cria_edad > 36";
$stmtNovillona = $conexion->prepare($sqlNovillona);
$stmtNovillona->execute();
$resultadoNovillona = $stmtNovillona->fetch(PDO::FETCH_ASSOC);
$totalNovillonas = $resultadoNovillona['total_novillonas'];

// Verificar si hay Toretes con más de 18 meses de edad
$sqlTorete = "SELECT COUNT(*) AS total_toretes FROM crias WHERE cria_sexo = 'Torete' AND cria_edad > 18";
$stmtTorete = $conexion->prepare($sqlTorete);
$stmtTorete->execute();
$resultadoTorete = $stmtTorete->fetch(PDO::FETCH_ASSOC);
$totalToretes = $resultadoTorete['total_toretes'];

// Mostrar mensajes si hay Novillonas o Toretes con más de la edad especificada
if ($totalNovillonas > 0) {
    echo "<script>alert('Hay una o más Novillonas con más de 36 meses de edad.');</script>";
}

if ($totalToretes > 0) {
    echo "<script>alert('Hay uno o más Toretes con más de 18 meses de edad.');</script>";
}
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
    <link rel="stylesheet" href="../styles/styles-crias.css">

    <title>Tabla de inventario - Crías</title>
</head>
<body>

<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-5 section-buttons2">
    <div class="col-11 col-md-11">
          <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="" width="110" height="100"> -->
        <h1 class=" text-center mb-4">Tabla de registros de crias</h1>
        
        <div class="d-flex flex-row justify-content-center justify-content-md-end mb-1 mb-0">
            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">
                <a class="h-100 mx-lg-2 d-flex flex-row justify-content-evenly align-items-center btn-principal a-icon-span" href="crias-form.php">
                    <i class="fa-solid fa-circle-plus fa-2x"></i>
                    <span>Capturar una cría</span>
                </a>
                <a class=" h-100 d-flex flex-row justify-content-evenly align-items-center btn-principal" href="../menu-inventario.php">
                    <span>Regresar al menú</span>
                </a> 
            </div>
        </div>
    </div> 
</section>
    
<section class="mb-5 mt-4" style=" padding-right: 3%; padding-left: 3%;">
    <div class="table-container">
    <?php
        try {
            // Consulta SQL con prepared statement filtrando por rol=agente
            //$sql = "SELECT id_cria, padre_num, padre_raza, madre_num, madere_raza FROM hembra WHERE rol = 'agente'";
            $sql = "SELECT id_cria, madre_numero, cria_edad, cria_sexo, 
            cria_fecha_nacimiento, cria_numero, cria_arete, cria_tatuaje, cria_estado_arete, cria_raza,  
            cria_peso_nacimiento, cria_peso_destete, cria_peso_venta, cria_finada, 
            cria_fecha_destete, cria_fecha_aretado, cria_fecha_tatuaje, 
            cria_fecha_fierro, cria_fecha_venta, cria_observaciones, fecha_registro  FROM crias";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            // Mostrar los resultados en una tabla HTML
            echo '<table id="tabla_crias" class="tabla-registros table table-bordered table-striped border border-2 " >
                    <thead>
                    <tr>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar registro</th>

                        <th scope="col">Número de la madre</th>
                        <th scope="col">Edad de la cría</th>
                        <th scope="col">Estado productivo</th>
                        <th scope="col">Fecha de nacimiento</th>

                        <th scope="col">Número de la cria</th>
                        <th scope="col">Número de arete</th>
                        <th scope="col">Estado del arete</th>
                        <th scope="col">Tatuaje</th>
                        <th scope="col">Raza de la cria</th>

                        <th scope="col">Peso de nacimiento</th>
                        <th scope="col">Peso destete</th>
                        <th scope="col">Peso de venta</th>                       
                        <th scope="col">Finada</th>

                        <th scope="col">Fecha de destete</th>
                        <th scope="col">Fecha de aretado</th>
                        <th scope="col">Fecha de tatuaje</th>
                        <th scope="col">Fecha de fierro</th>
                        <th scope="col">Fecha de venta</th>

                        <th scope="col">Observaciones</th>
                        <th scope="col">Fecha de registro</th>

                    </tr>
                    </thead>
                    <tbody>';
        
            while ($arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                    echo '<td> 
                            <form action="eliminar-cria.php" method="POST">
                                <input type="hidden" name="id_cria"  value="'. $arreglo_sql['id_cria'].'" >
                                <button type="submit" class="btn-eliminar" >
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                         </td>';

                    echo '<td> 
                            <form action="editar-cria.php" method="POST">
                                <input type="hidden" name="id_cria" value="'. $arreglo_sql['id_cria'].'">
                                <button type="submit" class="btn-principal">
                                    <i  class="bi bi-pencil-square"></i>
                                    Editar
                                </button>  
                            </form>
                         </td>';

                         echo '<td>' . $arreglo_sql['madre_numero'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_edad'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_sexo'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_fecha_nacimiento'] . '</td>';
   
                         echo '<td>' . $arreglo_sql['cria_numero'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_arete'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_estado_arete'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_tatuaje'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_raza'] . '</td>';

                         echo '<td>' . $arreglo_sql['cria_peso_nacimiento'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_peso_destete'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_peso_venta'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_finada'] . '</td>';

                         echo '<td>' . $arreglo_sql['cria_fecha_destete'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_fecha_aretado'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_fecha_tatuaje'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_fecha_fierro'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_fecha_venta'] . '</td>';
                         //echo '<td> <img src="' . $arreglo_sql['cria_foto'] .'" width="50" height="40" alt="Vacio"></td>';
                         //echo '<td> <img src="' . $arreglo_sql['cria_foto_fierro'] .'" width="50" height="40" alt="Vacio"></td>';
                         echo '<td>' . $arreglo_sql['cria_observaciones'] . '</td>';
                         echo '<td>' . $arreglo_sql['fecha_registro'] . '</td>';
                    // echo '<td><a href="fpdf/reporte-agente.php?id=' . $arreglo_sql['id_usuario'] . '" target="_blank" class="btn btn-success">Generar reporte<svg style="padding-left:5px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                    //      <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                    //     </svg></a></td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        
        } catch (PDOException $e) {
            echo "<script>alert('Hubo un error al mostrar la tabla.');</script>";
            //echo "Error: " . $e->getMessage();
            echo '
            <div class="d-flex flex-row justify-content-center col-12">
                <div class="d-flex justify-content-center align-items-center flex-column mt-3 col-8" >
                    <h4 class="mb-1 text-center">Los datos no puedieron ser mostrados.</h4>
                    <i style="color:red;" class="col-8 col-xl-5 mb-1 text-center fa-regular fa-circle-xmark fa-3x"></i>
                    <p class="mb-3">Si el problema persiste, contactar a los desarrolladores.</p>
                </div> 
            </div> 
            ';
        }

    ?>
    </div>
</section>

<div class="d-flex col-12 justify-content-center" style="margin-bottom: 20px;">
    <h5 class="col-11">Resumen de inventario de crías</h5>
</div>

<?php 
    /// ESTADO PRODUCTIVO /////////////////////////////////////////////////////////////////////////
    // Realizar la consulta para terneras
    $sql_terneras = "SELECT COUNT(*) as total_terneras FROM crias WHERE cria_sexo = 'Ternera'";
    $stmt_terneras = $conexion->prepare($sql_terneras);
    $stmt_terneras->execute();
    $result_terneras = $stmt_terneras->fetch(PDO::FETCH_ASSOC);
    $terneras = $result_terneras['total_terneras'];

    // Realizar la consulta para Ternero
    $sql_ternero = "SELECT COUNT(*) as total_ternero FROM crias WHERE cria_sexo = 'Ternero'";
    $stmt_ternero = $conexion->prepare($sql_ternero);
    $stmt_ternero->execute();
    $result_ternero = $stmt_ternero->fetch(PDO::FETCH_ASSOC);
    $terneros = $result_ternero['total_ternero'];

    // Realizar la consulta para Becerra
    $sql_becerra = "SELECT COUNT(*) as total_becerra FROM crias WHERE cria_sexo = 'Becerra'";
    $stmt_becerra = $conexion->prepare($sql_becerra);
    $stmt_becerra->execute();
    $result_becerra = $stmt_becerra->fetch(PDO::FETCH_ASSOC);
    $becerras = $result_becerra['total_becerra'];

    // Realizar la consulta para Becerro
    $sql_becerro = "SELECT COUNT(*) as total_becerro FROM crias WHERE cria_sexo = 'Becerro'";
    $stmt_becerro = $conexion->prepare($sql_becerro);
    $stmt_becerro->execute();
    $result_becerro = $stmt_becerro->fetch(PDO::FETCH_ASSOC);
    $becerros = $result_becerro['total_becerro'];

    // Realizar la consulta para Novillona
    $sql_novillona = "SELECT COUNT(*) as total_novillona FROM crias WHERE cria_sexo = 'Novillona'";
    $stmt_novillona = $conexion->prepare($sql_novillona);
    $stmt_novillona->execute();
    $result_novillona = $stmt_novillona->fetch(PDO::FETCH_ASSOC);
    $novillonas = $result_novillona['total_novillona'];

    // Realizar la consulta para Torete
    $sql_torete = "SELECT COUNT(*) as total_torete FROM crias WHERE cria_sexo = 'Torete'";
    $stmt_torete = $conexion->prepare($sql_torete);
    $stmt_torete->execute();
    $result_torete = $stmt_torete->fetch(PDO::FETCH_ASSOC);
    $toretes = $result_torete['total_torete'];

    // ARETADOS //////////////////////////////////////////////////////////////////////////////////////////
    $sql_vigentes = "SELECT COUNT(*) as total_vigentes FROM crias WHERE cria_estado_arete = 'Vigente'";
    $stmt_vigentes = $conexion->prepare($sql_vigentes);
    $stmt_vigentes->execute();
    $arreglo_vigentes = $stmt_vigentes->fetch(PDO::FETCH_ASSOC);
    $aretes_vigentes = $arreglo_vigentes['total_vigentes'];

    $sql_pendientes = "SELECT COUNT(*) as total_pendientes FROM crias WHERE cria_estado_arete = 'Pendiente'";
    $stmt_pendientes = $conexion->prepare($sql_pendientes);
    $stmt_pendientes->execute();
    $arreglo_pendientes = $stmt_pendientes->fetch(PDO::FETCH_ASSOC);
    $aretes_pendientes = $arreglo_pendientes['total_pendientes'];
    
    $sql_bajas = "SELECT COUNT(*) as total_bajas FROM crias WHERE cria_estado_arete = 'Baja'";
    $stmt_bajas = $conexion->prepare($sql_bajas);
    $stmt_bajas->execute();
    $arreglo_bajas = $stmt_bajas->fetch(PDO::FETCH_ASSOC);
    $aretes_bajas = $arreglo_bajas['total_bajas'];

    // FINADAS ////////////////////////////////////////////////////////////////////////////
    $sql_finadas = "SELECT COUNT(*) as total_finadas FROM crias WHERE cria_finada = 'Si'";
    $stmt_finadas = $conexion->prepare($sql_finadas);
    $stmt_finadas->execute();
    $arreglo_finadas = $stmt_finadas->fetch(PDO::FETCH_ASSOC);
    $finadas = $arreglo_finadas['total_finadas'];
?>

<section class="d-flex col-12 justify-content-center" style="margin-bottom: 200px;">
    <div class="d-flex col-11 justify-content-md-around justify-content-center flex-md-row flex-column resumen-container">
        <div class="col-md-3">
            <table class="table table-bordered">
                <tr>
                    <th>Estado productivo</th>
                    <th>Cantidad</th>
                </tr>
                <tr>
                    <td>Terneras</td>
                    <td><?php echo $terneras; ?></td>
                </tr>
                <tr>
                    <td>Terneros</td>
                    <td><?php echo $terneros; ?></td>
                </tr>
                <tr>
                    <td>Becerras</td>
                    <td><?php echo $becerras; ?></td>
                </tr>
                <tr>
                    <td>Becerros</td>
                    <td><?php echo $becerros; ?></td>
                </tr>
                <tr>
                    <td>Novillonas</td>
                    <td><?php echo $novillonas; ?></td>
                </tr>
                <tr>
                    <td>Toretes</td>
                    <td><?php echo $toretes; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td class="fw-bold"><?php echo ($terneras + $terneros + $becerras + $becerros + $novillonas + $toretes); ?></td>
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
                    <th>Fallecidas</th>
                </tr>

                <tr>
                    <td><?php echo $finadas; ?></td>
                </tr>
            </table>
        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        $('#tabla_crias').DataTable({
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