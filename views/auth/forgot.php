<h1 class="page-name">Olvide Contraseña</h1>
<p class="page-description">Restablece tu contraseña. Escribe tu email.</p>

<?php
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form class="form" method="POST" action="/forgot">
    <div class="field">
        <label for="email">Email</label>
        <input type="email"
            id="email"
            placeholder="Tu Correo Electrónico"
            name="email"
        />   
    </div>

    <input type="submit" class="button" value="Enviar">
</form>

<div class="actions">
<a href="/">Ya tienes una cuenta. Inicia Sesión</a>
<a href="/register">¿Aún no tienes cuenta? Crear una!</a>
</div>