<main class="contenedor seccion contenido-centrado">
        <h1>INICIAR SESIÓN</h1>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php  endforeach ?>

    <form class="formulario " method="POST" action="/public/login">

    <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Email</label>
                <input type="email" placeholder="Tu Email" id="email" name="email" require>

                <label for="password">Password</label>
                <input type="password" placeholder="Tu Password" id="password" name="password" require>

                <input type="submit" value="Iniciar secion" class="boton boton-verde">

                
            </fieldset>

    </form>

    </main>