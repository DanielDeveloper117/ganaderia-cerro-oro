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

    <title>Tabla de inventario - Hembras</title>
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
   
</style>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-1 mt-2">
    <div class="col-10">
          <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="" width="110" height="100"> -->
        <h1 class=" text-center mb-4">Registros de hembras de inventario</h1>
        <div class="d-flex flex-row mb-1 mb-0">
            <div class="col-1 col-xl-9"></div>
            <div class="d-flex flex-row justify-content-around align-items-center col-11 col-xl-3">
                <a href="hembra.php"><button class="form-control btn btn-warning" style="" ><i class="bi bi-arrow-left"></i>Regresar </button></a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a href="menu-inventario.php"><button class="form-control btn btn-secondary" style="" >Regresar al menú</button></a> 
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
            $sql = "SELECT id_vaca, padre_num, padre_raza, madre_num, madre_raza,
            fecha_nacimiento, fecha_destete, fecha_venta,
            edad_actual, edad_destete, edad_venta,
            peso_nacimiento, peso_3meses, peso_destete, peso_venta,
            ganancia_peso_dia, ganancia_peso_mes, finado,
            cria_num, cria_arete, destino_cria,
            vaca_num, vaca_arete, vaca_raza, fecha_aretado, estatus, 
            potrero, lote, estado_reproductivo,
            celo, parto_num, estado_palpacion, fecha_probable,
             foto, observaciones, fecha_registro FROM hembra ";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            // Mostrar los resultados en una tabla HTML
            echo '<table class="table table-bordered table-striped border border-2 " >
                    <thead>
                      <tr>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Id</th>
                        <th scope="col">Número del padre</th>
                        <th scope="col">Raza del padre</th>
                        <th scope="col">Número de la madre</th>
                        <th scope="col">Raza de la madre</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Fecha destete</th>
                        <th scope="col">Fecha de venta</th>
                        <th scope="col">Edad actual</th>
                        <th scope="col">Edad destete</th>
                        <th scope="col">Edad de venta</th>
                        <th scope="col">Peso de nacimiento</th>
                        <th scope="col">Peso en 3 meses</th>
                        <th scope="col">Peso destete</th>
                        <th scope="col">Peso de venta</th>
                        <th scope="col">Ganancia de peso por día</th>
                        <th scope="col">Ganancia de peso por mes</th>
                        <th scope="col">Finado</th>
                        <th scope="col">Número de cría</th>
                        <th scope="col">Número de arete de cría</th>
                        <th scope="col">Destino de la cría</th>
                        <th scope="col">Número de vaca</th>
                        <th scope="col">Número de arete</th>
                        <th scope="col">Raza de la vaca</th>
                        <th scope="col">Fecha de aretado</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Potrero</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Estado reproductivo</th>
                        <th scope="col">Celo</th>
                        <th scope="col">Número de parto</th>
                        <th scope="col">Estado de palpación</th>
                        <th scope="col">Fecha probable</th>
                        <th scope="col">Fotografía</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Fecha de registro</th>
                      </tr>
                    </thead>
                    <tbody>';
        
            while ($arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                   // echo '<td> <a href="hembra-tabla.php"><button class="form-control btn-danger"><i style="margin-right:5px;" class="bi bi-trash"></i>Eliminar</button></a></td>';
                    echo '<td> 
                            <form action="eliminar-hembra.php" method="POST">
                                <input type="hidden" name="id_vaca"  value="'. $arreglo_sql['id_vaca'].'" >
                                <button type="submit" id="botonEliminar" class="form-control btn-danger" style="font-size:12px; " ><i style="margin-right:5px;" class="bi bi-trash"></i>
                                     Eliminar
                                </button>
                            </form>
                         </td>';

                   // echo '<td> <a href="editar-hembra.php"><button class="form-control btn-info"><i style="margin-right:5px;" class="bi bi-pencil-square"></i>Editar</button></a></td>';
                    echo '<td> 
                            <form action="editar-hembra.php" method="POST">
                                <input type="hidden" name="id_vaca" value="'. $arreglo_sql['id_vaca'].'">
                                <button type="submit" class="form-control btn-info"><i style="margin-right:5px;" class="bi bi-pencil-square"></i>Editar</button>
                            </form>
                         </td>';
                   
                    echo '<td>' . $arreglo_sql['id_vaca'] . '</td>';
                    echo '<td>' . $arreglo_sql['padre_num'] . '</td>';
                    echo '<td>' . $arreglo_sql['padre_raza'] . '</td>';
                    echo '<td>' . $arreglo_sql['madre_num'] . '</td>';
                    echo '<td>' . $arreglo_sql['madre_raza'] . '</td>';
                    echo '<td>' . $arreglo_sql['fecha_nacimiento'] . '</td>';
                    echo '<td>' . $arreglo_sql['fecha_destete'] . '</td>';
                    echo '<td>' . $arreglo_sql['fecha_venta'] . '</td>';
                    echo '<td>' . $arreglo_sql['edad_actual'] . '</td>';
                    echo '<td>' . $arreglo_sql['edad_destete'] . '</td>';
                    echo '<td>' . $arreglo_sql['edad_venta'] . '</td>';
                    echo '<td>' . $arreglo_sql['peso_nacimiento'] . '</td>';
                    echo '<td>' . $arreglo_sql['peso_3meses'] . '</td>';
                    echo '<td>' . $arreglo_sql['peso_destete'] . '</td>';
                    echo '<td>' . $arreglo_sql['peso_venta'] . '</td>';
                    echo '<td>' . $arreglo_sql['ganancia_peso_dia'] . '</td>';
                    echo '<td>' . $arreglo_sql['ganancia_peso_mes'] . '</td>';
                    echo '<td>' . $arreglo_sql['finado'] . '</td>';
                    echo '<td>' . $arreglo_sql['cria_num'] . '</td>';
                    echo '<td>' . $arreglo_sql['cria_arete'] . '</td>';
                    echo '<td>' . $arreglo_sql['destino_cria'] . '</td>';
                    echo '<td>' . $arreglo_sql['vaca_num'] . '</td>';
                    echo '<td>' . $arreglo_sql['vaca_arete'] . '</td>';
                    echo '<td>' . $arreglo_sql['vaca_raza'] . '</td>';
                    echo '<td>' . $arreglo_sql['fecha_aretado'] . '</td>';
                    echo '<td>' . $arreglo_sql['estatus'] . '</td>';
                    echo '<td>' . $arreglo_sql['potrero'] . '</td>';
                    echo '<td>' . $arreglo_sql['lote'] . '</td>';
                    echo '<td>' . $arreglo_sql['estado_reproductivo'] . '</td>';
                    echo '<td>' . $arreglo_sql['celo'] . '</td>';
                    echo '<td>' . $arreglo_sql['parto_num'] . '</td>';
                    echo '<td>' . $arreglo_sql['estado_palpacion'] . '</td>';
                    echo '<td>' . $arreglo_sql['fecha_probable'] . '</td>';
                    echo '<td> <img src="' . $arreglo_sql['foto'] .'" width="50" height="40" alt="Vacio"></td>';
                    echo '<td>' . $arreglo_sql['observaciones'] . '</td>';
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>