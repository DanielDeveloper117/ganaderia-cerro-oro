<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit;
} else {
    echo 'Usuario autenticado con ID: '.$_SESSION['id_usuario'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Generar reportes</title>
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

<section class="d-flex col-12 flex-column align-items-center justify-content-center" >
    <img class="mb-1 mt-2" src="img/logo-copia.png" alt="" width="110" height="100">
    <div class="d-flex justify-content-between col-10 col-md-4">
        <h3 class="">Generar reportes</h3>
        <a href="menu-lider.php"><button class="form-control btn-warning" style="margin-bottom: 20px;" >Regresar </button></a>
        <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a>
    </div>
    
</section>

<section class="" style="margin-top:50px; padding-right: 3%; padding-left: 3%;">
  
    
    <div style=" border: 1px solid #000;">
        <?php
        try {
            // Consulta SQL con prepared statement filtrando por rol=agente
            $sql = "SELECT id_usuario, nombre, usuario FROM registro_usuarios WHERE rol = 'agente'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            // Mostrar los resultados en una tabla HTML
            echo '<table class="table table-striped ">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre del agente</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Generar reporte</th>
                      </tr>
                    </thead>
                    <tbody>';
        
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                    echo '<td>' . $fila['id_usuario'] . '</td>';
                    echo '<td>' . $fila['nombre'] . '</td>';
                    echo '<td>' . $fila['usuario'] . '</td>';
                    echo '<td><a href="fpdf/reporte-agente.php?id=' . $fila['id_usuario'] . '" target="_blank" class="btn btn-success">Generar reporte<svg style="padding-left:5px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                         <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                        </svg></a></td>';
                echo '</tr>';
            }
        
            echo '</tbody></table>';
        
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
        // Cerrar la conexión
        $conn = null;
        ?>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>