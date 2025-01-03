<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$host = '';
$dbname = '';
$user = '';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión a la base de datos']);
    exit;
}

// Consulta de los recursos
$stmt = $pdo->query("SELECT * FROM tuTabla ORDER BY ordenar ASC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
