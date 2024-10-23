<div class="barr">
    <p class="hello">Hola:<span> <?php echo $name ?? ''; ?> </span></p>

    <a class="button" href="/logout">Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>
    <div class="servicesBar">
        <a class="button" href="/admin">Ver Citas</a>
        <a class="button" href="/services">Ver Servicios</a>
        <a class="button" href="/services/create">Nuevo Servicio</a>
    </div>
<?php } ?>