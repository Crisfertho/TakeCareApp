
<h1 class="page-name">Iniciar Sesión.</h1>

<?php
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form class="form" method="POST" action="/">
    <div class="field">
        <label for="email">Email</label>
        <input type="email"
            id="email"
            placeholder="Tu Correo Electrónico"
            name="email"
        />   
    </div>
    <div class="field">
        <label for="password">Contraseña</label>
        <input type="password"
            id="password"
            placeholder="Tu Contraseña"
            name="password"
        />   
    </div>

    <input type="submit" class="button" value="Iniciar Sesión">
</form>

<div class="actions">
<a href="/register">¿Aún no tienes cuenta? Crear una!</a>
<a href="/forgot">¿Olvidaste tu contraseña?</a>
</div>