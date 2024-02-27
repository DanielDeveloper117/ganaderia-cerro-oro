<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ganaderia_cerro_oro";
try {
    $conexion = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa<br>";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
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

    <title>Tabla de inventario - Crías</title>
</head>
<body>

<style>
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

<section class="mb-5 mt-4" style=" padding-right: 3%; padding-left: 3%;">
    <div style=" border: 1px solid #000; overflow-x:auto;">
    <?php
        try {
            $sql = "SELECT id_cria, madre_numero, parto_numero, cria_sexo, 
            cria_fecha_nacimiento, cria_numero, cria_arete, cria_tatuaje, cria_raza,  
            cria_peso_nacimiento, cria_peso_destete, cria_peso_venta, cria_finada, 
            cria_fecha_destete, cria_fecha_aretado, cria_fecha_tatuaje, 
            cria_fecha_fierro, cria_fecha_venta, cria_observaciones, fecha_registro  FROM crias";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            
            echo '<table id="tabla_crias" class="table table-bordered table-striped border border-2 " >
                    <thead>
                    <tr>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar registro</th>

                        <th scope="col">Número de la madre</th>
                        <th scope="col">Número del parto</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Fecha de nacimiento</th>

                        <th scope="col">Número de la cria</th>
                        <th scope="col">Número de arete</th>
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
                                <button type="submit" id="botonEliminar" class="form-control btn-danger" style="font-size:12px; " ><i style="margin-right:5px;" class="bi bi-trash"></i>
                                     Eliminar
                                </button>
                            </form>
                         </td>';

                    echo '<td> 
                            <form action="editar-cria.php" method="POST">
                                <input type="hidden" name="id_cria" value="'. $arreglo_sql['id_cria'].'">
                                <button type="submit" class="form-control btn-info"><i style="margin-right:5px;" class="bi bi-pencil-square"></i>Editar</button>
                            </form>
                         </td>';

                         echo '<td>' . $arreglo_sql['madre_numero'] . '</td>';
                         echo '<td>' . $arreglo_sql['parto_numero'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_sexo'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_fecha_nacimiento'] . '</td>';
   
                         echo '<td>' . $arreglo_sql['cria_numero'] . '</td>';
                         echo '<td>' . $arreglo_sql['cria_arete'] . '</td>';
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

                         echo '<td>' . $arreglo_sql['cria_observaciones'] . '</td>';
                         echo '<td>' . $arreglo_sql['fecha_registro'] . '</td>';

                echo '</tr>';
            }
            echo '</tbody></table>';
        
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conexion = null;
    ?>
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
                "first":"Primero",
                "last":"Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
              }
            },

            "scrollY": "300px", // Altura del área de desplazamiento vertical
            "scrollCollapse": true // Colapso del scroll cuando no es necesario
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>