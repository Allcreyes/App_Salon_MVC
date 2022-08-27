<h1 class="nombre-pagina">Panel de Administración</h1>
<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<h2>Buscar citas</h2>
<div class="busqueda">
    <form class="formulario" action="">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" />
        </div>

    </form>
</div>

<?php
if (count($citas) === 0) {
    echo "<h4>No existen citas para la fecha seleccionada</h4>";
}
?>
<div id="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        foreach ($citas as $key => $cita) {
            if ($idCita !== $cita->id) {
                $total = 0;
        ?>

                <li>                    
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $cita->Cliente; ?></span></p>
                    <p>Correo: <span><?php echo $cita->email; ?></span></p>

                    <?php
                    if ($cita->telefono !== '') {
                    ?>
                        <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>
                    <?php
                    }
                    ?>

                    <h3>Servicios</h3>
                <?php
                $idCita = $cita->id;
            } //endif 
            $total += $cita->precio;
                ?>
                <p class="servicio"><?php echo $cita->Servicio . " $ " . $cita->precio; ?></p>
                <?php
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0;
                if (esUltimo($actual, $proximo)) { ?>
                    <p class="total">Total a pagar de los servicios solicitados: <span>$ <?php echo $total; ?></span></p>

                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">
                    </form>

                <?php
                }
                ?>
            <?php
        } //endforeach
            ?>

    </ul>
</div>

<?php
$script = "<script src='build/js/buscador.js'></script>";
?>