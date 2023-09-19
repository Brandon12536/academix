<?php
//require 'connection.php'; // Asegúrate de incluir el archivo de conexión a la base de datos
//session_start();
// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['id'])) {
  $userID = $_SESSION['id'];

  // Conecta a la base de datos si aún no está conectada
  if (!isset($con)) {
    $db = new Database();
    $con = $db->conectar();
  }

  // Prepara la consulta SQL para obtener los datos del usuario
  $sql = "SELECT name, avatar_url, phone FROM users WHERE id = :id";
$statement = $con->prepare($sql);
$statement->bindParam(':id', $userID, PDO::PARAM_INT);

  
  // Ejecuta la consulta SQL
  if ($statement->execute()) {
    $usuario = $statement->fetch(PDO::FETCH_ASSOC);
  } else {
    echo "Error en la ejecución de la consulta SQL.";
  }
} else {
  echo "El usuario no ha iniciado sesión."; // Puedes redirigir o manejar esto de acuerdo a tu lógica de autenticación
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
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="css/social_media.css">
  <title>Academix | Perfil de usuario</title>
</head>

<body>
  <style>
    #perfil-container {
      display: none;
    }
  </style>
  <script>
    function mostrarPerfil() {
      var perfilContainer = document.getElementById("perfil-container");
      perfilContainer.style.display = "block";
    }

    function guardarCambios() {
      // Agrega aquí el código para guardar los cambios del usuario en la base de datos
      alert("Cambios guardados");
    }
  </script>
  </head>

  <body>
    <?php require 'components/header_user_home.php' ?>
<br>
<br>
<br>
<br>


    <section style="background-color: #eee;">
      <div class="container py-5">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="user_panel.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="profile_user.php">Usuario</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perfil de usuario</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card mb-4">
              <div class="card-body text-center">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
                  <?php if (!empty($userInfo['avatar_url'])) { ?>
                    <img src="<?php echo $userInfo['avatar_url']; ?>" class="rounded-circle" width="100" height="160"
                      alt="<?php echo $usuario['name']; ?>" loading="lazy" />
                  <?php } else { ?>
                    <p>Usted no ha subido una foto</p>
                  <?php } ?>


                  <h5 class="my-3">
                    <?php echo $_SESSION['id']; ?>
                  </h5>
                  <p class="text-muted mb-1"><b>Rol:</b>
                    <?php echo $_SESSION['role']; ?>
                  </p>
                  <!--<p class="text-muted mb-4">Bay Area, San Francisco, CA</p>-->
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-primary">
                      <a href="setup.php" style="color: white; text-decoration: none;">Editar</a>
                    </button><br>
                    <button type="button" class="btn btn-outline-primary ms-1">Mensaje</button>
                  </div>
                <?php } else { ?>
                  <p>No se ha iniciado sesión</p>
                <?php } ?>
              </div>
            </div>
            <?php
            $query = "SELECT * FROM users WHERE id = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':id', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Obtén la fila del resultado como un arreglo asociativo
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Cierra la conexión a la base de datos
            $con = null;
            ?>

            <div class="card mb-4 mb-lg-0">
              <div class="card-body p-0">
                <ul class="list-group list-group-flush rounded-3">
                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fas fa-globe fa-lg text-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if (!empty($user['website'])): ?>
                      <p class="mb-0 website-text">
                        <a href="<?php echo htmlspecialchars($user['website']); ?>" target="_blank"><?php echo htmlspecialchars($user['website']); ?></a>
                      </p>
                    <?php else: ?>
                      <p class="mb-0">No se ha agregado un enlace del sitio web.</p>
                    <?php endif; ?>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fab fa-github fa-lg" style="color: #333333;"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if (!empty($user['github'])): ?>
                      <p class="mb-0 github-text">
                        <a href="<?php echo htmlspecialchars($user['github']); ?>" target="_blank"><?php echo htmlspecialchars($user['github']); ?></a>
                      </p>
                    <?php else: ?>
                      <p class="mb-0">No se ha agregado un enlace de GitHub.</p>
                    <?php endif; ?>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if (!empty($user['twitter'])): ?>
                      <p class="mb-0 twitter-text">
                        <a href="<?php echo htmlspecialchars($user['twitter']); ?>" target="_blank"><?php echo htmlspecialchars($user['twitter']); ?></a>
                      </p>
                    <?php else: ?>
                      <p class="mb-0">No se ha agregado un enlace de Twitter.</p>
                    <?php endif; ?>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if (!empty($user['instagram'])): ?>
                      <p class="mb-0 instagram-text">
                        <a href="<?php echo htmlspecialchars($user['instagram']); ?>" target="_blank"><?php echo htmlspecialchars($user['instagram']); ?></a>
                      </p>
                    <?php else: ?>
                      <p class="mb-0">No se ha agregado un enlace de Instagram.</p>
                    <?php endif; ?>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if (!empty($user['facebook'])): ?>
                      <p class="mb-0 facebook-text">
                        <a href="<?php echo htmlspecialchars($user['facebook']); ?>" target="_blank"><?php echo htmlspecialchars($user['facebook']); ?></a>
                      </p>
                    <?php else: ?>
                      <p class="mb-0">No se ha agregado un enlace de Facebook.</p>
                    <?php endif; ?>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fab fa-linkedin-in fa-lg" style="color: #0e76a8;"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if (!empty($user['linkedin'])): ?>
                      <p class="mb-0 linkedin-text">
                        <a href="<?php echo htmlspecialchars($user['linkedin']); ?>" target="_blank"><?php echo htmlspecialchars($user['linkedin']); ?></a>
                      </p>
                    <?php else: ?>
                      <p class="mb-0">No se ha agregado un enlace de LinkedIn.</p>
                    <?php endif; ?>
                  </li>

                  <li class="list-group-item d-flex justify-content-center p-3">
                    <a href="social_media.php" class="btn btn-primary">
                      <i class="fas fa-edit"></i> Editar Redes Sociales
                    </a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Información personal</p>
                  </div>
                  <!--<div class="col-sm-9">
                  <p class="text-muted mb-0">nombre</p>
                  </div>-->
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Correo</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                      <?php echo $_SESSION['email']; ?>
                    </p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Rol</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                      <?php echo $_SESSION['role']; ?>
                    </p>
                  </div>
                </div>
                <hr>
                <!--<div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Mobile</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">(098) 765-4321</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Address</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                  </div>
                </div>-->
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4 mb-md-0">
                  <div class="card-body">
                    <p class="mb-4"><span class="text-primary font-italic me-1">assignament</span> projects
                    </p>
                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                    <div class="progress rounded mb-2" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card mb-4 mb-md-0">
                  <div class="card-body">
                    <p class="mb-4"><span class="text-primary font-italic me-1">assignament</span> projects
                    </p>
                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                    <div class="progress rounded mb-2" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

    <script>
      window.addEventListener("DOMContentLoaded", function () {
        // Muestra el perfil cuando se carga la página
        mostrarPerfil();
      });
    </script>
    <?php require 'components/footer_user_panel.php' ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
  </body>

</html>