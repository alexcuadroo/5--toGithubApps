const resultsContainer = document.getElementById('results'); // Define fuera del fetch

fetch('./get_resources.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const resources = data;
        const searchInput = document.getElementById('searchInput');

        function createCard(resource) {
            return `
                <div class="card">
                    <div class="card-content">
                        <h3><a href="${resource.url}" target="_blank">${resource.title}</a></h3>
                        <p>${resource.description}</p>
                        <span class="category">${resource.category}</span>
                        <button class="favorite-btn" aria-label="Agregar a favoritos" data-id="${resource.id}">
                            <p class="star-icon">★</p>
                        </button>
                    </div>
                    <img src="https://app.edualex.uy/dash-link/assets/${resource.img}.webp" alt="${resource.title}" class="card-img">
                </div>
            `;
        }

        function filterResources(searchTerm) {
            const filteredResources = resources.filter(resource => {
                const searchLower = searchTerm.toLowerCase();
                return (
                    resource.title.toLowerCase().includes(searchLower) ||
                    resource.description.toLowerCase().includes(searchLower) ||
                    resource.category.toLowerCase().includes(searchLower)
                );
            });

            resultsContainer.innerHTML = filteredResources
                .map(resource => createCard(resource))
                .join('');
        }

        searchInput.addEventListener('input', (e) => {
            filterResources(e.target.value);
        });

        filterResources('');
    })
    .catch(error => {
        console.error('Hubo un problema con la solicitud Fetch:', error);
    });
    
resultsContainer.addEventListener('click', (event) => {
    if (event.target.matches('.favorite-btn') || event.target.closest('.favorite-btn')) {
        const favoriteButton = event.target.closest('.favorite-btn');
        const resourceId = favoriteButton.getAttribute('data-id');
        console.log(`Agregar a favoritos: ID ${resourceId}`);

        // Enviar el resourceId al backend usando fetch
        fetch('process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `dataId=${encodeURIComponent(resourceId)}`,
        })
        .then(response => response.json()) // Cambiar para procesar el JSON devuelto por PHP
        .then(data => {
            console.log('Respuesta del servidor:', data);
            showMessage(data.message, data.status); // Llamar a showMessage con el mensaje y el estado
        })
        .catch(error => {
            console.error('Error al agregar a favoritos:', error);
            showMessage("Hubo un error al intentar agregar a favoritos.", "error"); // Opcional: manejar errores de red
        });
    }
});