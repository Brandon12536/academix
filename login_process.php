<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'connection.php';
    $db = new Database();
    $con = $db->conectar();

    $email = $_POST['email']; // Cambiamos 'id' a 'email' para coincidir con el campo del formulario
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "Por favor, completa todos los campos.";
        header('Location: login.php');
        exit;
    }

    if (strlen($password) < 8 || !preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        $_SESSION['error_message'] = "La contraseña debe tener al menos 8 caracteres y contener números y letras.";
        header('Location: login.php');
        exit;
    }

    $sql = "SELECT * FROM users WHERE email = :email AND active = 1"; // Cambiamos 'id' a 'email' para coincidir con el campo de la base de datos

    $stmt = $con->prepare($sql);

    $stmt->bindParam(':email', $email); // Cambiamos ':id' a ':email' para coincidir con el parámetro

    $stmt->execute();

    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userInfo && password_verify($password, $userInfo['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $userInfo['id'];
        $_SESSION['role'] = $userInfo['role'];

        if ($userInfo['role'] === 'Estudiante') {
            header('Location: estudiante_panel.php');
            exit;
        } elseif ($userInfo['role'] === 'Docente') {
            header('Location: docente_panel.php');
            exit;
        } elseif ($userInfo['role'] === 'Administrador') {
            header('Location: admin_panel.php');
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Email o contraseña incorrectos. Inténtalo nuevamente.";

        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
?>
