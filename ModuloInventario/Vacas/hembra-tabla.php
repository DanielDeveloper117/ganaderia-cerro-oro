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
    //echo "Ya se han actualizado las edades hoy.\n";
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
    //echo "Edades actualizadas con éxito.\n";
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

    <style>
        table.dataTable {
            table-layout: fixed;
            width: 100%;
        }
        table.dataTable td, table.dataTable th {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        #spanNumberNoti{
            color: #fff;
            background-color: #000;
            border-radius: 100px; 
        }
        .renglon-parto{
            background-color: #ffe500a1 !important;
        }
        .renglon-parto1-td{
            color: #ff1100 !important;
            font-weight: 700;
        }
        .renglon-parto2-td{
            color: #ff1100 !important;
            font-weight: 700;
        }
        .renglon-fallecida{
            background-color: #ff000073 !important;
        }
    </style>
</head>
<body>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-3 section-vacas-buttons2">
    <div class="col-11">
        <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h1 class=" text-center mb-4">Inventario de Hembras</h1>

        <!-- <div class="d-flex flex-row justify-content-center justify-content-md-start mb-1 mb-0">
            <div class="d-flex flex-row justify-content-start align-items-center col-12 col-xl-2">
                <button type="button" class="h-100 d-flex flex-row justify-content-start align-items-center btn-principal a-icon-span">     
                    <span>Notificaciones</span>
                    <i class="fa-regular fa-bell fa-1x mx-2"></i>
                    <span id="spanNumberNoti" class="px-2">3</span>
                </button>
            </div>
        </div> -->

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
            $sql = "SELECT * FROM vacas";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            // Mostrar los resultados en una tabla HTML
            echo '<table id="tabla_vacas" class="tabla-registros table table-bordered table-striped border border-2 " >
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
                        <th scope="col">Edad actual</th>
                        <th scope="col">Edad 1er parto</th>
                        <th scope="col">Edad 2do parto</th>
                        <th scope="col" >Peso actual</th>
                        <th scope="col" style="border-left:solid #0006;">Número de la madre</th>
                        <th scope="col">Número de arete de la madre</th>
                        <th scope="col">Tatuaje de la madre</th>
                        <th scope="col">Raza de la madre</th>
                        <th scope="col" style="border-left:solid #0006;">Número del padre</th>
                        <th scope="col">Número de arete del padre</th>
                        <th scope="col">Tatuaje del padre</th>
                        <th scope="col">Raza del padre</th>
                        <th scope="col" style="border-left:solid #0006;">Color</th>
                        <th scope="col">Talla</th>
                        <th scope="col">Pelo</th>
                        <th scope="col">Condición</th>
                        <th scope="col">Potrero</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Partos totales</th>
                        <th scope="col">Estado de palpación</th>
                        <th scope="col">Fallecida</th>
                        <th scope="col" style="border-left:solid #0006;">Edad destete</th>
                        <th scope="col">Edad de venta</th>
                        <th scope="col" style="border-left:solid #0006;">Peso de nacimiento</th>
                        <th scope="col">Peso destete</th>
                        <th scope="col">Peso de venta</th>
                        <th scope="col">Ganancia de peso por día</th>
                        <th scope="col">Ganancia por mes</th>
                        <th scope="col">Ganancia en 3 meses</th>
                        <th scope="col" style="border-left:solid #0006;">Fecha de nacimiento</th>
                        <th scope="col">Fecha de destete</th>
                        <th scope="col">Fecha de aretado</th>
                        <th scope="col">Fecha de tatuaje</th>
                        <th scope="col">Fecha de fierro</th>
                        <th scope="col">Fecha probable</th>
                        <th scope="col">Fecha de venta</th>
                        <th scope="col" style="border-left:solid #0006;">Leche al día</th>
                        <th scope="col">Leche al mes</th>
                        <th scope="col">Comentario de leche</th>
                        <th scope="col" style="border-left:solid #0006;">Fotografía</th>
                        <th scope="col">Fotografía del fierro</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Fecha de registro</th>
                    </tr>
                    </thead>
                    <tbody>';
            // $esFinadaHorra =0;
            // $esFinadaTotal =0;

            while ($arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // ------------ DETERMINAR MAS DE 36 SIN PRIMER PARTO
                 if($arreglo_sql["vaca_edad_actual"]>=36 && $arreglo_sql["vaca_edad_parto1"]==null && $arreglo_sql["vaca_edad_actual"]!="Fallecida"){
                     $class='renglon-parto';
                     $classtd1='renglon-parto1-td';
                 }else{
                     $class='';
                     $classtd1='';
                 }
                 if($arreglo_sql["vaca_edad_actual"]>=48 && $arreglo_sql["vaca_edad_parto2"]==null && $arreglo_sql["vaca_edad_actual"]!="Fallecida"){
                     $class='renglon-parto';
                     $classtd2='renglon-parto2-td';
                 }else{
                     $classtd2='';
                 }
                 if($arreglo_sql["vaca_finada"]=="Si"){
                    $classRowFallecida ='renglon-fallecida';
                 }else{
                    $classRowFallecida='';
                 }
                // SUMAR LAS FALLECIDAS
                // if($arreglo_sql['vaca_estado_re']=="Vaca horra" && $arreglo_sql['vaca_finada']=="Si"){
                //     $esFinadaHorra += 1;
                //     $esFinadaTotal += $esFinadaHorra;
                // }else{}

                //--------------------
                echo '<tr class="'.$class. ' '. $classRowFallecida.'" data-id="'. $arreglo_sql['id_vaca'].'" >';

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

                        if($arreglo_sql['vaca_edad_actual']==null){ 
                            echo '<td>-</td>';
                        }else if($arreglo_sql['vaca_edad_actual']=="Fallecida" || $arreglo_sql['vaca_edad_actual']==0){ 
                            echo '<td>Fallecida</td>';
                        }else{
                            $total_months = intval($arreglo_sql['vaca_edad_actual']);
                            $years = floor($total_months / 12);
                            $months = $total_months % 12;
                            if($years==1){
                                $yarYears = "año";
                            }else{
                                $yearYears="años";
                            }
                            if($months==1){
                                $mesMeses = "mes";
                            }else{
                                $mesMeses="meses";
                            }
                            echo '<td class="'.$classtd1.' '.$classtd2.' ">' . $arreglo_sql['vaca_edad_actual'] .' meses</br>
                            ('.$years.' '.$yearYears.', '.$months.' '.$mesMeses .')
                            </td>';
                        }

                        if($arreglo_sql['vaca_edad_parto1']==null){ 
                            $mx='Aun no';
                        }else{
                            $mx=' meses';
                        }

                        echo '<td class="'.$classtd1.'">' . $arreglo_sql['vaca_edad_parto1'] . $mx.'</td>';

                        if($arreglo_sql['vaca_edad_parto2']==null){ 
                            $mx='Aun no';
                        }else{
                            $mx=' meses';
                        }

                        echo '<td class="'.$classtd2.'">' . $arreglo_sql['vaca_edad_parto2'] . $mx.'</td>';
                        if($arreglo_sql['vaca_peso_actual']==null){ $kg='-';}else{$kg=' Kg';}
                        echo '<td>' . $arreglo_sql['vaca_peso_actual'] . $kg.'</td>';

                        echo '<td style="border-left:solid #0006;">' . $arreglo_sql['madre_numero'] . '</td>';
                        echo '<td>' . $arreglo_sql['madre_arete'] . '</td>';
                        echo '<td>' . $arreglo_sql['madre_tatuaje'] . '</td>';
                        echo '<td>' . $arreglo_sql['madre_raza'] . '</td>';
                        echo '<td style="border-left:solid #0006;">' . $arreglo_sql['padre_numero'] . '</td>';
                        echo '<td>' . $arreglo_sql['padre_arete'] . '</td>';
                        echo '<td>' . $arreglo_sql['padre_tatuaje'] . '</td>';
                        echo '<td>' . $arreglo_sql['padre_raza'] . '</td>';
                        echo '<td style="border-left:solid #0006;">' . $arreglo_sql['vaca_color'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_talla'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_pelo'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_condicion'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_potrero'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_lote'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_partos'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_estado_pal'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_finada'] . '</td>';

                        if($arreglo_sql['vaca_edad_destete']==null){ $mx='-';}else{$mx=' meses';}
                        echo '<td style="border-left:solid #0006;">' . $arreglo_sql['vaca_edad_destete'] . $mx.'</td>';
                        if($arreglo_sql['vaca_edad_venta']==null){ $mx='-';}else{$mx=' meses';}
                        echo '<td>' . $arreglo_sql['vaca_edad_venta'] .  $mx.'</td>';

                        if($arreglo_sql['vaca_peso_nacimiento']==null){ $kg='-';}else{$kg=' Kg';}
                        echo '<td style="border-left:solid #0006;">' . $arreglo_sql['vaca_peso_nacimiento'] . $kg.'</td>';
                        if($arreglo_sql['vaca_peso_destete']==null){ $kg='-';}else{$kg=' Kg';}
                        echo '<td>' . $arreglo_sql['vaca_peso_destete'] .  $kg.'</td>';
                        if($arreglo_sql['vaca_peso_venta']==null){ $kg='-';}else{$kg=' Kg';}
                        echo '<td>' . $arreglo_sql['vaca_peso_venta'] .  $kg.'</td>';
                        if($arreglo_sql['vaca_gan_peso_dia']==null){ $kg='-';}else{$kg=' Kg';}
                        echo '<td>' . $arreglo_sql['vaca_gan_peso_dia'] .  $kg.'</td>';
                        if($arreglo_sql['vaca_gan_peso_mes']==null){ $kg='-';}else{$kg=' Kg';}
                        echo '<td>' . $arreglo_sql['vaca_gan_peso_mes'] .  $kg.'</td>';
                        if($arreglo_sql['vaca_peso_3meses']==null){ $kg='-';}else{$kg=' Kg';}
                        echo '<td>' . $arreglo_sql['vaca_peso_3meses'] .  $kg.'</td>';

                        echo '<td style="border-left:solid #0006;">' . $arreglo_sql['vaca_fecha_nacimiento'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_fecha_destete'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_fecha_aretado'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_fecha_tatuaje'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_fecha_fierro'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_fecha_probable'] . '</td>';
                        echo '<td>' . $arreglo_sql['vaca_fecha_venta'] . '</td>';
                        if($arreglo_sql['vaca_leche_dia']==null){ $lts='-';}else{$lts=' Lts';}
                        echo '<td style="border-left:solid #0006;">' . $arreglo_sql['vaca_leche_dia'] . $lts.'</td>';
                        if($arreglo_sql['vaca_leche_mes']==null){ $lts='-';}else{$lts=' Lts';}
                        echo '<td>' . $arreglo_sql['vaca_leche_mes'] . $lts. '</td>';
                        echo '<td >' . $arreglo_sql['vaca_leche_comentario'] . '</td>';
                        echo '<td style="border-left:solid #0006;"> <a data-fancybox="gallery" href="' . $arreglo_sql['vaca_foto'] .'"><img src="' . $arreglo_sql['vaca_foto'] .'" width="50" height="40" alt="Vacio"></a></td>';
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
    // consultar estado reproductivo y si esta finada

    // Realizar la consulta para Vacas horras
    $sql_horras = "SELECT vaca_finada, vaca_peso_actual, COUNT(*) as total_horras, SUM(vaca_peso_actual) as peso_total 
    FROM vacas 
    WHERE vaca_estado_re = 'Vaca horra' 
    AND vaca_finada = 'No'";
    $stmt_horras = $conexion->prepare($sql_horras);
    $stmt_horras->execute();
    $result_horras = $stmt_horras->fetch(PDO::FETCH_ASSOC);
    $vacas_horras = $result_horras['total_horras'];
    $horras_peso = $result_horras['peso_total'];

    // Realizar la consulta para Vacas preñadas
    $sql_prenadas = "SELECT COUNT(*) as total_prenadas, SUM(vaca_peso_actual) as peso_total_prenadas 
    FROM vacas 
    WHERE vaca_estado_re = 'Vaca preñada' 
    AND vaca_finada = 'No'";
    $stmt_prenadas = $conexion->prepare($sql_prenadas);
    $stmt_prenadas->execute();
    $result_prenadas = $stmt_prenadas->fetch(PDO::FETCH_ASSOC);
    $vacas_prenadas = $result_prenadas['total_prenadas'];
    $peso_total_prenadas = $result_prenadas['peso_total_prenadas'];

    // Realizar la consulta para Vacas paridas
    $sql_paridas = "SELECT COUNT(*) as total_paridas, SUM(vaca_peso_actual) as peso_total_paridas 
    FROM vacas 
    WHERE vaca_estado_re = 'Vaca parida' 
    AND vaca_finada = 'No'";
    $stmt_paridas = $conexion->prepare($sql_paridas);
    $stmt_paridas->execute();
    $result_paridas = $stmt_paridas->fetch(PDO::FETCH_ASSOC);
    $vacas_paridas = $result_paridas['total_paridas'];
    $peso_total_paridas = $result_paridas['peso_total_paridas'];

    // Realizar la consulta para Vacas lactantes
    $sql_lactantes = "SELECT COUNT(*) as total_lactantes, SUM(vaca_peso_actual) as peso_total_lactantes 
    FROM vacas 
    WHERE vaca_estado_re = 'Vaca lactante' 
    AND vaca_finada = 'No'";
    $stmt_lactantes = $conexion->prepare($sql_lactantes);
    $stmt_lactantes->execute();
    $result_lactantes = $stmt_lactantes->fetch(PDO::FETCH_ASSOC);
    $vacas_lactantes = $result_lactantes['total_lactantes'];
    $peso_total_lactantes = $result_lactantes['peso_total_lactantes'];

    // Realizar la consulta para Vacas seca
    $sql_secas = "SELECT COUNT(*) as total_secas, SUM(vaca_peso_actual) as peso_total_secas 
    FROM vacas 
    WHERE vaca_estado_re = 'Vaca seca' 
    AND vaca_finada = 'No'";
    $stmt_secas = $conexion->prepare($sql_secas);
    $stmt_secas->execute();
    $result_secas = $stmt_secas->fetch(PDO::FETCH_ASSOC);
    $vacas_secas = $result_secas['total_secas'];
    $peso_total_secas = $result_secas['peso_total_secas'];

    // Realizar la consulta para Vacas Novillona
    $sql_novillonas = "SELECT COUNT(*) as total_novillonas, SUM(vaca_peso_actual) as peso_total_novillonas 
    FROM vacas 
    WHERE vaca_estado_re = 'Novillona' 
    AND vaca_finada = 'No'";
    $stmt_novillonas = $conexion->prepare($sql_novillonas);
    $stmt_novillonas->execute();
    $result_novillonas = $stmt_novillonas->fetch(PDO::FETCH_ASSOC);
    $vacas_novillonas = $result_novillonas['total_novillonas'];
    $peso_total_novillonas = $result_novillonas['peso_total_novillonas'];

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

    $peso_total_todas = $horras_peso + $peso_total_prenadas + $peso_total_paridas + $peso_total_lactantes + $peso_total_secas + $peso_total_novillonas;

?>

<section class="d-flex col-12 justify-content-center" style="margin-bottom: 200px;">
    <div class="d-flex col-11 justify-content-md-around justify-content-center flex-md-row flex-column resumen-container">
        <div class="col-md-3">
            <table class="table table-bordered">
                <tr>
                    <th>Estado reproductivo</th>
                    <th>Cantidad y peso sumado</th>
                </tr>
                <tr>
                    <td>Vacas horras</td>
                    <td><?php echo $vacas_horras . ' | ' .  $horras_peso . 'kg'; ?> 
                    </td>
                </tr>
                <tr>
                    <td>Vacas preñadas</td>
                    <td><?php echo $vacas_prenadas . ' | ' .  $peso_total_prenadas . 'kg'; ?></td>
                </tr>
                <tr>
                    <td>Vacas paridas</td>
                    <td><?php echo $vacas_paridas . ' | ' .  $peso_total_paridas . 'kg'; ?></td>
                </tr>
                <tr>
                    <td>Vacas lactantes</td>
                    <td><?php echo $vacas_lactantes . ' | ' .  $peso_total_lactantes . 'kg'; ?></td>
                </tr>
                <tr>
                    <td>Vacas secas</td>
                    <td><?php echo $vacas_secas . ' | ' .  $peso_total_secas . 'kg'; ?></td>
                </tr>
                <tr>
                    <td>Vacas novillonas</td>
                    <td><?php echo $vacas_novillonas . ' | ' .  $peso_total_novillonas . 'kg'; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td class="fw-bold"><?php echo (($vacas_horras + $vacas_prenadas + $vacas_paridas + $vacas_lactantes + $vacas_secas + $vacas_novillonas)  . ' | ' .  $peso_total_todas . 'kg' ); ?></td>
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
            "autoWidth": true,
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
            "pageLength": 30,
            "lengthMenu": [ [10, 20, 30, 40, 50, 100, 1000], [10, 20, 30, 40, 50, 100, 1000] ],
            "scrollY": "500px", // Altura del área de desplazamiento vertical
            "scrollX": true,
            "scrollCollapse": true // Colapso del scroll cuando no es necesario
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>