<h1 class="page-name">Servicios</h1>
<p class="page-description">Administración de Servicios</p>

<?php 
    include_once __DIR__ . '/../templates/barr.php';
?>    

<ul class="services">
    <?php foreach($services as $service) { ?>
        <li>
            <p>Nombre: <span><?php echo $service->name; ?></span></p>
            <p>Precio: <span>$<?php echo $service->price; ?></span></p>  

            <div class="actions">
                <a class="button" href="/services/update?id=<?php echo $service->id; ?>">Actualizar</a>
                <form class="deleteService" action="/services/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $service->id; ?>">
                    <input type="submit" value="Eliminar" class="deleteButton">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/deleteService.js'></script>
    ";
?>