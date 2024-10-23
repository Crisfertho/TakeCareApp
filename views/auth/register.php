<h1 class="page-name">Crear Cuenta</h1>
<p class="page-description">Llena el siguiente formulario para crear una cuenta.</p>

<?php
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form class="form" method="POST" action="/register">
<div class="field">
        <label for="name">Nombre: </label>
        <input type="text"
            id="name"
            placeholder="Tu Nombre"
            name="name"
            value="<?php echo s($user->name); ?>"
        />   
    </div>
    <div class="field">
        <label for="lastname">Apellido: </label>
        <input type="text"
            id="lastname"
            placeholder="Tu Apellido"
            name="lastname"
            value="<?php echo s($user->lastname); ?>"
        />   
    </div>
    <div class="field">
        <label for="phone">Teléfono: </label>
        <input type="tel"
            id="phone"
            placeholder="Tu Teléfono"
            name="phone"
            value="<?php echo s($user->$phone); ?>"
        />   
    </div>
    <div class="field">
        <label for="email">Correo Electrónico: </label>
        <input type="email"
            id="email"
            placeholder="Tu Correo Electrónico"
            name="email"
            value="<?php echo s($user->email);?>"
        />   
    </div>
    <div class="field">
        <label for="password">Contraseña: </label>
        <input type="password"
            id="password"
            placeholder="Tu Contraseña"
            name="password"
        />   
    </div>

    <input type="submit" class="button" value="Crear Cuenta">

</form>

<div class="actions">
<a href="/">Ya tienes una cuenta. Inicia Sesión</a>
<a href="/forgot">¿Olvidaste tu contraseña?</a>
</div>