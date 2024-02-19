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

    <title>Inventario - Vacas</title>
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
    form h3{
        text-align:left;
        padding-bottom:15px;
    }
   .btn-prod{
        text-align:center;
   }
   .p-form{
        text-align:center;
        margin-bottom: 20px;
   }
</style>


<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-5">
    <div class="col-11 col-md-10">
        <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100"> 
        <h1 class=" text-center mb-4">Hoja de vida de una vaca</h1>

        <div class="d-flex flex-row justify-content-between mb-1 mb-0">

            <div class="col-0 col-xl-8"></div>

            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">

                <a class="mx-2  h-100 form-control btn btn-primary d-flex flex-row justify-content-evenly align-items-center" href="hembra-tabla.php">
                    <!-- <i class="fa-solid fa-circle-plus fa-2x"></i> -->
                    <span>Ver registros</span>
                </a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a class=" h-100 form-control btn btn-secondary d-flex flex-row justify-content-evenly align-items-center" href="menu-inventario.php">
                    <span>Regresar al menú</span>
                </a> 

            </div>

        </div>
            <!--<div class="d-flex flex-row mb-2">
            <div class="col-3 col-xl-9"></div>
            <div class="d-flex flex-row justify-content-around align-items-center col-9 col-xl-3">
                <a href="menu-inventario.php"><button class="form-control btn btn-warning" style="" ><i class="bi bi-arrow-left"></i>Regresar </button></a>
                <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> 
                <a href="hembra-tabla.php"><button class="form-control btn-primary" style="" >Ver registros</button></a>  
            </div>
        </div> -->
    </div> 
