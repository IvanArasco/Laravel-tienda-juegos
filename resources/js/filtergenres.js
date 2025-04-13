document.addEventListener('DOMContentLoaded', function () {
    const genreSelect = document.getElementById('genreFilter');
    const genreForm = document.getElementById('genreForm');

    genreSelect.addEventListener('change', function() {
        genreForm.submit(); // Enviar el formulario al seleccionar un género
    });
});