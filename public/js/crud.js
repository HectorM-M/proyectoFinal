document.addEventListener("DOMContentLoaded", function() {
    const botonesEliminar = document.querySelectorAll(".btn-eliminar");

    botonesEliminar.forEach(boton => {
        boton.addEventListener("click", function(e) {
            if (!confirm("¿Seguro que Deseas Eliminar este Producto?")) {
                e.preventDefault();
            }
        });
    });
});