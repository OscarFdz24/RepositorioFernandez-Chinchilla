document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los enlaces con la clase 'deleteLink'
    const deleteLinks = document.querySelectorAll('.deleteLink');

    // Agregar un event listener a cada enlace
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evitar la acción predeterminada del enlace

            // Obtener el ID del entrenamiento desde el atributo 'data-entrenamiento-id'
            const idEntrenamiento = link.getAttribute('data-entrenamiento-id');

            // Realizar una solicitud de eliminación mediante AJAX
            fetch('index.php?accion=eliminarEntrenamiento&id=' + idEntrenamiento)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo eliminar el entrenamiento.');
                }
                // Eliminación exitosa, actualizar la interfaz de usuario
                const entrenamientoCard = link.closest('.card');
                entrenamientoCard.remove();

                // Actualizar el contador de entrenamientos
                actualizarContador();
            })
            .catch(error => {
                console.error('Error al eliminar el entrenamiento:', error);
            });
        });
    });
});

function actualizarContador() {
    // Realizar una solicitud AJAX para obtener el número actualizado de entrenamientos
    fetch('index.php?accion=contarEntrenamientos')
        .then(response => response.json())
        .then(data => {
            // Actualizar el contador en la vista
            document.getElementById('contadorEntrenamientos').innerText = data.cantidad;
        })
        .catch(error => console.error('Error:', error));
}