</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    
    <form class=" d-flex flex-column col-11 col-md-10 justify-content-center align-items-center"  action="hembra-script.php" method="POST" enctype="multipart/form-data">
        <p class="p-form">Formulario de registro de hoja de vida de una vaca.</p>
        <h3 class="mb-3">Vaca</h3> 

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_numero">Número de la vaca</label>
                <input type="number" class="form-control" id="vaca_numero" placeholder="Número de la vaca" name="vaca_numero" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_arete">Arete de la vaca</label>
                <input type="text" class="form-control" id="vaca_arete" placeholder="Número del arete de la vaca" name="vaca_arete" >
            </div>  
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_tatuaje">Tatuaje de la vaca</label>
                <input type="text" class="form-control" id="vaca_tatuaje" placeholder="Tatuaje de la vaca" name="vaca_tatuaje" >
            </div> 
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_raza">Raza de la vaca</label>
                <input type="text" class="form-control" id="vaca_raza" placeholder="Raza de la vaca" name="vaca_raza" >
            </div>

        </div>
        
        <h3 class="pt-4">Madre</h3>  
        
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">

            <div class="col-md-2 " >
                <label class="label-form" for="madre_numero">Número de la madre</label>
                <input type="number" class="form-control" id="madre_numero" placeholder="Número de la vaca" name="madre_numero" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="madre_arete">Arete de la madre</label>
                <input type="text" class="form-control" id="madre_arete" placeholder="Número del arete de la madre" name="madre_arete" >
            </div> 
            <div class=" col-md-3" >
                <label class="label-form" for="madre_tatuaje">Tatuaje de la madre</label>
                <input type="text" class="form-control" id="madre_tatuaje" placeholder="Tatuaje de la madre" name="madre_tatuaje" >
            </div>
            <div class="col-md-3 " >
                <label class="label-form" for="madre_raza">Raza de la madre</label>
                <input type="text" class="form-control" id="madre_raza" placeholder="Raza de la madre" name="madre_raza" >
            </div>

        </div>    

        <h3 class="pt-4">Padre</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">

            <div class=" col-md-2" >
                <label class="label-form" for="padre_numero">Número del padre</label>
                <input type="number" class="form-control" id="padre_numero" placeholder="Número del padre" name="padre_numero" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="padre_arete">Arete del padre</label>
                <input type="text" class="form-control" id="padre_arete" placeholder="Número del arete del padre" name="padre_arete" >
            </div> 
            <div class=" col-md-3" >
                <label class="label-form" for="padre_tatuaje">Tatuaje del padre</label>
                <input type="text" class="form-control" id="padre_tatuaje" placeholder="Tatuaje del padre" name="padre_tatuaje" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="padre_raza">Raza del padre</label>
                <input type="text" class="form-control" id="padre_raza" placeholder="Raza del padre" name="padre_raza" >
            </div>

        </div>

        <h3 class="pt-4">Información de la vaca</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_color">Color</label>
                <input type="text" class="form-control" id="vaca_color" placeholder="Color de la vaca" name="vaca_color" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_talla">Talla</label>
                <input type="text" class="form-control" id="vaca_talla" placeholder="Talla de la vaca" name="vaca_talla" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_pelo">Pelo</label>
                <input type="text" class="form-control" id="vaca_pelo" placeholder="Pelo de la vaca" name="vaca_pelo" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_condicion">Condición corporal</label>
                <input type="text" class="form-control" id="vaca_condicion" placeholder="Ingresar condicion corporal" name="vaca_condicion" >
            </div>
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12"> 
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_estatus">Estatus</label>
                <input type="text" class="form-control" id="vaca_estatus" placeholder="Estatus de la vaca" name="vaca_estatus" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_potrero">Potrero</label>
                <input type="text" class="form-control" id="vaca_potrero" placeholder="Potrero actual" name="vaca_potrero" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_lote">Lote</label>
                <input type="text" class="form-control" id="vaca_lote" placeholder="Lote" name="vaca_lote" >
            </div>
            <div class="col-md-3 " >
                <label class="label-form" for="vaca_estado_re">Estado reproductivo</label>
                <input type="text" class="form-control" id="vaca_estado_re" placeholder="Estado reproductivo" name="vaca_estado_re" >
            </div>        
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12"> 

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_celo">Celo</label>
                <input type="text" class="form-control" id="vaca_celo" placeholder="Celo" name="vaca_celo" >
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="vaca_partos">Número de partos</label>
                <input type="number" class="form-control" id="vaca_partos" placeholder="Número de partos" name="vaca_partos" >
            </div>

            <div class="col-md-3 " >
                <label class="label-form" for="vaca_estado_pal">Estado de palpación</label>
                <input type="text" class="form-control" id="vaca_estado_pal" placeholder="Estado de palpación" name="vaca_estado_pal" >
            </div>    
            
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_finada">Finado</label>
                <select class="form-select" style="cursor: pointer; " id="vaca_finada" name="vaca_finada">
                        <option class="option-hover" value="si">Si</option>
                        <option class="option-hover" value="no" selected>No</option>
                </select>
            </div>

        </div>

        <h3 class="pt-4">Edades</h3>
    
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-3" >
                <label class="label-form" for="vaca_edad_actual">Edad actual</label>
                <input type="text" class="form-control" id="vaca_edad_actual" placeholder="Edad en meses" name="vaca_edad_actual" >
            </div>
            <div class="col-md-3" >
                <label class="label-form" for="vaca_edad_destete">Edad de destete</label>
                <input type="text" class="form-control" id="vaca_edad_destete" placeholder="Edad en meses" name="vaca_edad_destete" >
            </div>
            <div class="col-md-3" >
                <label class="label-form" for="vaca_edad_venta">Edad de venta</label>
                <input type="text" class="form-control" id="vaca_edad_venta" placeholder="Edad en meses" name="vaca_edad_venta" >
            </div>
        </div>

        <h3 class="pt-4">Pesos</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_peso_nacimiento">Peso de nacimiento</label>
                <input type="number" class="form-control" id="vaca_peso_nacimiento" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 32.565" name="vaca_peso_nacimiento" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="vaca_peso_actual">Peso actual</label>
                <input type="number" class="form-control" id="vaca_peso_actual" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 689.705" name="vaca_peso_actual" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_peso_destete">Peso destete</label>
                <input type="number" class="form-control" id="vaca_peso_destete" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 125.345" name="vaca_peso_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_peso_venta">Peso de venta</label>
                <input type="number" class="form-control" id="vaca_peso_venta" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 813.552" name="vaca_peso_venta" >
            </div>              
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_gan_peso_dia">Ganancia de peso por día</label>
                <input type="number" class="form-control" id="vaca_gan_peso_dia" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 0.453" name="vaca_gan_peso_dia" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_gan_peso_mes">Ganancia de peso por mes</label>
                <input type="number" class="form-control" id="vaca_gan_peso_mes" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 15.453" name="vaca_gan_peso_mes" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="vaca_peso_3meses">Peso en 3 meses</label>
                <input type="number" class="form-control" id="vaca_peso_3meses" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 93.604" name="vaca_peso_3meses" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>

        <h3 class="pt-4">Fechas</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2" >
                <label class="label-form" for="vaca_fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="vaca_fecha_nacimiento" placeholder="Seleccionar fecha" name="vaca_fecha_nacimiento" >
            </div>      
            <div class="col-md-2" >
                <label class="label-form" for="vaca_fecha_destete">Fecha de destete</label>
                <input type="date" class="form-control" id="vaca_fecha_destete" placeholder="Seleccionar fecha" name="vaca_fecha_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_fecha_aretado">Fecha aretado</label>
                <input type="date" class="form-control" id="vaca_fecha_aretado" placeholder="Fecha aretado" name="vaca_fecha_aretado" >
            </div>

            <div class="col-md-2" >
                <label class="label-form" for="vaca_fecha_tatuaje">Fecha de tatuaje</label>
                <input type="date" class="form-control" id="vaca_fecha_tatuaje" placeholder="Fecha aretado" name="vaca_fecha_tatuaje" >
            </div>
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_fecha_fierro">Fecha de fierro</label>
                <input type="date" class="form-control" id="vaca_fecha_fierro" placeholder="Fecha aretado" name="vaca_fecha_fierro" >
            </div>                               
            <div class="col-md-2 " >
                <label class="label-form" for="vaca_fecha_probable">Fecha probable</label>
                <input type="date" class="form-control" id="vaca_fecha_probable" placeholder="Fecha probable" name="vaca_fecha_probable" >
            </div>
            <div class="col-md-2" >
                <label class="label-form" for="vaca_fecha_venta">Fecha de venta</label>
                <input type="date" class="form-control" id="vaca_fecha_venta" placeholder="Seleccionar fecha" name="vaca_fecha_venta" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>  

        <h3 class="pt-4">Producción - Partos</h3>

        <div class="d-flex justify-content-md-around d-md-flex flex-md-row flex-column col-12">
            <a href="crias-form.php" class="mb-3 mb-md-0 mx-1 text-center py-2 btn-primary col-12 col-xl-6 rounded-3">Formulario de partos</a> 
        </div>

        <h3 class="pt-4">Producción - Leche</h3>


        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_leche_dia">Promedio de leche al día</label>
                <input type="number" class="form-control" id="vaca_leche_dia" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 15.123" name="vaca_leche_dia" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_leche_mes">Promedio de leche al mes</label>
                <input type="number" class="form-control" id="vaca_leche_mes" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 453.453" name="vaca_leche_mes" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="vaca_leche_comentario">Comentario</label>
                <input type="text" class="form-control" id="vaca_leche_comentario" placeholder="Opcional" name="vaca_leche_comentario" >
            </div>
        </div>

        <h3 class="pt-4">Información adicional</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-5" >
                <label class="label-form" for="vaca_foto">Fotografía de la vaca</label>
                <input class="form-control" type="file" id="vaca_foto"  accept="image/*" name="vaca_foto">
            </div>   
            <div class=" col-md-5" >
                <label class="label-form" for="vaca_foto_fierro">Fotografía fierro</label>
                <input class="form-control" type="file" id="vaca_foto_fierro"  accept="image/*" name="vaca_foto_fierro">
            </div>
        </div>
        
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-12" > 
                <label class="label-form" for="vaca_observaciones">Observaciones</label>
                <textarea class="form-control" id="vaca_observaciones"  rows="4" cols="50" name="vaca_observaciones"></textarea> 
            </div>           
        </div>

        <input type="submit" class="btn btn-success col-12 col-xl-6 py-3" value="Enviar datos" >

    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>