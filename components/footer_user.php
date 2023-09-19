<footer class="footer py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Contacto</h5>
                <p>Correo: <a href="mailto:contacto@ejemplo.com">contacto@ejemplo.com</a></p>
                <p>Teléfono: <a href="tel:+123456789">+123 456 789</a></p>
            </div>
            <div class="col-md-4">
                <h5>Enlaces útiles</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Acerca de nosotros</a></li>
                    <li><a href="#">Servicios</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Síguenos</h5>
                <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
            </div>
        </div>
    </div>
</footer>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700;800&display=swap');

    body {
        position: relative;
        min-height: 100vh;
    }

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

    .footer {
    background-color: #4549AB;
    color: #FFFFFF;
    font-family: 'Poppins', sans-serif;
    padding-top: 20px;
    padding-bottom: 20px;
}

.footer a {
    color: #FFFFFF;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

@media (max-width: 767px) {
    .footer {
        text-align: center;
    }
}

</style>