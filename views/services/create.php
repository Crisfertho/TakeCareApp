<h1 class="page-name">Nuevo Servicio</h1>
<p class="page-description">Llena los campos para crear un nuevo servicio.</p>

<?php 
    include_once __DIR__ . '/../templates/barr.php';
    include_once __DIR__ . '/../templates/alerts.php';
?>    

<form id="alertCreateS" action="/services/create" method="POST" class="form">
    <?php include_once __DIR__ . '/form.php'; ?>
    <input type="submit" class="button" value="Crear Servicio">
</form>


<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/build/js/createService.js'></script>
    ";
?>