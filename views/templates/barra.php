<div class="barra">
    <!-- <p><strong><?php echo $nombreCompleto ?? ''; ?></strong></p>  -->
    <p><?php echo $nombreCompleto ?? ''; ?></p>
    <a href="/logout" class="boton">Cerrar Sesión</a>
</div>

<?php if (isset($_SESSION['admin'])) { ?>

    <div class="barra-servicios">
        <a class="boton" data-paso="1" href="/admin">Ver Citas</a>
        <a class="boton" data-paso="2" href="/servicios">Ver Servicios</a>
        <a class="boton" data-paso="3" href="/servicios/crear">Nuevo Servicio</a>
    </div>

<?php } ?>
