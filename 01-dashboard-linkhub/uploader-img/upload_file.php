<?php
// Carpeta base de almacenamiento
$baseDir = '../assets/';

// Verificar si se ha enviado el formulario y si los archivos han sido subidos correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivos'])) {
    // Ruta completa de la carpeta de destino
    $uploadDir = $baseDir . $carpetaSeleccionada . '/';

    // Verificar si la carpeta existe, si no, crearla
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $archivos = $_FILES['archivos'];
    $allSuccess = true; // Variable para verificar si todos los archivos se subieron correctamente

    // Recorrer los archivos subidos
    for ($i = 0; $i < count($archivos['name']); $i++) {
        $archivoNombre = basename($archivos['name'][$i]);
        $archivoDestino = $uploadDir . $archivoNombre;

        // Verificar si el archivo fue subido sin errores
        if (!move_uploaded_file($archivos['tmp_name'][$i], $archivoDestino)) {
            $allSuccess = false;
            break; // Salir del bucle si hay algún error
        }
    }

    // Preparar el mensaje para el usuario
    if ($allSuccess) {
        $message = "Todos los archivos han sido subidos correctamente.";
    } else {
        $message = "Hubo un error al subir al menos un archivo.";
    }
} else {
    $message = "No se ha enviado ningún archivo o no se ha seleccionado una carpeta.";
}

echo "<script>
    alert('" . addslashes($message) . "');
    window.location.href = '../';
</script>";
?>