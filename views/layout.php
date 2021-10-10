<?php

if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;

if (!isset($inicio)) {
    $inicio = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/public">
                    <img src="/../public/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/../public/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/../public/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/public/nosotros">Nosotros</a>
                        <a href="/public/anuncios">Anuncios</a>
                        <a href="/public/blog">Blog</a>
                        <a href="/public/contacto">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="/public/admin">Administrador</a>
                            <a href="/public/logout">Cerrar sesion</a>
                        <?php elseif (!$auth) : ?>
                            <a href="/public/login">Iniciar sesion</a>
                        <?php endif ?>
                    </nav>
                </div>

            </div>
            <!--.barra-->
            <?php
            if ($inicio) {
                echo "<h1 data-cy='heading-sitio'>Venta de Casas y Deparatementos Exclusivos de Lujo</h1>";
            }

            ?>

        </div>
    </header>


    <?php echo $contenido ?>




    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/public/nosotros">Nosotros</a>
                <a href="/public/anuncios">Anuncios</a>
                <a href="/public/blog">Blog</a>
                <a href="/public/contacto">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados 2021 &copy;</p>
    </footer>

    <script src="/public/build/js/bundle.min.js"></script>
</body>

</html>