<h1 class="nombre-pagina">Estética SHERLYN</h1>
<p class="domicilio">Calle Clavelina Mz.17 Lt.15, Iztapalapa, CDMX </p>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<!-- <p class="descripcion-pagina">Elije tus servicios y coloca tu datos para crear tu cita</p> -->


<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div class="seccion" id="paso-1">

        <p class="text-center">Elije tus servicios</p>
        <div class="listado-Servicios" id="servicios">

        </div>
    </div>


    <div class="seccion" id="paso-2">

        <p class="text-center">Indícanos la fecha y hora de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombreCompleto" placeholder="Tu nombre" value="<?php echo $nombreCompleto ?>" readonly disabled />
            </div>
            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" />
            </div>
            <div class="campo">
                <label for="hora">Hora:</label>
                <input type="time" id="hora" />
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>


    <div class="seccion contenido-resumen" id="paso-3">

        <p class="text-center">Verifica que la información es correcta</p>
    </div>

    <div class="paginacion">
        <button class="boton" id="anterior">&laquo; Anterior
        </button>
        <button class="boton" id="siguiente">Siguiente &raquo;
        </button>
    </div>

</div>

<?php
$script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    "
?>