<?php
require 'connection.php'; // Asegúrate de incluir la conexión a la base de datos aquí
$db = new Database();
$con = $db->conectar();

if (isset($_GET['token'])) {
    $activationToken = $_GET['token'];

    // Consulta SQL para buscar un usuario con el token de activación
    $sql = "SELECT * FROM users WHERE activation_token = :token";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':token', $activationToken, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Encontró un usuario con el token de activación, actualiza su estado a activo
        $updateSql = "UPDATE users SET active = 1 WHERE activation_token = :token";
        $updateStmt = $con->prepare($updateSql);
        $updateStmt->bindParam(':token', $activationToken, PDO::PARAM_STR);
        $updateStmt->execute();

        echo 'Tu cuenta ha sido activada correctamente. Puedes iniciar sesión ahora.';
        
        // Redirige al usuario a login.php después de 2 segundos
        header('refresh:2;url=login.php');
        exit; // Termina el script para evitar que se ejecute más código después de la redirección
    } else {
        echo 'Token de activación no válido.';
    }
} else {
    echo 'Token de activación no proporcionado.';
}
?>
