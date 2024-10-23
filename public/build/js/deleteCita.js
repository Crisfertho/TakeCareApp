document.getElementById('deleteCita').addEventListener('submit', function(event) {
     event.preventDefault(); // Evita que el formulario se envíe automáticamente
    
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "¡Eliminado!",
                text: "La cita ha sido eliminada.",
                icon: "success"
            }).then(() => {
                // Envía el formulario después de la confirmación
                event.target.submit();
            });
        }
    });
});