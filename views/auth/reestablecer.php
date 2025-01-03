<div class="contenedor reestablecer">
    <?php
        include_once __DIR__ . '/../templates/nombre-sitio.php'
    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Reestablece Contraseña</p>

        <?php
            include_once __DIR__ . '/../templates/alertas.php'
        ?>

        <?php if ($mostrar){ ?>

            <form  class="formulario" method="POST">

                <div class="campo">
                        <label for="password">Contraseña</label>

                        <input
                            type="password"
                            id="password"
                            placeholder="Contraseña"
                            name="password"
                        >

                    </div>

                    <div class="campo">
                        <label for="password2">Repite tu Contraseña</label>

                        <input
                            type="password"
                            id="password2"
                            placeholder="Repite tu Contraseña"
                            name="password2"
                        >

                    </div>

                <input type="submit" class="boton" value="Guardar Password">
            </form>
        <?php }?>
        
        <div class="acciones">
            <a href="/crear">¿Aun no tienes una Cuenta?</a>
            <a href="/">¿ya tienes una cuenta? Inicia Sesion</a>
        </div>
    </div><!--contenedor-sm-->
</div>