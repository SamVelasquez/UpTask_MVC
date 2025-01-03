
<div class="contenedor olvide">
    <?php
        include_once __DIR__ . '/../templates/nombre-sitio.php'
    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recuperar Cuenta</p>

        <?php
            include_once __DIR__ . '/../templates/alertas.php'
        ?>

        <form action="/olvide" class="formulario" method="POST">




            <div class="campo">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    placeholder="Tu Correo"
                    name="email"
                >

            </div>

            <input type="submit" class="boton" value="Enviar Instrucciones">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aun no tienes una Cuenta?</a>
            <a href="/">¿ya tienes una cuenta? Inicia Sesion</a>
        </div>
    </div><!--contenedor-sm-->
</div>