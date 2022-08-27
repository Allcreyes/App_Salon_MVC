<h1 class="nombre-pagina">Reestablecer Contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña a continuación</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";
?>
<?php if ($error) return; ?>
<form method="POST" class="formulario">
    <div class="campo">
        <label for="contrasena">Nueva Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Nueva contraseña" />
    </div>
    <input type="submit" class="boton" value="Enviar y reestablecer">
</form>

<div class="acciones">
    <a data-cy="enlace-crear" href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a data-cy="enlace-olvide" href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>