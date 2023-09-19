<?php
session_start();
require 'connection.php';

// Verifica si el usuario ha iniciado sesión (debes tener tu propia lógica de autenticación)
if (isset($_SESSION['id'])) {
  // Obtiene el ID del usuario desde la sesión
  $id = $_SESSION['id'];

  // Conecta a la base de datos
  $db = new Database();
  $con = $db->conectar();

  // Prepara la consulta SQL para obtener el nombre del usuario y la ruta de la imagen
  $sql = "SELECT name, avatar_url FROM users WHERE id = :id";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':id', $id);

  // Ejecuta la consulta SQL
  if ($stmt->execute()) {
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userData) {
      // Obtiene el nombre de usuario
      $userName = $userData['name'];

      // Obtiene la ruta de la imagen personalizada del usuario o usa la imagen por defecto si no tiene
      $defaultProfileImage = 'images/profile.png'; // Ruta de la imagen por defecto
      $userImage = isset($userData['avatar_url']) ? $userData['avatar_url'] : $defaultProfileImage;
    } else {
      echo "No se encontraron datos para el usuario.";
    }
  } else {
    echo "Error en la ejecución de la consulta SQL.";
  }
} else {
  echo "El usuario no ha iniciado sesión."; // Puedes redirigir o manejar esto de acuerdo a tu lógica de autenticación
}
?>

<nav class="navbar navbar-expand-lg custom-navbar fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="estudiante_panel.php">
      <img src="images/logo.png" alt="Logo" width="100" height="100">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Mi horario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Materias</a>
        </li>
        <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>-->
      </ul>
    </div>

    <!-- Dropdown de usuario (a la derecha) -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo $userImage; ?>" alt="Foto de perfil" width="42" height="42" class="rounded-circle">
          <?php
          if (isset($userName)) {
            echo $userName;
          } else {
            echo 'Usuario';
          }
          ?>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="profile.php">Perfil</a></li>
          <li><a class="dropdown-item" href="#">Configuración</a></li>
          <li><a class="dropdown-item" href="#">Ayuda</a></li>
          <li><a class="dropdown-item" href="#">Eliminar cuenta</a></li
          <li class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#" onclick="confirmLogout()">Cerrar Sesión</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<style>
  .custom-navbar {
    background-color: #4549AB;
  }

  .navbar {
    padding-top: 5px;
    padding-bottom: 5px;
  }

  .navbar-brand img {
    width: 100px;
    height: 100px;
  }

  .navbar-nav .nav-link {
    color: #FFFFFF;
  }

  /* Cambia el color de fondo del menú desplegable */
  .dropdown-menu {
    background-color: #4549AB;

  }

  /* Cambia el color del texto dentro del menú desplegable a blanco */
  .dropdown-menu a {
    color: #4549AB;
    color: white;
  }

  /* Cambia el color del texto de los elementos activos/hover dentro del menú desplegable */
  .dropdown-menu a:hover,
  .dropdown-menu a:focus {
    color: #FFFFFF;
    color: black;
  }
</style>
<script>
  function confirmLogout() {
    Swal.fire({
      title: '¿Estás seguro?',
      text: '¿Quieres cerrar la sesión?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, cerrar sesión',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirige al usuario a la página de cierre de sesión si confirma
        window.location.href = 'logout.php';
      }
    });
  }
</script>