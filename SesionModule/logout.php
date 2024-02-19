<?php
session_start();
session_destroy();
header("Location: login.html"); // Redirigir al inicio de sesión después de cerrar la sesión
exit;
?>
