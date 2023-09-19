<?php
session_start();
require 'phpmailer/src/Exception.php';
require 'connection.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'config.php';

// Crear una instancia de la clase Database y establecer la conexión
$db = new Database();
$con = $db->conectar();

// Verificar si se ha enviado el formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $acceptTerms = isset($_POST['accept_terms']) ? 1 : 0; // Cambiar el nombre del campo a 'accept_terms'

  $role = 'Estudiante'; // Establecer el rol como 'Estudiante'

  // Validar los campos
  if (empty($name) || empty($email) || empty($password) || empty($phone)) {
    $_SESSION['error_message'] = "Por favor, completa todos los campos.";
    header('Location: registro.php');
    exit;
  }

  // Validar el formato del email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_message'] = "El email no es válido.";
    header('Location: registro.php');
    exit;
  }

  // Validar la contraseña
  if (strlen($password) < 8 || !preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
    $_SESSION['error_message'] = "La contraseña debe tener al menos 8 caracteres y contener números y letras.";
    header('Location: registro.php');
    exit;
  }

  // Validar el número de teléfono
  if (!is_numeric($phone) || strlen($phone) !== 10) {
    $_SESSION['error_message'] = "El número de teléfono debe ser un valor numérico de 10 dígitos.";
    header('Location: registro.php');
    exit;
  }

  // Cifrar la contraseña
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Consulta SQL para insertar los datos en la tabla 'users'
  $sql = "INSERT INTO users (name, email, password, role, phone, accept_terms, active, activation_token) VALUES (:name, :email, :password, :role, :phone, :acceptTerms, 0, :activationToken)";

  // Generar un token de activación
  $activationToken = bin2hex(random_bytes(32));

  // Preparar la consulta
  $stmt = $con->prepare($sql);

  // Asignar los valores a los parámetros
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $hashedPassword);
  $stmt->bindParam(':role', $role);
  $stmt->bindParam(':phone', $phone);
  $stmt->bindParam(':acceptTerms', $acceptTerms, PDO::PARAM_INT);
  $stmt->bindParam(':activationToken', $activationToken);

  // Ejecutar la consulta
  if ($stmt->execute()) {
    // Configuración de PHPMailer para enviar el correo electrónico
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
    //$mail->SMTPDebug = 2; // Habilita la depuración
    //$mail->Debugoutput = 'html'; // Muestra la salida de depuración en formato HTML
    
    // Configurar el asunto y el cuerpo del correo
    $mail->Subject = 'Activación de cuenta en Academix';
    $mail->Body = '¡Gracias por registrarte en Academix! Para activar tu cuenta, haz clic en el siguiente enlace: http://localhost/academix/activar.php?token=' . $activationToken;

    // Enviar el correo electrónico
    if ($mail->send()) {
      $_SESSION['success_message'] = "Te enviamos un correo para que actives tu cuenta.";
      header('Location: registro.php');
      exit;
  } else {
      // Si no se pudo enviar el correo, muestra un mensaje de error
      if (isset($_SESSION['error_details'])) {
          echo "Detalles del error: " . $_SESSION['error_details'];
          unset($_SESSION['error_details']); // Limpiar los detalles del error
      }
  }
  } else {
    // Si ocurre un error en la inserción, muestra un mensaje de error
    $_SESSION['error_message'] = "Error en la inserción. Inténtalo nuevamente.";
    header('Location: registro.php');
    exit;
  }
} else {
  // Si no se ha enviado el formulario de registro, redirigir al formulario de registro
  header('Location: registro.php');
  exit;
}
?>
