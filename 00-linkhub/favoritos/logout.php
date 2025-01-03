<?php
session_start();
session_destroy(); // Destruir la sesión
header('Location: /auth'); // Redirigir a la página de autenticación
exit();
