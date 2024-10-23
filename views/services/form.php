<div class="field">
    <label for="name">Nombre:</label>
    <input 
        type="text"
        id="name"
        placeholder="Nombre de Servicio"
        name="name"
        value="<?php echo $service->name; ?>"
    />
</div>

<div class="field">
    <label for="price">Precio:</label>
    <input 
        type="number"
        id="price"
        placeholder="Precio de Servicio"
        name="price"
        value="<?php echo $service->price; ?>"
    />
</div>