function showMessage(message, type = "success") {
    Toastify({
        text: message,
        duration: 3500,
        destination: "#",
        newWindow: true,
        close: false,
        gravity: "bottom", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: type === "success" ? "linear-gradient(to right,rgb(0, 101, 44),rgb(70, 181, 29))" : "linear-gradient(to right, #b00600,rgb(191, 120, 39))"
        },
        onClick: function () { } // Callback after click
    }).showToast();
}
 function reloadTable() {
        fetch('tabla.php')
            .then(response => response.text())
            .then(html => {
                document.getElementById('table-container').innerHTML = html;
                attachEventListeners(); // Vuelve a adjuntar los eventos a los botones
            })
            .catch(error => console.error('Error al recargar la tabla:', error));
    }

    function attachEventListeners() {
        // Reasignar los eventos a los botones después de recargar la tabla
        document.querySelectorAll('.eliminar').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                fetch(`eliminar.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Respuesta del servidor:', data);
                        showMessage(data.message, data.status);
                        if (data.status === 'success') {
                            reloadTable(); // Recargar la tabla
                        }
                    })
                    .catch(error => console.error('Error al eliminar:', error));
            });
        });

        document.querySelectorAll('.cambiar_orden').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const action = this.getAttribute('data-action');
                fetch(`cambiar_orden.php?id=${id}&action=${action}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Respuesta del servidor:', data);
                        showMessage(data.message, data.status);
                        if (data.status === 'success') {
                            reloadTable(); // Recargar la tabla
                        }
                    })
                    .catch(error => console.error('Error al cambiar el orden:', error));
            });
        });
    }
    // Inicializar los eventos
    attachEventListeners();