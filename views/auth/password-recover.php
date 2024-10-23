<h1 class="page-name">Recuperar Contraseña</h1>
<p class="description-name">A continuación escribe tu nueva contraseña:</p>

<?php
    include_once __DIR__ . "/../templates/alerts.php";
?>

<?php if($error) return; ?>

<form class="form" method="POST">
    <div class="field">
        <label for="password">Contraseña</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Nueva Contraseña"
        />    
    </div>
    <input type="submit" class="button" value="Confirmar Contraseña">
</form>

<div class="actions">
    <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
    <a href="/register">¿Aún no tienes cuenta? Crear una.</a>
</div>