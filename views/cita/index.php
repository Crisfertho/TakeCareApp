<h1 class="page-name">Crear Nueva Cita</h1>
<p class="page-description">Elige tus servicios y coloca tus datos</p>

<?php 
    include_once __DIR__ . '/../templates/barr.php';
?>

<div id="app">

    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información de Cita</button>
        <button type="button" data-paso="3">Resumen</button>

    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">A continuación elige tus servicios.</p>
        <div id="services" class="list-services"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Datos y Citas</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita.</p>

        <form class="form">
            <div class="field">
                <label for="name">Nombre:</label>
                <input
                    id="name"
                    type="text"
                    placeholder="Tu Nombre"
                    value="<?php echo $name; ?>"
                    disabled
                />
            </div>
            <div class="field">
                <label for="date">Fecha:</label>
                <input
                    id="date"
                    type="date"
                    min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                />
            </div>
            <div class="field">
                <label for="time">Hora:</label>
                <input
                    id="time"
                    type="time"
                />
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div id="paso-3" class="seccion resume-content">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea la correcta.</p>
    </div>

    <div class="paginacion">
        <button class="button"
            id="previous"
        >&laquo; Anterior</button>
        <button class="button"
            id="next"
            >Siguiente  &raquo;</button>
    </div>
</div>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>