<?php
session_start();
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
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/registro.css">
    <title>Academix | Registro</title>
</head>

<body>
    <?php require 'components/header_user.php'; ?>
    <div class="form_container">
        <form class="form_main" action="register_process.php" method="POST">
            <p class="heading">Registro</p>

            <?php
            if (isset($_SESSION['error_message'])) {
                echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '" . $_SESSION['error_message'] . "',
                confirmButtonText: 'Aceptar'
            });
        </script>";
                unset($_SESSION['error_message']); // Limpia la variable de sesión después de mostrar la alerta
            }

            if (isset($_SESSION['success_message'])) {
                echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '" . $_SESSION['success_message'] . "',
                confirmButtonText: 'Aceptar'
            });
        </script>";
                unset($_SESSION['success_message']); // Limpia la variable de sesión después de mostrar la alerta
            }
            ?>
            <div class="inputContainer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2e2e2e" class="inputIcon" viewBox="0 0 16 16">
                    <path d="M8 0a4 4 0 0 0-4 4 4 4 0 0 0 4 4 4 4 0 0 0 4-4 4 4 0 0 0-4-4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                    <path d="M8 16c-1.34 0-2.61-.267-3.768-.754-2.124-.838-4.137-2.368-5.592-4.718-.36-.465-.425-1.053-.17-1.58.255-.526.82-.879 1.476-.879h13.146c.655 0 1.221.352 1.476.878.255.526.19 1.115-.17 1.58-1.455 2.35-3.468 3.88-5.592 4.718C10.61 15.733 9.34 16 8 16zm-3.477-1.342C4.388 13.145 6.163 14 8 14s3.612-.855 3.477-1.342C11.257 11.957 9.403 11 8 11s-3.257.956-3.477 1.658zM9 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                </svg>




                <input placeholder="Nombre y Apellidos" id="name" class="inputField" type="text" name="name">
            </div>

            <div class="inputContainer">
                <svg viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="inputIcon">
                    <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c">
                    </path>
                </svg>
                <input placeholder="Email" id="email" class="inputField" type="email" name="email">
            </div>

            <div class="inputContainer">
                <svg viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="inputIcon">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                </svg>
                <input placeholder="Contraseña" id="password" class="inputField" type="password" name="password">
                <span class="show-password" onclick="togglePasswordVisibility()">&#128065;</span>
            </div>

            <div class="inputContainer">
                <svg viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="inputIcon">
                    <path d="M8.26 1.289l-1.564.772c-5.793 3.02 2.798 20.944 9.31 20.944.46 0 .904-.094 1.317-.284l1.542-.755-2.898-5.594-1.54.754c-.181.087-.384.134-.597.134-2.561 0-6.841-8.204-4.241-9.596l1.546-.763-2.875-5.612zm7.746 22.711c-5.68 0-12.221-11.114-12.221-17.832 0-2.419.833-4.146 2.457-4.992l2.382-1.176 3.857 7.347-2.437 1.201c-1.439.772 2.409 8.424 3.956 7.68l2.399-1.179 3.816 7.36s-2.36 1.162-2.476 1.215c-.547.251-1.129.376-1.733.376" />
                </svg>
                <input placeholder="Teléfono" id="phone" class="inputField" type="text" name="phone">
            </div>


            <div class="inputContainer">
                <input type="checkbox" id="acceptTerms" name="accept_terms">
                <label for="acceptTerms">Acepto términos y condiciones</label>
                <a href="error_page.php" target="_blank" class="terminos">Leer términos y condiciones</a>
            </div>


            <button id="button" type="submit" class="btn-resgistrate-form">Registrarse</button>
        </form>
    </div>

    <?php require 'components/footer_user.php'; ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="js/main.js"></script>
</body>

</html>