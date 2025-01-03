<form id="myForm" action="procesar_formulario.php" method="post" enctype="multipart/form-data">
    <h3>Agregar Nueva Herramienta / Recurso</h3>
    <label for="titulo">Título:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="descripcion">Descripción:</label>
    <input id="description" name="description" required placeholder="Breve comentario de la herramienta"></input>
    <br>
    <label for="img">Nombre de la imagen:</label>
    <input type="text" id="img" name="img" placeholder="ej: canva" required>
    <br>
    <label for="url">URL:</label>
    <input type="url" id="url" name="url" required placeholder="https://url.com">
    <br>
    <label for="categoria">Categoría:</label>
    <select name="category" required>
                <option value="" disabled selected>Selecciona una</option>
                <option value="Creatividad">Creatividad</option>
                <option value="Presentaciones">Presentaciones</option>
                <option value="Videos">Videos</option>
                <option value="Imagenes">Imágenes</option>
                <option value="Juegos">Juegos</option>
                <option value="Evaluacion">Evaluación</option>
                <option value="Historia">Historia</option>
                <option value="By Alex Cuadro">De Alex Cuadro</option>
                <option value="Educación">Educación</option>
                <option value="Otros">Otros</option>
    </select>
    <br>
    <label for="orden">Orden:</label>
    <input type="number" id="ordenar" name="ordenar" required placeholder="Verifica que no coincida">
    <br>
    <input type="submit" value="Agregar">
    <a href="./uploader-img" class="upload-button">Subir Imágenes</a>
</form>
<script>
    document.getElementById("myForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevenir el envío tradicional del formulario

            const formData = new FormData(this); // Recoger los datos del formulario

            fetch('procesar_formulario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showMessage(data.message, "success");
                } else {
                    showMessage(data.message, "error");
                }
                
            })
            .catch(error => {
                showMessage('Ocurrió un error al procesar la solicitud.', "error");
            });
            
            setTimeout(() => {
             location.reload();
            }, 3000); 
            
        });
</script>
