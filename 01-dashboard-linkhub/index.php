<?php
session_start();

require('allowedIds.php');

if (!isset($_SESSION['user'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: ../auth');
    exit();
}

if (!in_array($_SESSION['user']['id'], $allowed_ids)) {
    echo "Acceso denegado. No tienes permisos para ver esta página.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href="https://app.edualex.uy/dash-link/assets/favicon-linkub.webp" type="image/webp" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Panel | Admin | Gestión</title>
</head>
<nav class="navbar">
    <div>
        <a class="a-nav" href="../"><h2>🏠 Gestión de Herramientas</h2></a>
    </div>
    <div class="user-info">
        <h2><?php echo $_SESSION['user']['name']; ?></h2>
        <img width="35px" src="<?php echo $_SESSION['user']['picture']; ?>" alt="Avatar">
        <button onclick="window.location.href='logout.php'" class="logout-button">Cerrar Sesión</button>
    </div>
</nav>
<body>
<div class="container">
<?php include 'formulario.php'; ?>
<div id="table-container" class="table-container">
<?php include 'tabla.php'; ?>
</div>
</div>
<script defer src="main.js"></script>
<script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>