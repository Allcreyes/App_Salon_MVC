<h1 data-cy="iniciar-sesion" class="nombre-pagina">Estética SHERLYN</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";
?>

<form data-cy="form-login" class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Correo : </label>
        <input data-cy="input-email" id="email" name="email" type="text" placeholder="Correo electrónico">
    </div>

    <div class="campo">
        <label for="contrasena">Contraseña : </label>
        <input data-cy="input-contrasena" id="contrasena" name="contrasena" type="password" placeholder="Introduce tu contraseña">
    </div>

    <input type="submit" class="boton" value="Iniciar">

</form>

<div class="acciones">
    <a data-cy="enlace-olvide" href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
    <a data-cy="enlace-olvide" href="/olvide">Olvidaste tu contraseña?</a>
</div>