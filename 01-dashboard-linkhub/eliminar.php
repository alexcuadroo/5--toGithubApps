<?php
if (isset($_GET['id'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=tuDb', '', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("DELETE FROM resources WHERE id = :id");
        $stmt->execute(['id' => $_GET['id']]);
        
        echo json_encode([
                'status' => 'success',
                'message' => 'Herramienta eliminada'
            ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
]);
    }
} else {
    echo json_encode([
                'status' => 'error',
                'message' => 'ID no proporcionado'
            ]);
}
?>