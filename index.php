<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="svg/favicon.svg" type="image/x-icon">
    <title>Academix | Inicio</title>
</head>

<body>
    <?php require 'components/header_user.php'; ?>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima magnam laudantium iure? Eum similique praesentium fugit sed ea explicabo eaque porro nam, saepe cupiditate quae! Et aperiam suscipit aliquid temporibus.
        Quia et laboriosam incidunt eligendi sed! Odio corrupti, reprehenderit temporibus quisquam omnis blanditiis facere non, sapiente iste voluptates officia harum repellendus amet sit repudiandae commodi. Voluptatum cum iste quaerat animi?
        Obcaecati, odio! Quis, ea hic, aspernatur ratione doloribus at non est amet culpa quod, fugit perferendis atque earum fugiat ipsa? Sequi autem ducimus modi nobis cum tenetur quasi in deserunt.
        Odio quasi incidunt, nulla quibusdam vero neque quidem autem aut. Error iure adipisci ut dolor voluptate qui. Consectetur aliquid earum assumenda reprehenderit odit eius doloremque, excepturi quia harum unde facilis.
        Facilis, aperiam non? Saepe necessitatibus, quas libero nisi iure incidunt eum itaque quod reiciendis nulla ducimus quo repellendus excepturi, illo commodi, omnis magnam reprehenderit rem eos provident. Ipsa, beatae veniam!
        Eveniet neque sit, minus, assumenda esse vel error officiis sint placeat quae voluptates adipisci cumque, id dignissimos magnam at? Totam harum minima sit molestiae corporis, quasi aspernatur excepturi ducimus voluptates.
        Doloribus, exercitationem laudantium error reiciendis aperiam corrupti delectus rem sit sunt, molestias sed dolore. Laboriosam, ratione inventore voluptates enim porro optio sunt magnam commodi laborum non nesciunt quo repellat aut.
        Porro vero tempora assumenda, iusto, est ratione doloremque in voluptatem aut reiciendis vel commodi libero quos velit! Asperiores, optio esse perferendis corrupti voluptate similique enim, aut corporis minus ipsum sed.
        Omnis illum, et suscipit magnam reprehenderit, dicta iusto placeat corporis recusandae doloribus officia tempora fugit obcaecati accusamus non, delectus nostrum! Est velit saepe sequi neque, impedit corrupti quia atque minima?

    <div class="container mt-5">
        <h1 class="text-center">Testimonios</h1>
        <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                        <div class="card text-center" style="width: 18rem; background-color: #4549AB;">
                            <div class="center-image">
                                <img src="images/3.png" class="card-img-top" alt="Imagen 1" style="width: 90px; height: 90px;">
                            </div>
                            <div class="card-body">
                                <p class="card-text">"¡Excelente plataforma educativa en línea!"</p>
                                <p class="card-text"><strong>- Alejandra Pérez</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <div class="card text-center" style="width: 18rem; background-color: #4549AB;">
                            <div class="center-image">
                                <img src="images/4.png" class="card-img-top" alt="Imagen 1" style="width: 90px; height: 90px;">
                            </div>
                            <div class="card-body">
                                <p class="card-text">"Muy buena plataforma. ¡La recomiendo!"</p>
                                <p class="card-text"><strong>- María González</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <div class="card text-center" style="width: 18rem; background-color: #4549AB;">
                            <div class="center-image">
                                <img src="images/2.png" class="card-img-top" alt="Imagen 1" style="width: 90px; height: 90px;">
                            </div>
                            <div class="card-body">
                                <p class="card-text">"Aprendizaje de alta calidad, recomendada."</p>
                                <p class="card-text"><strong>- Carlos Rodríguez</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <div class="card text-center" style="width: 18rem; background-color: #4549AB;">
                            <div class="center-image">
                                <img src="images/1.png" class="card-img-top" alt="Imagen 1" style="width: 90px; height: 90px;">
                            </div>
                            <div class="card-body">
                                <p class="card-text">"Academix, mi mejor elección académica."</p>
                                <p class="card-text"><strong>- Carlos Rodríguez</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
    <br>
    <br>
    <style>
        /* Personaliza el color de los botones del carrusel */
        .carousel-control-prev,
        .carousel-control-next {
            background-color: transparent;
            border: none;
        }

        /* Personaliza el ícono de los botones del carrusel */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #4549AB;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            padding: 10px;
        }


        .carousel-control-prev-icon::before,
        .carousel-control-next-icon::before {
            content: '\2039';
            color: #fff;
            font-size: 24px;
        }

        .carousel-inner .card {
            background-color: #4549AB;
            color: #fff;
        }

        .center-image {
            margin-top: 10px;
        }
    </style>
    <?php require 'components/footer_user.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>