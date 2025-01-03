<?php
try {
    $dsn = 'mysql:host=localhost;dbname=tuDb';
    $username = '';
    $password = '';
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener datos
    $stmt = $pdo->query("SELECT id, title, img, url, ordenar FROM resources ORDER BY ordenar ASC");
    $resources = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo "<table>";
    echo "<h3>Lista de Recursos</h3>";
    echo "<small>Al eliminar, evita dejar huecos en el orden</small>";
    echo "<tr><th>Orden</th><th>Título</th><th>Imagen</th><th>URL</th><th>Acciones</th></tr>";
    foreach ($resources as $resource) {
        echo "<tr>";
        echo "<td>{$resource['ordenar']}</td>";
        echo "<td>{$resource['title']}</td>";
        echo "<td>{$resource['img']}</td>";
        echo "<td><a href='{$resource['url']}' target='_blank'>🌐</a></td>";
        echo "<td>
            <button class='eliminar' data-id='{$resource['id']}'>Eliminar</button>
            <button class='cambiar_orden' data-id='{$resource['id']}' data-action='up'>Arriba ⬆</button>
            <button class='cambiar_orden' data-id='{$resource['id']}' data-action='down'>Abajo ⬇</button>
        </td>";
        echo "</tr>";
    }
    echo "</table>";


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>