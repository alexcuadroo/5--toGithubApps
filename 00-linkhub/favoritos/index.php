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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#001F3F" />
    
    <title>LinkHub | Favoritos</title>
    <link rel="icon" href="../assets/favicon-linkub.webp" type="image/webp" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scrollbar-width: thin;
    scrollbar-color: #FFF #000545;
}

body {
    font-family: system-ui, Arial, sans-serif;
    background: #020024;
    background: linear-gradient(0deg, #020024 0%, #000545 48%, #00260d 90%);
    min-height: 100vh;
}
main {
    flex: 1;
    padding: 2rem;
}
    #navbar-container {
        height: 40px;
        min-height: 30px;
    }
h1 {
    color: white;
    font-size: 2rem;
    text-align: center;
    margin-top: 2rem;
    margin-bottom: 2rem;
}
.container > p {
    color: white;
    font-size: 0.9rem;
    text-align: center;
    margin-bottom: 4.5rem;
}
#cards-container  {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
    
    max-width: 1200px;
    margin: 0 auto;
}

.card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 15px;
    max-width: 400px;
    height: fit-content;
    position: relative;
}
.card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.447);
}

.card-content {
    flex: 1;
    margin-right: 10px;
}

.card h3 a {
    color: #000225;
    text-decoration: none;
    font-size: 1em;
    font-weight: bold;
}
.card h3 a:hover {
    color: #003b15; 
    text-decoration: underline;
    text-decoration-style: wavy;
}

.card p {
    margin: 8px 0;
    color: #3f405c;
    font-size: 0.9em;
}

.card .category {
    display: inline-block;
    background-color: #f0f0f0;
    color: #000000;
    font-size: 0.8em;
    padding: 4px 8px;
    border-radius: 12px;
    margin-top: 8px;
}

.card-img {
    width: 30px;
    border-radius: 15%;
    object-fit: cover;
}
.favorite-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    position: absolute; 
    top: 0px; 
    right: 0px;
}
.favorite-btn > button {
    background: transparent;
    padding: 7px 14px;
    font-size: 30px; 
    border-radius: 10%;
    border: none;
    &:hover {
        cursor: pointer;
        transform: scale(1.5);
        transition: 0.3s;
    }
}

.star-icon {
    display: inline-block;
}
.star-icon:hover {
    color: red;
}
footer {
    text-align: center;
    color: #666;
    font-size: 0.83em;
    padding: 1em 0;
}
footer a {
    color: rgb(10, 122, 0);
    text-decoration: none;
    &:hover {
        color: rgb(0, 255, 0);
    }
}
header {
    position: relative;
  }
  
  .button-1, .button-2 {
    position: absolute;
    top: 2px; 
    right: 2px; 
    padding: 6px 12px;
    background-color: #02004a;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-decoration: none;
  }
  
  .button-1:hover {
    background-color: #02004a;
  }
  .button-2:hover {
    background-color: #4a0000;
  }
  .button-3{
    position: absolute;
    top: 2px;
    right: 130px;
    padding: 6px 12px;
    background-color: #02004a;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-decoration: none;
  }
  p {
      color: white;
      & a {
          color: green;
      }
  }
</style>
</head>
<div id="navbar-container"></div>
<body>
<main>
    <h1>Mis favoritos</h1>
    <div id="cards-container"></div>
    <script>
        function createCard(resource) {
            return `
                <div class="card">
                <div class="card-content">
                    <h3><a href="${resource.url}" target="_blank">${resource.title}</a></h3>
                    <p>${resource.description}</p>
                    <span class="category">${resource.category}</span>
                    <form class="favorite-btn" action="delete.php" method="POST" onsubmit="event.preventDefault(); deleteResource(${resource.id});">
                        <button type="submit">🚮️</button>
                    </form>
                </div>
                <img src="https://app.edualex.uy/dash-link/assets/${resource.img}.webp" alt="${resource.title}" class="card-img">
            </div>
            `;
    }
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="./main.js"></script>
    <script type="module">
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
    </main>
<script defer src="https://umami-production-50e0.up.railway.app/script.js" data-website-id="01ed1fdc-cacb-4821-b399-8e80cd4262cf"></script>
</body>
</html>