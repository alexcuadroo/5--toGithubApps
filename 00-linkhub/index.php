<?php
session_start();
if (!isset($_SESSION['user'])) {
  $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
  header('Location: /auth');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LinkHub | Repositorio de herramientas digitales</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="icon" href="./assets/favicon-linkub.webp" type="image/webp" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <meta name="description" content="Repositorio y buscador de herramientas educativas para docentes" />
  <meta name="theme-color" content="#001F3F" />

  <meta name="author" content="Alex Cuadro" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords"
    content="herramientas, educativas, estudiantes, docentes, linkhub, recursos, educacion, uruguay, docente, utu, secundaria, liceo" />

  <meta property="og:title" content="LinkHub | Herramientas digitales" />
  <meta property="og:url" content="https://app.edualex.uy/linkhub/" />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="https://app.edualex.uy/linkhub/assets/og-linkhub.webp" />
  <meta property="og:description" content="Repositorio y buscador de herramientas educativas para docentes" />
  <meta property="og:site_name" content="LinkHub" />
  <meta property="og:locale" content="es_ES" />
  <style>
    #navbar-container {
      height: 55px;
      min-height: 30px;
    }
  </style>
</head>

<body>
  <div id="navbar-container"></div>
  <main>
    <div class="container">
      <h1>LinkHub Educativo 💻</h1>
      <p>Herramientas digitales reunidas en un solo lugar</p>
      <div class="search-container">
        <input type="text" id="searchInput" placeholder="¿Qué herramienta necesitas?" autocomplete="off" autofocus />
      </div>
      <div id="results" class="results-grid"></div>
    </div>
    <div id="maintenance-modal" class="modal">
      Puedes ver tus favoritos en ⭐
    </div>
  </main>
  <footer>
    <p>
      A project by
      <a href="https://github.com/alexcuadroo" target="_blank">Alex Cuadro </a>| Inspired by 💚 Cristian
    </p>
  </footer>
  <script src="./scriptsResources.js" type="module"></script>
  <script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script defer src="./main.js"></script>
  <script defer type="module">
    function cargarNavbar() {
      fetch('navbar.php')
        .then(response => response.text())
        .then(data => {
          document.getElementById('navbar-container').innerHTML = data;
        })
        .catch(error => console.error('Error al cargar la barra de navegación:', error));
    }
    window.onload = cargarNavbar;
  </script>
</body>

</html>