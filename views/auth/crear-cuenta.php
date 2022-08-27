<h1 data-cy="heading-cuenta" class="nombre-pagina">Estética SHERLYN</h1>
<p class="descripcion-pagina">LLena el formulario para crear tu cuenta</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="fomulario" method="POST" action="/crear-cuenta">

    <fieldset>
        <legend>Información General</legend>
        <div class="campo">
            <label for="aPaterno">A. Paterno:</label>
            <input type="text" name="aPaterno" id="aPaterno" placeholder="A. Paterno" value="<?php echo s($usuario->aPaterno); ?>" />
        </div>

        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre(s)" value="<?php echo s($usuario->nombre); ?>" />
        </div>

        <div class="campo">
            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono" id="telefono" placeholder="Teléfono" maxlength="13" title="El número telefónico debe constar de 10 dígitos" value="<?php echo s($usuario->telefono); ?>" />
        </div>

        <div class="campo">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" placeholder="Correo Electrónico" value="<?php echo s($usuario->email); ?>" />
        </div>

        <div class="campo">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo s($usuario->usuario); ?>" />
        </div>

        <div class="campo">
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" />

        </div>

        <input type="submit" value="Crear Cuenta" class="boton">

    </fieldset>
</form>

<div class="acciones">

    <a data-cy="enlace-crear" href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a data-cy="enlace-olvide" href="/olvide">Olvidaste tu contraseña?</a>

</div>