<?php
//include("conexion.php");
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../jquery-3.7.1.min.js"></script>


    <title>Calcular CAI</title>
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
    .form{
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
        <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h1 class=" text-center mb-4">Calcular CAI</h1>

        <div class="d-flex flex-row justify-content-between mb-1 mb-0">

            <div class="col-0 col-xl-8"></div>

            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">

                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a class=" h-100 form-control btn btn-secondary d-flex flex-row justify-content-evenly align-items-center" href="menu-inventario.php">
                    <span>Regresar al menú</span>
                </a> 

            </div>

        </div>
    </div> 
</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    

    <div class="form d-flex flex-column col-11 col-md-10 justify-content-center align-items-center"  >
        <p class="p-form">Formulario para calcular Carga Animal Instantánea.</p>



        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        
            <div class=" col-md-2" >
                <label class="label-form" for="ugm">UGM</label>
                <input type="number" class="form-control" id="ugm" placeholder="Digitar el UGM" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="cg">Cantidad de ganado</label>
                <input type="number" class="form-control" id="cg" placeholder="Digitar cantidad" >
            </div>
            <div class=" col-md-2" >
            </div>
            <div class=" col-md-2" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>

        </br>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12">        
            <div class=" col-md-2" >
                <label class="label-form" for="pvt">Peso Vivo Total</label>
                <input type="number" class="form-control" id="pvt" placeholder="Digitar el PVT" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="po">Periodo de Ocupación</label>
                <div class="d-flex text-center flex-row justify-content-center align-items-center">
                    <input type="number" class="form-control" id="po" placeholder="Digitar PO" value="1">
                    <p style="margin-bottom:0px;">día(s)</p>
                </div>
                
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="ua">UA</label>
                <div class="d-flex text-center flex-row justify-content-center align-items-center">
                    <input type="number" class="form-control" id="ua" placeholder="Digitar UA" >
                    <p style="margin-bottom:0px;">Kg.</p>
                </div>
                
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="s">Superficie</label>
                <div class="d-flex text-center flex-row justify-content-center align-items-center">
                    <input type="number" class="form-control" id="s" placeholder="Digitar Superficie" >
                    <p style="margin-bottom:0px;">ha</p>

                </div>
            </div>
            <div class=" col-md-2" >
            </div>
        </div>
        
        </br>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12"> 
            <div class=" " >
                <h5 class="">Total = <span class="text-success" id="r"></span> día/ha</h5>
            </div>
        </div>

        </br>

        <div class="justify-content-md-between d-md-flex flex-md-row col-md-12"> 
            <div class=" " >
                <h5 class="">Eso representa <span class="" id="i"></span></h5>
            </div>
        </div>

    </div>
</section>

<script>
$(document).ready(function(){
    // Función para realizar el cálculo y actualizar el campo PVT
    function calcularPVT() {
        var ugm = parseFloat($("#ugm").val());
        var cg = parseFloat($("#cg").val());
        var pvt = ugm * cg;
        $("#pvt").val(pvt);
        
        // Llamar a la función calcularR para actualizar el campo R
        calcularR();
    }
    
    // Agregar evento para calcular PVT cuando cambian los valores de UGM o CG
    $("#ugm, #cg").on("input", calcularPVT);
  
    // Función para realizar el cálculo y actualizar el campo R
    function calcularR() {
        var pvt = parseFloat($("#pvt").val());
        var po = parseFloat($("#po").val());
        var ua = parseFloat($("#ua").val());
        var s = parseFloat($("#s").val());
        var resultado = (pvt * po) / (ua * s);
        $("#r").text(resultado);

            // Determinar el texto para el span según el resultado
        var texto;
        if (resultado <= 200) {
            texto = "Carga animal baja";
        } else if (resultado > 200 && resultado <= 400) {
            texto = "Carga animal media";
        } else if (resultado > 400 && resultado <= 600) {
            texto = "Carga animal alta";
        } else if (resultado > 600){
            texto = "Carga animal de ultra alta densidad";
        }else{
            texto = ""
        }
        $("#i").text(texto);
    }
    
    // Agregar evento para calcular R cuando cambian los valores de los campos
    $("#pvt, #po, #ua, #s").on("input", calcularR);
});

</script>
</body>
</html>