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
    <link rel="stylesheet" href="styles/styles-menu-inventario.css">

    <title>Menu inventario</title>
</head>
<body>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-3">
    <div class="col-12">
        <!-- <img class="mb-4 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h1 class=" text-center mb-4">Módulo de inventario</h1>

        <div class="d-flex flex-row justify-content-center ">

            <div class="d-flex flex-row justify-content-end align-items-center col-10" >

                <a class=" h-100 d-flex flex-row justify-content-evenly align-items-center" href="../menu-principal.php">
                    <!-- <i class="fa-solid fa-circle-plus fa-2x"></i> -->
                    <button class="btn-m-inv" >Regresar al menú principal</button>
                </a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <!-- <a class=" h-100 form-control btn btn-secondary d-flex flex-row justify-content-evenly align-items-center" href="menu-inventario.php">
                    <span>Regresar al menú</span>
                </a>  -->

            </div>

        </div>
</section>

<section class="d-flex col-12 flex-column align-items-center justify-content-center">
    <div class="d-flex col-10  flex-column ">
        
        <div class="d-flex flex-column flex-md-row col-12 justify-content-between justify-content-md-around align-items-center ">
             <div class="col-12 col-md-5" >
                <a href="Vacas/hembra.php"><button class="btn-m-inv" >Alta de hembras</button></a>
            </div>
            <div class="col-12 col-md-5">
                <a href="Vacas/hembra-tabla.php"><button class="btn-m-inv" >Ver registros de hembras</button></a>
            </div>            
        </div>
           
        <div class="d-flex flex-column flex-md-row col-12 justify-content-between justify-content-md-around align-items-center">
            <div class="col-12 col-md-5">
                <a href="Machos/macho-form.php"><button class="btn-m-inv" >Alta de machos</button></a>
            </div>
            <div class="col-12 col-md-5">
                <a  href="Machos/macho-tabla.php"><button class="btn-m-inv" >Ver registros de machos</button></a>
            </div>
        </div>

    </div>

    <h3 class="pb-4">Producción</h3>


    <div class="d-flex col-10  flex-column ">
        
        <div class="d-flex flex-column flex-md-row col-12 justify-content-between justify-content-md-around align-items-center ">
             <div class="col-12 col-md-5" >
                <a href="Crias/crias-form.php"><button class="btn-m-inv" >Alta de crías</button></a>
            </div>
            <div class="col-12 col-md-5">
                <a href="Crias/crias-tabla.php"><button class="btn-m-inv" >Ver registros de crías</button></a>
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row col-12 justify-content-between justify-content-md-around align-items-center ">
            <div class="col-12 col-md-3">
                <a href="calcular-cai.php"><button class="btn-m-inv" >Calcular CAI</button></a>
            </div>
        </div>
           
        <!-- <div class="d-flex flex-column flex-md-row col-12 justify-content-between justify-content-md-around align-items-center">
            <div class="col-12 col-md-5">
                <a  href="#"><button class="form-control btn-dark btn-options" >x</button></a>
            </div>
            <div class="col-12 col-md-5">
                <a  href="#"><button class="form-control btn-dark btn-options" >x</button></a>
            </div>
        </div> -->

    </div>

    
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>