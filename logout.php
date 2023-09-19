<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redireccionar al formulario de inicio de sesión
header('Location: index.php');
exit;
?>
