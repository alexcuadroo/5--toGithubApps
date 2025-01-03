<?php
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;dbname=tuDb', 'tuUser', 'tuPass');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (!isset($_SESSION['id'])) {
        echo json_encode(['error' => 'Usuario no autenticado']);
        exit;
    }

    $userId = $_SESSION['id'];

    $stmt = $pdo->prepare("SELECT r.id, r.title, r.description, r.category, r.url, r.img
                           FROM resources r
                           JOIN favorites f ON f.resource_id = r.id
                           WHERE f.user_id = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    
    $resources = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$resources) {
        echo json_encode([]);
    } else {
        echo json_encode($resources);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
