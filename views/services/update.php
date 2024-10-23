<h1 class="page-name">Actualizar Servicio</h1>
<p class="page-description">Editar los valores del formulario</p>

<?php 
    include_once __DIR__ . '/../templates/barr.php';
    include_once __DIR__ . '/../templates/alerts.php';
?>    

<form id="alertUpdateS" method="POST" class="form">
    <?php include_once __DIR__ . '/form.php'; ?>
    <input type="submit" class="button" value="Actualizar Servicio">
</form> 

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/build/js/createService.js'></script>
    ";
?>