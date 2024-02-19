<?php
include("conexion.php");
//session_start();
//
//if (!isset($_SESSION['id_usuario'])) {
//    header("Location: login.html");
//    exit;
//} else {
//    echo 'Usuario autenticado con ID: '.$_SESSION['id_usuario'];
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <title>Inventario - machos</title>
</head>
<body>

<style>
    section form div{
        width: 100%;
       margin-bottom: 15px;
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
    form{
        border: 1px solid #ccc;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        background-color: #f9f9f9;
        padding: 3%;
        border-radius:10px
    }
   
</style>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-5">
    <div class="col-10">
          <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="" width="110" height="100"> -->
        <h1 class=" text-center mb-4">Registro de macho</h1>
        <div class="d-flex flex-row mb-2">
            <div class="col-3 col-xl-9"></div>
            <div class="d-flex flex-row justify-content-around align-items-center col-9 col-xl-3">
                <a href="menu-inventario.php"><button class="form-control btn btn-warning" style="" ><i class="bi bi-arrow-left"></i>Regresar </button></a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a href="macho-tabla.php"><button class="form-control btn-primary" style="" >Ver registros</button></a>  
            </div>
        </div>
    </div> 
</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    
    <form class=" d-flex flex-column col-11 col-md-10 justify-content-center align-items-center"  action="macho-script.php" method="POST" enctype="multipart/form-data">

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-3" >
                <label class="label-form" for="padre_num">Número del padre</label>
                <input type="number" class="form-control" id="padre_num" placeholder="Número del toro" name="padre_num" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="padre_raza">Raza del padre</label>
                <input type="text" class="form-control" id="padre_raza" placeholder="Raza del toro" name="padre_raza" >
            </div>

            <div class="col-md-3 " >
                <label class="label-form" for="madre_num">Número de la madre</label>
                <input type="number" class="form-control" id="padre_num" placeholder="Número de la toro" name="madre_num" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="madre_raza">Raza de la madre</label>
                <input type="text" class="form-control" id="madre_raza" placeholder="Raza de la toro" name="madre_raza" >
            </div>
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-3" >
                <label class="label-form" for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" placeholder="Seleccionar fecha" name="fecha_nacimiento" >
            </div>

            <div class="col-md-3" >
                <label class="label-form" for="fecha_destete">Fecha de destete</label>
                <input type="date" class="form-control" id="fecha_destete" placeholder="Seleccionar fecha" name="fecha_destete" >
            </div>        
       
            <div class="col-md-3 " >
                <label class="label-form" for="fecha_venta">Fecha de venta</label>
                <input type="date" class="form-control" id="fecha_venta" placeholder="Seleccionar fecha" name="fecha_venta" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="edad_actual">Edad actual</label>
                <input type="number" class="form-control" id="edad_actual" step="0.01" min="0" max="999.99" placeholder="Edad en meses" name="edad_actual" >
            </div>
        </div>  
        
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2 " >
                <label class="label-form" for="edad_destete">Edad de destete</label>
                <input type="number" class="form-control" id="edad_destete" placeholder="Edad en meses" name="edad_destete" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="edad_venta">Edad de venta</label>
                <input type="number" class="form-control" id="edad_venta" placeholder="Edad en meses" name="edad_venta" >
            </div>
        
            <div class="col-md-2 " >
                <label class="label-form" for="peso_nacimiento">Peso de nacimiento</label>
                <input type="number" class="form-control" id="peso_nacimiento" step="0.001" min="0" max="9999.999" placeholder="Peso en kg." name="peso_nacimiento" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="peso_3meses">Peso en 3 meses</label>
                <input type="number" class="form-control" id="peso_3meses" step="0.001" min="0" max="9999.999" placeholder="Peso en kg." name="peso_3meses" >
            </div>

        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2 " >
                <label class="label-form" for="peso_destete">Peso destete</label>
                <input type="number" class="form-control" id="peso_destete" step="0.001" min="0" max="9999.999" placeholder="Peso en kg." name="peso_destete" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="peso_venta">Peso de venta</label>
                <input type="number" class="form-control" id="peso_venta" step="0.001" min="0" max="9999.999" placeholder="Peso en kg." name="peso_venta" >
            </div>        
        
            <div class=" col-md-2" >
                <label class="label-form" for="ganancia_peso_dia">Ganancia de peso por día</label>
                <input type="number" class="form-control" id="ganancia_peso_dia" step="0.001" min="0" max="9999.999" placeholder="Peso en kg." name="ganancia_peso_dia" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="ganancia_peso_mes">Ganancia de peso por mes</label>
                <input type="number" class="form-control" id="ganancia_peso_mes" step="0.001" min="0" max="9999.999" placeholder="Peso en kg." name="ganancia_peso_mes" >
            </div>
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-2" >
                <label class="label-form" for="finado">Finado</label>
                <select class="form-select" style="cursor: pointer; " id="finado" name="finado">
                        <option class="option-hover" value="si">Si</option>
                        <option class="option-hover" value="no" selected>No</option>
                </select>
            </div>

            <div class="col-md-3" >
                <label class="label-form" for="cria_num">Número de cría</label>
                <input type="number" class="form-control" id="cria_num" placeholder="Número de la cría" name="cria_num" >
            </div>        
    
            <div class="col-md-3 " >
                <label class="label-form" for="cria_arete">Arete de cría</label>
                <input type="text" class="form-control" id="cria_arete" placeholder="Número del arete de la cría" name="cria_arete" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="destino_cria">Destino de la cría</label>
                <input type="text" class="form-control" id="destino_cria" placeholder="Destino" name="destino_cria" >
            </div>

        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        
            <div class=" col-md-2" >
                <label class="label-form" for="toro_num">Número del toro</label>
                <input type="number" class="form-control" id="toro_num" placeholder="Número del toro" name="toro_num" >
            </div>

            <div class=" col-md-3" >
                <label class="label-form" for="toro_arete">Arete del toro</label>
                <input type="text" class="form-control" id="toro_arete" placeholder="Número del arete del toro" name="toro_arete" >
            </div>        
        
            <div class=" col-md-2" >
                <label class="label-form" for="toro_raza">Raza del toro</label>
                <input type="text" class="form-control" id="toro_raza" placeholder="Raza del toro" name="toro_raza" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="fecha_aretado">Fecha aretado</label>
                <input type="date" class="form-control" id="fecha_probable" placeholder="Fecha aretado" name="fecha_aretado" >
            </div>  
        </div>

       <div class="justify-content-md-between d-md-flex flex-md-row col-md-12"> 
            <div class=" col-md-2" >
                <label class="label-form" for="estatus">Estatus</label>
                <input type="text" class="form-control" id="estatus" placeholder="Estatus" name="estatus" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="potrero">Potrero</label>
                <input type="text" class="form-control" id="potrero" placeholder="Potrero actual" name="potrero" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="lote">Lote</label>
                <input type="text" class="form-control" id="celo" placeholder="Lote" name="lote" >
            </div>

            <div class="col-md-3 " >
                <label class="label-form" for="estado_reproductivo">Estado reproductivo</label>
                <input type="text" class="form-control" id="estado_reproductivo" placeholder="Estado reproductivo" name="estado_reproductivo" >
            </div>        
       </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12"> 
            <div class=" col-md-3" >
                <label class="label-form" for="celo">Celo</label>
                <input type="text" class="form-control" id="celo" placeholder="Celo" name="celo" >
            </div>

        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-5" >
                <label class="label-form" for="foto">Fotografía</label>
                <input class="form-control" type="file" id="foto"  accept="image/*" name="foto">
            </div>   

            <div class="col-md-6 " > 
                <label class="label-form" for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones"  rows="4" cols="50" name="observaciones"></textarea> 
            </div>           
        </div>

        <input type="submit" class="btn btn-success col-6" value="Registrar" >

    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>