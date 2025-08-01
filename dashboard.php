<?php
session_start();

// Comprobamos si el usuario ha iniciado sesión
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}

// Si ha iniciado sesión, lo redirigimos automáticamente a su página de perfil
header("Location: myroblox.php");
exit();
?>