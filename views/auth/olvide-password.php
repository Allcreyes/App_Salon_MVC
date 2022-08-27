<h1 class="nombre-pagina">Estética SHERLYN</h1>
<p class="descripcion-pagina">Introduce tu correo para restablecer tu contraseña</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" action="/olvide" method="POST">

    <div class="campo">
        <label for="email">Correo :</label>
        <input type="email" name="email" id="email" placeholder="Correo Electrónico" />
    </div>

    <input type="submit" value="Enviar instrucciones" class="boton">
</form>

<div class="acciones">

    <a data-cy="enlace-crear" href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a data-cy="enlace-olvide" href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>

</div>