<h1 class="page-name">Panel de Administración:</h1>

<?php 
    include_once __DIR__ . '/../templates/barr.php';
?>

<h2>Buscar Citas</h2>
<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Fecha:</label>
            <input
                type="date"
                id="date"
                name="date"
                value="<?php echo $date; ?>"
                
            />    
        </div>
    </form>
</div>

<?php 
    if(count($citas) === 0) {
        echo "<h2>No hay citas este día...</h2>";
    }
?>


<div id="admin-cita">
    <ul class="citas">
        <?php 
            $idCita = null;
            foreach($citas as $key => $cita) {
                if($idCita !== $cita->id) {

                    $idCita = $cita->id;
        ?>
        <li>
            <p>ID: <span><?php echo $cita->id; ?></span></p>
            <p>Día: <span><?php $dateFormatted = date("d/m/Y", strtotime($cita->date)); 
                echo $dateFormatted; ?></span></p>
            <p>Hora: <span><?php echo $cita->time; ?></span></p>
            <p>Cliente: <span><?php echo $cita->client; ?></span></p>
            <p>Correo Electrónico: <span><?php echo $cita->email; ?></span></p>
            <p>Telefóno: <span><?php echo $cita->phone; ?></span></p>

            
            <h3>Servicios</h3>
            <?php }//fin If 
                $total += $cita->price;
            ?>
        </li>
            
        <p class="service"><?php echo $cita->service . ":  " . "$".$cita->price; ?></p>
        <?php 
            $actual = $cita->id;
            $next = $citas[$key+1]->id ?? 0;

            if(isLast($actual, $next)) {
        ?>
            <p class="total">Total: <span>$ <?php echo $total; ?></span></p>  
            
            <form id="deleteCita" action="/api/delete" method="Post">
                <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                <input type="submit" class="deleteButton" value="Eliminar">
            </form>
        <?php }
        } //fin foreach ?>
    </ul>
</div>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/searcher.js'></script>
        <script src='build/js/deleteCita.js'></script>
    ";
?>