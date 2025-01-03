<?php
session_start();

// Define los IDs permitidos
$allowed_ids = []; // Sustituye con los IDs permitidos

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    // Guarda la URL original
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: ../auth');
    exit();
}

// Verifica si el usuario tiene un ID permitido
if (!in_array($_SESSION['user']['id'], $allowed_ids)) {
    echo "Acceso denegado. No tienes permisos para ver esta página.";
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    html {
        background-color: #4b4453;
    }
</style>
</head>
<form class="form-carga" action="upload_file.php" method="POST" enctype="multipart/form-data" style="font-family: system-ui; max-width: 400px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #ebe8e8; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  margin-top: 20vh;" >
    <label for="archivo" style="display: block; margin-bottom: 10px; font-size: 16px; font-weight: bold; color: #333;">Seleccionar Archivos (solo .webp)</label>
    <input type="file" id="archivo" name="archivos[]" accept=".webp" multiple required style="display: block; width: 100%; margin-bottom: 15px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
    <button type="submit" style="display: block; width: 100%; padding: 10px; font-size: 16px; color: #FFF; background-color: #4a90e2; border: none; border-radius: 4px; cursor: pointer;">Subir Archivos</button>
</form>

