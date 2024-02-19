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

    <title>Tabla de crías</title>
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
        <h1 class=" text-center mb-4">Producción de crías</h1>

        <div class="d-flex flex-row justify-content-between mb-1 mb-0">

            <div class="col-0 col-xl-8"></div>

            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">

                <a class="mx-2  h-100 form-control btn btn-primary d-flex flex-row justify-content-evenly align-items-center" href="crias-tabla.php">
                    <!-- <i class="fa-solid fa-circle-plus fa-2x"></i> -->
                    <span>Ver registros</span>
                </a>
                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a class=" h-100 form-control btn btn-secondary d-flex flex-row justify-content-evenly align-items-center" href="menu-inventario.php">
                    <span>Regresar al menú</span>
                </a> 

            </div>

        </div>
    </div> 
</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    

    <form class=" d-flex flex-column col-11 col-md-10 justify-content-center align-items-center"  action="crias-form-script.php" method="POST" >
        <p class="p-form">Formulario de registro de producción de crías.</p>
        <h3>Registrar parto</h3> 
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        
            <div class=" col-md-3" >
                <label class="label-form" for="cria_numero">Número de la madre</label>
                <?php
                    if (isset($_POST['id_vaca'])) {
                        $id_vaca = $_POST['id_vaca'];
                    
                        $sql = "SELECT id_vaca, vaca_numero FROM vacas WHERE id_vaca = :id_vaca";
                        $stmt = $conexion->prepare($sql);
                        $stmt->bindParam(':id_vaca', $id_vaca);

                        $stmt->execute();
                        $arreglo_sql = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo '<input type="number" class="form-control" id="cria_numero" value="'.$arreglo_sql['vaca_numero'].'" name="madre_numero" >';
                    } else{
                        echo '<input type="number" class="form-control" id="cria_numero" placeholder="Número de la madre" name="madre_numero" >';
                    }

                ?>
                
            </div>

            <div class=" col-md-2" >
                <label class="label-form" for="cria_arete">Número de parto</label>
                <input type="number" class="form-control" id="cria_arete" placeholder="Número del parto" name="parto_numero" >
            </div>  

            <div class=" col-md-2" >
                <label class="label-form" for="cria_sexo">Sexo de la cría</label>
                <select class="form-select" style="cursor: pointer; " id="cria_sexo" name="cria_sexo">
                        <option class="option-hover" value="No Seleccionado" selected>Seleccionar</option>
                        <option class="option-hover" value="Hembra">Hembra</option>
                        <option class="option-hover" value="Macho">Macho</option>
                </select>
            </div>

            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="cria_fecha_nacimiento" placeholder="Seleccionar fecha" name="cria_fecha_nacimiento" >
            </div>  
        
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        
            <div class=" col-md-2" >
                <label class="label-form" for="cria_numero">Número de la cria</label>
                <input type="number" class="form-control" id="cria_numero" placeholder="Número de la cría" name="cria_numero" >
            </div>
            <div class=" col-md-3" >
                <label class="label-form" for="cria_arete">Arete de la cria</label>
                <input type="text" class="form-control" id="cria_arete" placeholder="Número del arete de la cria" name="cria_arete" >
            </div>  
            <div class=" col-md-3" >
                <label class="label-form" for="cria_tatuaje">Tatuaje de la cria</label>
                <input type="text" class="form-control" id="cria_tatuaje" placeholder="Tatuaje de la cria" name="cria_tatuaje" >
            </div> 
        
            <div class=" col-md-3" >
                <label class="label-form" for="cria_raza">Raza</label>
                <input type="text" class="form-control" id="cria_raza" placeholder="Raza de la cria" name="cria_raza" >
            </div>
        </div>
        
        <h3 class="pt-4">Pesos</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_nacimiento">Peso de nacimiento</label>
                <input type="number" class="form-control" id="cria_peso_nacimiento" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 32.565" name="cria_peso_nacimiento" >
            </div>

            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_destete">Peso destete</label>
                <input type="number" class="form-control" id="cria_peso_destete" step="0.001" min="0" max="9999.999" placeholder="Ejemplo 125.345" name="cria_peso_destete" >
            </div>
            <div class="col-md-2 " >
                <label class="label-form" for="cria_peso_venta">Peso de venta</label>
                <input type="number" class="form-control" id="cria_peso_venta" step="0.001" min="0" max="9999.999" placeholder="Digitar peso de venta" name="cria_peso_venta" >
            </div>              

            <div class=" col-md-2" >
                <label class="label-form" for="cria_finada">Cría finada</label>
                <select class="form-select" style="cursor: pointer; " id="cria_finada" name="cria_finada">
                        <option class="option-hover" value="si">Si</option>
                        <option class="option-hover" value="no" selected>No</option>
                </select>
            </div>
        </div>


        <h3 class="pt-4">Otras fechas</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
      
            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_destete">Fecha de destete</label>
                <input type="date" class="form-control" id="cria_fecha_destete" placeholder="Seleccionar fecha" name="cria_fecha_destete" >
            </div>
            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_aretado">Fecha aretado</label>
                <input type="date" class="form-control" id="cria_fecha_aretado" placeholder="Fecha aretado" name="cria_fecha_aretado" >
            </div>

            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_tatuaje">Fecha de tatuaje</label>
                <input type="date" class="form-control" id="cria_fecha_tatuaje" placeholder="Fecha aretado" name="cria_fecha_tatuaje" >
            </div>
        </div>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">

            <div class="col-md-2 " >
                <label class="label-form" for="cria_fecha_fierro">Fecha de fierro</label>
                <input type="date" class="form-control" id="cria_fecha_fierro" placeholder="Fecha aretado" name="cria_fecha_fierro" >
            </div>                               

            <div class="col-md-2" >
                <label class="label-form" for="cria_fecha_venta">Fecha de venta</label>
                <input type="date" class="form-control" id="cria_fecha_venta" placeholder="Seleccionar fecha" name="cria_fecha_venta" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>  

        <!-- <h3 class="pt-4">Información adicional</h3>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class=" col-md-5" >
                <label class="label-form" for="cria_foto">Fotografía de la cria</label>
                <input class="form-control" type="file" id="cria_foto"  accept="image/*" name="cria_foto">
            </div>   
            <div class=" col-md-5" >
                <label class="label-form" for="cria_foto_fierro">Fotografía fierro</label>
                <input class="form-control" type="file" id="cria_foto_fierro"  accept="image/*" name="cria_foto_fierro">
        </div>
        </div> -->
        
        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">
            <div class="col-md-12" > 
                <label class="label-form" for="cria_observaciones">Observaciones</label>
                <textarea class="form-control" id="cria_observaciones"  rows="4" cols="50" name="cria_observaciones"></textarea> 
            </div>           
        </div>

        <input type="submit" class="btn btn-success col-12 col-xl-6 py-3" value="Registrar" >

    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>