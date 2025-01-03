
<div class="contenedor crear">
    <?php
        include_once __DIR__ . '/../templates/nombre-sitio.php'
    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en Uptask</p>

        <?php
            include_once __DIR__ . '/../templates/alertas.php'
         ?>

        <form action="/crear" class="formulario" method="POST">

            <div class="campo">
                    <label for="nombre">Nombre</label>

                    <input
                        type="text"
                        id="nombre"
                        placeholder="Tu Nombre"
                        name="nombre"
                        value="<?php echo $usuario -> nombre; ?>"
                    >

            </div>

            <div class="campo">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    placeholder="Tu Correo"
                    name="email"
                    value="<?php echo $usuario -> email; ?>"
                >

            </div>

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


            <input type="submit" class="boton" value="Crear Cuenta">


        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una Cuneta? Inicia Sesion</a>
            <a href="/olvide">¿Olvidaste tu Password?</a>
        </div>
    </div><!--contenedor-sm-->
</div>