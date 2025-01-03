<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $dsn = 'mysql:host=localhost;dbname=tuDb';
        $username = '';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recoge los datos del formulario
        $titulo = $_POST['title'];
        $descripcion = $_POST['description'];
        $url = $_POST['url'];
        $categoria = $_POST['category'];
        $orden = $_POST['ordenar'];

        $stmt = $pdo->prepare("INSERT INTO resources (title, description, img, url, category, ordenar) VALUES (:title, :description, :img, :url, :category, :ordenar)");
        $stmt->execute(['title' => $titulo, 'description' => $descripcion, 'img' => $img, 'url' => $url, 'category' => $categoria, 'ordenar' => $orden]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Herramienta guardada'
        ]);
        
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}
?>
