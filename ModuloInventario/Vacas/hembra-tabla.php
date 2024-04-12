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

$sqlVerificarEjecucion = "SELECT COUNT(*) as conteo FROM vacas WHERE ultima_ejecucion >= :fechaInicioDia AND ultima_ejecucion <= :fechaFinDia";
$stmtVerificarEjecucion = $conexion->prepare($sqlVerificarEjecucion);
$fechaInicioDiaFormatted = $fechaInicioDia->format('Y-m-d H:i:s');
$fechaFinDiaFormatted = $fechaFinDia->format('Y-m-d H:i:s');

$stmtVerificarEjecucion->bindParam(':fechaInicioDia', $fechaInicioDiaFormatted);
$stmtVerificarEjecucion->bindParam(':fechaFinDia', $fechaFinDiaFormatted);
$stmtVerificarEjecucion->execute();
$resultadoVerificarEjecucion = $stmtVerificarEjecucion->fetch(PDO::FETCH_ASSOC);

if ($resultadoVerificarEjecucion['conteo'] > 0) {
    echo "Ya se ha ejecutado el script hoy.\n";
} else {
    // Actualizar la ultima_ejecucion
    $sqlActualizarUltimaEjecucion = "UPDATE vacas SET ultima_ejecucion = :fechaActual";
    $stmtActualizarUltimaEjecucion = $conexion->prepare($sqlActualizarUltimaEjecucion);
    $fechaActualFormatted = $fechaActual->format('Y-m-d H:i:s');
    $stmtActualizarUltimaEjecucion->bindParam(':fechaActual', $fechaActualFormatted);
    $stmtActualizarUltimaEjecucion->execute();
    // Consultar las Vacas
    $sqlConsultaVacas = "SELECT id_vaca, vaca_edad_actual, vaca_fecha_nacimiento FROM vacas";
    $stmtConsultaVacas = $conexion->prepare($sqlConsultaVacas);
    $stmtConsultaVacas->execute();
    $Vacas = $stmtConsultaVacas->fetchAll(PDO::FETCH_ASSOC);
    // Iterar sobre las Vacas
    foreach ($Vacas as $Vaca) {
        $idVaca = $Vaca['id_vaca'];
        $edadVaca = $Vaca['vaca_edad_actual'];
        $fechaNacimiento = new DateTime($Vaca['vaca_fecha_nacimiento']);
        // Verificar condiciones para sumar 1 a la edad de la Vaca
        if ($fechaActual->format('m') !== $fechaNacimiento->format('m') && $fechaActual->format('d') === $fechaNacimiento->format('d')) {
            $nuevaEdad = $edadVaca + 1;
        } elseif ($fechaActual->format('m') === $fechaNacimiento->format('m') && $fechaActual->format('d') === $fechaNacimiento->format('d') && $fechaActual->format('Y') !== $fechaNacimiento->format('Y')) {
            $nuevaEdad = $edadVaca + 1;
        } else {
            $nuevaEdad = $edadVaca;
        }
        // Actualizar la edad de la Vaca en la base de datos
        $sqlActualizarEdad = "UPDATE vacas SET vaca_edad_actual = :nuevaEdad WHERE id_vaca = :idVaca";
        $stmtActualizarEdad = $conexion->prepare($sqlActualizarEdad);
        $stmtActualizarEdad->bindParam(':nuevaEdad', $nuevaEdad, PDO::PARAM_INT);
        $stmtActualizarEdad->bindParam(':idVaca', $idVaca, PDO::PARAM_INT);
        $stmtActualizarEdad->execute();
    }
    echo "Script ejecutado con éxito.\n";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="../styles/styles-vacas.css">

    <title>Tabla de inventario - Hembras</title>
</head>
<body>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-5 section-vacas-buttons2">
    <div class="col-11">
        <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h1 class=" text-center mb-4">Inventario de Hembras</h1>

        <div class="d-flex flex-row justify-content-center justify-content-md-end mb-1 mb-0">
            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">
                <a class="h-100 mx-lg-2 d-flex flex-row justify-content-evenly align-items-center btn-principal a-icon-span" href="hembra.php">     
                    <i class="fa-solid fa-circle-plus fa-2x"></i>
                    <span>Capturar una hembra</span>
                </a>

                <a class=" h-100  d-flex flex-row justify-content-evenly align-items-center btn-principal" href="../menu-inventario.php">
                    Regresar al menú
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
                                <button type="submit" class="btn-eliminar" >
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                         </td>';

                    echo '<td> 
                            <form action="editar-hembra.php" method="POST">
                                <input type="hidden" name="id_vaca" value="'. $arreglo_sql['id_vaca'].'">
                                <button type="submit" class="btn-principal">
                                    <i  class="bi bi-pencil-square"></i>
                                    Editar
                                </button>
                            </form>
                         </td>';
                        
                    echo '<td> 
                            <form action="../Crias/crias-form.php" method="POST">
                                <input type="hidden" name="id_vaca" value="'. $arreglo_sql['id_vaca'].'">
                                <button type="submit" class="btn-principal">
                                    <i class="fa-solid fa-plus"></i>
                                    Agregar
                                </button>
                            </form>
                        </td>';
                   
                        echo '<td>' . $arreglo_sql['vaca_numero'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_arete'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_tatuaje'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_raza'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_estado_re'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_estatus'] . '</td>';
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
                        echo '<td>' . $arreglo_sql['vaca_potrero'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_lote'] . '</td>';
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
                        echo '<td> <a data-fancybox="gallery" href="' . $arreglo_sql['vaca_foto'] .'"><img src="' . $arreglo_sql['vaca_foto'] .'" width="50" height="40" alt="Vacio"></a></td>';
                        echo '<td> <a data-fancybox="gallery" href="' . $arreglo_sql['vaca_foto_fierro'] .'"><img src="' . $arreglo_sql['vaca_foto_fierro'] .'" width="50" height="40" alt="Vacio"></a></td>';
                        echo '<td>' . $arreglo_sql['vaca_observaciones'] . '</td>';
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
                <div class="d-flex justify-content-center align-items-center flex-column mt-5 col-8" >
                    <h4 class="mb-1 text-center">Los datos no puedieron ser mostrados.</h4>
                    <i style="color:red;" class="col-8 col-xl-5 mb-1 text-center fa-regular fa-circle-xmark fa-3x"></i>
                    <p class="mb-3">Si el problema persiste, contactar a los desarrolladores.</p>
                </div> 
            </div> 
            ';
            // Manejar errores de conexión o consulta
            //echo "Error: " . $e->getMessage();
        }
    ?>
    </div>
</section>
<div class="d-flex col-12 justify-content-center" style="margin-bottom: 20px;">
    <h5 class="col-11">Resumen de inventario de hembras</h5>
</div>


<?php
    /// ESTADO REPRODUCTIVO /////////////////////////////////////////////////////////////////////////
    // Realizar la consulta para Vacas horras
    $sql_horras = "SELECT COUNT(*) as total_horras FROM vacas WHERE vaca_estado_re = 'Vaca horra'";
    $stmt_horras = $conexion->prepare($sql_horras);
    $stmt_horras->execute();
    $result_horras = $stmt_horras->fetch(PDO::FETCH_ASSOC);
    $vacas_horras = $result_horras['total_horras'];

    // Realizar la consulta para Vacas preñadas
    $sql_prenadas = "SELECT COUNT(*) as total_prenadas FROM vacas WHERE vaca_estado_re = 'Vaca preñada'";
    $stmt_prenadas = $conexion->prepare($sql_prenadas);
    $stmt_prenadas->execute();
    $result_prenadas = $stmt_prenadas->fetch(PDO::FETCH_ASSOC);
    $vacas_prenadas = $result_prenadas['total_prenadas'];

    // Realizar la consulta para Vacas paridas
    $sql_paridas = "SELECT COUNT(*) as total_paridas FROM vacas WHERE vaca_estado_re = 'Vaca parida'";
    $stmt_paridas = $conexion->prepare($sql_paridas);
    $stmt_paridas->execute();
    $result_paridas = $stmt_paridas->fetch(PDO::FETCH_ASSOC);
    $vacas_paridas = $result_paridas['total_paridas'];

    // Realizar la consulta para Vacas lactantes
    $sql_lactantes = "SELECT COUNT(*) as total_lactantes FROM vacas WHERE vaca_estado_re = 'Vaca lactante'";
    $stmt_lactantes = $conexion->prepare($sql_lactantes);
    $stmt_lactantes->execute();
    $result_lactantes = $stmt_lactantes->fetch(PDO::FETCH_ASSOC);
    $vacas_lactantes = $result_lactantes['total_lactantes'];

    // Realizar la consulta para Vacas lactantes
    $sql_secas = "SELECT COUNT(*) as total_secas FROM vacas WHERE vaca_estado_re = 'Vaca seca'";
    $stmt_secas = $conexion->prepare($sql_secas);
    $stmt_secas->execute();
    $result_secas = $stmt_secas->fetch(PDO::FETCH_ASSOC);
    $vacas_secas = $result_secas['total_secas'];

    // ARETADOS //////////////////////////////////////////////////////////////////////////////////////////
    $sql_vigentes = "SELECT COUNT(*) as total_vigentes FROM vacas WHERE vaca_estatus = 'Vigente'";
    $stmt_vigentes = $conexion->prepare($sql_vigentes);
    $stmt_vigentes->execute();
    $arreglo_vigentes = $stmt_vigentes->fetch(PDO::FETCH_ASSOC);
    $aretes_vigentes = $arreglo_vigentes['total_vigentes'];

    $sql_pendientes = "SELECT COUNT(*) as total_pendientes FROM vacas WHERE vaca_estatus = 'Pendiente'";
    $stmt_pendientes = $conexion->prepare($sql_pendientes);
    $stmt_pendientes->execute();
    $arreglo_pendientes = $stmt_pendientes->fetch(PDO::FETCH_ASSOC);
    $aretes_pendientes = $arreglo_pendientes['total_pendientes'];
    
    $sql_bajas = "SELECT COUNT(*) as total_bajas FROM vacas WHERE vaca_estatus = 'Baja'";
    $stmt_bajas = $conexion->prepare($sql_bajas);
    $stmt_bajas->execute();
    $arreglo_bajas = $stmt_bajas->fetch(PDO::FETCH_ASSOC);
    $aretes_bajas = $arreglo_bajas['total_bajas'];

    // FINADAS ////////////////////////////////////////////////////////////////////////////
    $sql_finadas = "SELECT COUNT(*) as total_finadas FROM vacas WHERE vaca_finada = 'Si'";
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
                    <th>Estado reproductivo</th>
                    <th>Cantidad</th>
                </tr>
                <tr>
                    <td>Vacas horras</td>
                    <td><?php echo $vacas_horras; ?></td>
                </tr>
                <tr>
                    <td>Vacas preñadas</td>
                    <td><?php echo $vacas_prenadas; ?></td>
                </tr>
                <tr>
                    <td>Vacas paridas</td>
                    <td><?php echo $vacas_paridas; ?></td>
                </tr>
                <tr>
                    <td>Vacas lactantes</td>
                    <td><?php echo $vacas_lactantes; ?></td>
                </tr>
                <tr>
                    <td>Vacas secas</td>
                    <td><?php echo $vacas_secas; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td class="fw-bold"><?php echo ($vacas_horras + $vacas_prenadas + $vacas_paridas + $vacas_lactantes + $vacas_secas); ?></td>
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