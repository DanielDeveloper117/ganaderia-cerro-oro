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
include("../conexion.php");

$sqlTotalCrias = "SELECT COUNT(*) AS total_crias FROM crias WHERE cria_finada = 'No'";
$stmtTotalCrias = $conexion->prepare($sqlTotalCrias);
$stmtTotalCrias->execute();
$arregloTotalCrias = $stmtTotalCrias->fetch(PDO::FETCH_ASSOC);
$cantidadTotalCrias = $arregloTotalCrias['total_crias'];

$sqlTotalVacas = "SELECT COUNT(*) AS total_vacas FROM vacas WHERE vaca_finada = 'No'";
$stmtTotalVacas = $conexion->prepare($sqlTotalVacas);
$stmtTotalVacas->execute();
$arregloTotalVacas = $stmtTotalVacas->fetch(PDO::FETCH_ASSOC);
$cantidadTotalVacas = $arregloTotalVacas['total_vacas'];

$sqlTotalMachos = "SELECT COUNT(*) AS total_machos FROM machos WHERE macho_finado = 'No'";
$stmtTotalMachos = $conexion->prepare($sqlTotalMachos);
$stmtTotalMachos->execute();
$arregloTotalMachos = $stmtTotalMachos->fetch(PDO::FETCH_ASSOC);
$cantidadTotalMachos = $arregloTotalMachos['total_machos'];

$totalGanado = $cantidadTotalCrias + $cantidadTotalVacas + $cantidadTotalMachos;

$sqlSumaPesoCrias = "SELECT SUM(cria_peso_actual) AS suma_peso_crias FROM crias WHERE cria_finada = 'No'";
$stmtSumaPesoCrias = $conexion->prepare($sqlSumaPesoCrias);
$stmtSumaPesoCrias->execute();
$arregloSumaPesoCrias = $stmtSumaPesoCrias->fetch(PDO::FETCH_ASSOC);
$sumaPesoCrias = $arregloSumaPesoCrias['suma_peso_crias'];

$sqlSumaPesoMachos = "SELECT SUM(macho_peso_actual) AS suma_peso_machos FROM machos WHERE macho_finado = 'No'";
$stmtSumaPesoMachos = $conexion->prepare($sqlSumaPesoMachos);
$stmtSumaPesoMachos->execute();
$arregloSumaPesoMachos = $stmtSumaPesoMachos->fetch(PDO::FETCH_ASSOC);
$sumaPesoMachos = $arregloSumaPesoMachos['suma_peso_machos'];

$sqlSumaPesoVacas = "SELECT SUM(vaca_peso_actual) AS suma_peso_vacas FROM vacas WHERE vaca_finada = 'No'";
$stmtSumaPesoVacas = $conexion->prepare($sqlSumaPesoVacas);
$stmtSumaPesoVacas->execute();
$arregloSumaPesoVacas = $stmtSumaPesoVacas->fetch(PDO::FETCH_ASSOC);
$sumaPesoVacas = $arregloSumaPesoVacas['suma_peso_vacas'];

$pesoTotalGanado = $sumaPesoCrias + $sumaPesoMachos + $sumaPesoVacas;
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
    <link rel="stylesheet" href="styles/styles-cai.css">

    <title>Calcular CAI</title>
</head>
<body>

<section class="d-flex justify-content-center align-items-center flex-column col-12 col-md-12 mb-3 mt-5">
    <div class="col-11 col-md-10">
        <!-- <img class="mb-1 mt-2" src="img/logo-copia.png" alt="Logo" width="110" height="100">  -->
        <h1 class=" text-center mb-4">Calcular CAI</h1>

        <div class="d-flex flex-row justify-content-between mb-1 mb-0">

            <div class="col-0 col-xl-8"></div>

            <div class="d-flex flex-row justify-content-around align-items-center col-12 col-xl-4">

                <!-- <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a> -->
                <a class=" h-100 btn-principal d-flex flex-row justify-content-evenly align-items-center " href="menu-inventario.php">
                    Regresar al menú
                </a> 

            </div>

        </div>
    </div> 
</section>

 
<section class="d-flex col-12 flex-column align-items-center justify-content-center" >    
    <div class="form d-flex flex-column col-11 col-md-10 justify-content-center align-items-center formulario"  >
        <p class="p-form">Formulario para calcular Carga Animal Instantánea.</p>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" col-md-2" >
                <label class="label-form" for="cg">Cantidad de ganado</label>
                <input type="number" class="form-control mb-3" id="cg" value="<?php echo $totalGanado ?>"  placeholder="Digitar cantidad" >
            </div>
            <div class=" col-md-2" >
            </div>
            <div class=" col-md-2" >
            </div>
            <div class=" col-md-2" >
            </div>
        </div>

        </br>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" col-md-2" >
                <label class="label-form" for="pvt">Peso Vivo Total</label>
                <input type="number" class="form-control mb-3" id="pvt" value="<?php echo $pesoTotalGanado ?>" placeholder="Digitar el PVT" >
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="po">Periodo de Ocupación</label>
                <div class="d-flex text-center flex-row justify-content-center align-items-center">
                    <input type="number" class="form-control mb-3" id="po" placeholder="Digitar PO" value="1">
                    <p style="margin-bottom:0px;">día(s)</p>
                </div>
                
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="ua">UA o UGM</label>
                <div class="d-flex text-center flex-row justify-content-center align-items-center">
                    <select class="form-select" style="cursor: pointer; " id="ua">
                            <option class="option-hover" value="450" selected>UA - 450 kg</option>
                            <option class="option-hover" value="1000" >UGM - 1000 kg</option>
                    </select>  
                </div>
                
            </div>
            <div class=" col-md-2" >
                <label class="label-form" for="s">Superficie</label>
                <div class="d-flex text-center flex-row justify-content-center align-items-center">
                    <input type="number" class="form-control mb-3" id="s" placeholder="Digitar Superficie" >
                    <p style="margin-bottom:0px;">ha</p>

                </div>
            </div>
            <div class=" col-md-2" >
            </div>
        </div>
        
        </br>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" " >
                <h5 class="">Total = <span class="text-success" id="r"></span> día/ha</h5>
            </div>
        </div>

        </br>

        <div class="d-flex flex-column justify-content-md-between d-md-flex flex-md-row col-md-12 div-conteiner-inputs-group">        
            <div class=" " >
                <h5 class="">Eso representa: <span class="" id="i" style="background-color:#7e7e7e33;"></span></h5>
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
            texto = "..."
        }
        $("#i").text(texto);
    }
    
    // Agregar evento para calcular R cuando cambian los valores de los campos
    $("#pvt, #po, #ua, #s").on("input", calcularR);
});

</script>
</body>
</html>