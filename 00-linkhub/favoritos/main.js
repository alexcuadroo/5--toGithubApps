function updateCards() {
    fetch('fetching.php')
    .then(response => response.json())
    .then(data => {
        if (Array.isArray(data)) { // Asegurarse de que la respuesta es un array
            const container = document.getElementById('cards-container');
            container.innerHTML = ''; // Limpiar el contenido existente
                if (data.length === 0) {
                container.innerHTML = '<p>No tienes favoritos, ve al <a href="../">inicio</a> para agregar.</p>';
                } else 
                data.forEach(resource => {
                container.innerHTML += createCard(resource);
            });
        } else {
            console.error('Error: datos no son un array');
        }
    })
    .catch(error => console.error('Error fetching data:', error));
}

document.addEventListener('DOMContentLoaded', () => {
    updateCards(); // Llamada para cargar las tarjetas inicialmente
});

// funcion mensaje general
function showMessage(message, type = "success") {
    Toastify({
        text: message,
        duration: 3000,
        gravity: "bottom", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: type === "success" ? "linear-gradient(to right, #00b09b, #62c93d)" : "linear-gradient(to right, #b00600,rgb(201, 157, 61))"
        },
        onClick: function () { } // Callback after click
    }).showToast();
}

// funcion borrado y mensaje
function deleteResource(resourceId) {
    fetch('delete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `dataId=${encodeURIComponent(resourceId)}`,
    })
    .then(response => response.json()) // Supone una respuesta JSON del servidor
    .then(data => {
            console.log('Respuesta del servidor:', data);
            showMessage(data.message, data.status);
            updateCards();
    })
    .catch(error=> {
        console.error('Error:', error);
        showMessage('Algo mal ha pasado, ni idea que', 'error');
    });
}

