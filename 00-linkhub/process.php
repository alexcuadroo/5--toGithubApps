<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resourceId = $_POST['dataId'];
    if (!isset($_SESSION['id'])) {
        echo json_encode(["status" => "error", "message" => "Usuario no autenticado."]);
        exit;
    }

    $userId = $_SESSION['id'];

    $dsn = "mysql:host=localhost;dbname=tuBase";
    $username = "tuUsuario";
    $password = "tuContraseña";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO tuTabla (user_id, resource_id) VALUES (:userId, :resourceId)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':resourceId', $resourceId);
        $stmt->execute();
        
        echo json_encode(["status" => "success", "message" => "Herramienta guardada"]);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo json_encode(["status" => "error", "message" => "Ya has guardado esta herramienta"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
    exit;
}
?>