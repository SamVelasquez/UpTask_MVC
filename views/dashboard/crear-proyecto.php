<?php
    include_once __DIR__ . '/header-dashboard.php'
?>
    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form  method="POST" class="formulario">
           
            <?php include_once __DIR__ . '/formulario.php' ?> 
            
            <input type="submit" value="Subir proyecto">
        </form>
    </div>

<?php
    include_once __DIR__ . '/footer-dashboard.php'
?>