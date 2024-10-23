document.querySelectorAll('.deleteService').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Previene el envío del formulario

        Swal.fire({
            title: '¿Estas Seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Eliminar!',
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, envía el formulario
                this.submit();
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'El servicio ha sido eliminado.',
                    icon: 'success'
                });
            }
        });
    });
});