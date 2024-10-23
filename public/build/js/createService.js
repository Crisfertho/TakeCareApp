document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('alertCreateS');

    form.addEventListener('submit', function(e) {
        // Prevenir el envío del formulario
        e.preventDefault();

        // Mostrar la alerta de éxito
        Swal.fire({
            icon: 'success',
            title: 'OK',
            text: '¡Servicio agregado con éxito!'
        }).then((result) => {
            // Verifica si el usuario presionó "OK"
            if (result.isConfirmed) {
                // Ahora sí envía el formulario
                this.submit();
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('alertUpdateS');

    form.addEventListener('submit', function(e) {
        // Prevenir el envío del formulario
        e.preventDefault();

        // Mostrar la alerta de éxito
        Swal.fire({
            icon: 'success',
            title: 'OK',
            text: '¡Servicio actualizado con éxito!'
        }).then((result) => {
            // Verifica si el usuario presionó "OK"
            if (result.isConfirmed) {
                // Ahora sí envía el formulario
                this.submit();
            }
        });
    });
});