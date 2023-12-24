<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    echo '<script>alert("no has iniciado sesion");</script>';
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
    <title>Registrar usuario</title>
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
        <h3 class="">Registrar agente o líder</h3>
        <a href="menu-lider.php"><button class="form-control btn-warning" style="margin-bottom: 20px;" >Regresar </button></a>

        <a href="logout.php"><button class="form-control btn-danger" style="margin-bottom: 20px;" >Cerrar sesión </button></a>
    </div>
    

    <form class=" d-flex flex-column col-10 col-md-4 justify-content-center align-items-center" action="usuarios-form.php" method="POST" >

        <div class="" >
            <label class="label-form" for="nombre">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required>
        </div>

        <div class="" >
            <label class="label-form" for="usuario">Usuario</label>
            <input type="text" class="form-control" id="usuario" placeholder="usuario" name="usuario" required>
        </div>

        <div class=" " >
            <label class="label-form" for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" placeholder="correo@ejemplo.com" name="correo" required>
        </div>

        <div class=" ">
            <label class="label-form" for="pass">Contraseña</label>
            <input type="password" class="form-control" id="pass" placeholder="Contraseña" name="pass" required>
        </div>

       <div class=" " >
            <label class="label-form" for="rol">Rol de usuario</label>
            <select class="form-select" style="cursor: pointer; " id="rol" name="rol" required>
                    <option style="color: #6c757da8;" value=""  selected>Seleccionar</option>
                    <option class="option-hover" value="agente">Agente</option>
                    <option class="option-hover" value="lider">Lider-Admin</option>
            </select>
        </div>

        <input type="submit" class="btn btn-primary col-6" value="Registrar usuario" >

    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>