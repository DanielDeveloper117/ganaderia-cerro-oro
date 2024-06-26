<?php
//include("conexion.php");
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
    <link rel="stylesheet" href="styles/styles.css">

    <title>Menu principal</title>
</head>
<body>

<style>


</style>

<section class="d-flex col-12 flex-column align-items-center justify-content-center">

    <img class="mb-3 mt-4" src="img/logo-copia.png" alt="" width="110" height="100">

    <div class="mb-5 d-flex justify-content-around col-10 col-md-6">
        <h2 class="">Menu principal - Ganadería Cerro de Oro </h2>
        <!-- <a href="logout.php"><button class="form-control btn-danger"  >Cerrar sesión </button></a> -->
    </div>

    <div class="d-flex col-10 col-md-6 flex-column ">
        
      

        <div class="d-flex flex-column flex-md-row col-12 justify-content-between justify-content-md-around align-items-center ">
             <div class="col-12 col-md-5" >
                <a href="ModuloInventario/menu-inventario.php"><button class="btn-m-principal" >Módulo de inventario</button></a>
            </div>
            <div class="col-12 col-md-5">
                <a href=""><button class="btn-m-principal" >Opcion</button></a>
            </div>
        </div>
           
        <div class="d-flex flex-column flex-md-row col-12 justify-content-between justify-content-md-around align-items-center">
            <div class="col-12 col-md-5">
                <a href=""><button class="btn-m-principal" >Opcion</button></a>
            </div>
            <div class="col-12 col-md-5">
                <a  href=""><button class="btn-m-principal" >Opcion</button></a>
            </div>
        </div>

            
        
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>