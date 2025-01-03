<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['id'])) {
        echo json_encode(["status" => "error", "message" => "Usuario no autenticado."]);
        exit;
    }

    $userId = $_SESSION['id'];
    $resourceId = $_POST['dataId']; // El ID del recurso que se va a eliminar

    $dsn = "mysql:host=localhost;dbname=tuDb";
    $username = "tuUser";
    $password = "tuPass";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica si el favorito existe antes de intentar eliminarlo
        $stmt = $pdo->prepare("SELECT * FROM favorites WHERE user_id = :userId AND resource_id = :resourceId");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':resourceId', $resourceId);
        $stmt->execute();

        // Si el recurso existe, proceder con la eliminación
        if ($stmt->rowCount() > 0) {
            $deleteStmt = $pdo->prepare("DELETE FROM favorites WHERE user_id = :userId AND resource_id = :resourceId");
            $deleteStmt->bindParam(':userId', $userId);
            $deleteStmt->bindParam(':resourceId', $resourceId);
            $deleteStmt->execute();

            echo json_encode(["status" => "success", "message" => "Herramienta eliminada"]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se encontró esta herramienta en tus favoritos"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
    }
}
?>
