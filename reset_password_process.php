<?php
session_start();
require 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $token = $_POST['token'];

    // Validar que las contraseñas coincidan
    if ($newPassword !== $confirmPassword) {
        $_SESSION['error_message'] = "Las contraseñas no coinciden. Inténtalo nuevamente.";
        header('Location: reset_password.php?token=' . $token);
        exit;
    }

    // Validar la nueva contraseña
    if (strlen($newPassword) < 8 || !preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $newPassword)) {
        $_SESSION['error_message'] = "La nueva contraseña debe tener al menos 8 caracteres y contener números y letras.";
        header('Location: reset_password.php?token=' . $token);
        exit;
    }

    // Conectar a la base de datos
    $db = new Database();
    $con = $db->conectar();

    // Verificar si el token existe en la base de datos
    $sql = "SELECT * FROM users WHERE reset_token = :token";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':token', $token);

    if ($stmt->execute()) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Hash de la nueva contraseña
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Actualizar la contraseña y eliminar el token de reset
            $sql = "UPDATE users SET password = :password, reset_token = NULL WHERE id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $user['id']);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Contraseña restablecida con éxito. Ahora puedes iniciar sesión con tu nueva contraseña.";
                header('Location: recuperar_password.php');
                exit;
            } else {
                $_SESSION['error_message'] = "Error al actualizar la contraseña. Inténtalo nuevamente.";
                header('Location: reset_password.php?token=' . $token);
                exit;
            }
        } else {
            $_SESSION['error_message'] = "El token no es válido. Inténtalo nuevamente.";
            header('Location: reset_password.php?token=' . $token);
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Error al buscar el token en la base de datos. Inténtalo nuevamente.";
        header('Location: reset_password.php?token=' . $token);
        exit;
    }
} else {
    // Si se intenta acceder directamente a este archivo sin un POST válido, redirigir a la página de inicio o manejarlo de acuerdo a tus necesidades.
    header('Location: index.php');
    exit;
}