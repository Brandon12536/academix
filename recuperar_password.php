<?php
session_start();
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Verificar si el correo electrónico existe en la base de datos
    $db = new Database();
    $con = $db->conectar();

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generar un token de restablecimiento de contraseña
            $resetToken = bin2hex(random_bytes(32));

            // Actualizar el token de restablecimiento en la base de datos
            $sql = "UPDATE users SET reset_token = :resetToken WHERE email = :email";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':resetToken', $resetToken);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                // Configurar PHPMailer para enviar el correo electrónico
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
                $mail->Port = 587;
                $mail->Username = 'bp754509@gmail.com'; // Tu dirección de correo Gmail
                $mail->Password = 'qkse ycth akvp iqpa'; // Tu contraseña de Gmail

                // Establecer el correo remitente y destinatario
                $mail->setFrom('bp754509@gmail.com', 'Academix');
                $mail->addAddress($email);

                // Configurar el asunto y el cuerpo del correo
                $mail->Subject = 'Restablecimiento de contraseña en Academix';
                $resetLink = 'http://localhost/academix/reset_password.php?token=' . $resetToken;
                $mail->Body = 'Para restablecer tu contraseña, haz clic en el siguiente enlace: ' . $resetLink;

                // Enviar el correo electrónico
                if ($mail->send()) {
                    $_SESSION['success_message'] = "Hemos enviado un correo electrónico con instrucciones para restablecer tu contraseña.";
                    header('Location: login.php');
                    exit;
                } else {
                    $_SESSION['error_message'] = "No se pudo enviar el correo electrónico. Inténtalo nuevamente.";
                }
            } else {
                $_SESSION['error_message'] = "Error al actualizar el token de restablecimiento. Inténtalo nuevamente.";
            }
        } else {
            $_SESSION['error_message'] = "El correo electrónico no existe en nuestra base de datos.";
        }
    } else {
        $_SESSION['error_message'] = "Error al buscar el correo electrónico en la base de datos. Inténtalo nuevamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="shortcut icon" href="svg/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/recupera_password.css">
    <link rel="stylesheet" href="css/registro.css">
    <title>Academix | Recuperar Contraseña</title>
</head>

<body>
    <?php require 'components/header_user.php'; ?>
    <div class="form_container">
        <form class="form_main" action="recuperar_password.php" method="POST">
            <p class="heading">Recuperar Contraseña</p>

            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<p class="error-message" style="text-align: center;">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            } elseif (isset($_SESSION['success_message'])) {
                echo '<p class="success-message" style="text-align: center;">' . $_SESSION['success_message'] . '</p>';
                unset($_SESSION['success_message']);
            }
            ?>

            <div class="inputContainer">
                <svg viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="inputIcon">
                    <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c">
                    </path>
                </svg>
                <input placeholder="Email" id="email" class="inputField" type="email" name="email">
            </div>

            <button id="button" type="submit" class="btn btn-primary">Enviar Correo de Recuperación</button>

            <div class="backToLogin">
                <a href="login.php" class="inicia-sesion">Volver a Iniciar Sesión</a>
            </div>
        </form>
    </div>

    <?php require 'components/footer_user.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>