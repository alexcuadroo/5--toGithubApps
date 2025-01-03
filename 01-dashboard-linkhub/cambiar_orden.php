<?php
if (isset($_GET['id']) && isset($_GET['action'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=tuDb', '', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_GET['id'];
        $accion = $_GET['action'];

        // Obtener el objeto actual
        $stmt = $pdo->prepare("SELECT id, ordenar FROM resources WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $objeto_actual = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($objeto_actual) {
            $orden_actual = $objeto_actual['ordenar'];
            $nuevo_orden = $accion === 'up' ? $orden_actual - 1 : $orden_actual + 1;

            // Comprobar los límites para que no sobrepase el inicio o el final
            $stmt = $pdo->prepare("SELECT id, ordenar FROM resources WHERE ordenar = :nuevo_orden");
            $stmt->execute(['nuevo_orden' => $nuevo_orden]);
            $objeto_adyacente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($objeto_adyacente) {
                $pdo->beginTransaction();

                // Intercambiar los órdenes entre el objeto actual y el adyacente
                $stmt = $pdo->prepare("UPDATE resources SET ordenar = :nuevo_orden WHERE id = :id");
                $stmt->execute(['nuevo_orden' => $nuevo_orden, 'id' => $id]);

                $stmt = $pdo->prepare("UPDATE resources SET ordenar = :orden_actual WHERE id = :id_adyacente");
                $stmt->execute(['orden_actual' => $orden_actual, 'id_adyacente' => $objeto_adyacente['id']]);

                $pdo->commit();
                
                echo json_encode([
                'status' => 'success',
                'message' => 'Orden cambiado'
            ]);
        
            } else {
                echo json_encode([
                'status' => 'error',
                'message' => 'Movimiento no válido'
            ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Elemento no encontrado'
            ]);
        }

    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode([
            'status' => 'error',
            'message' => 'Fallo al cambiar el orden: ' . $e->getMessage()
]);
    }
} else {
    echo json_encode([
                'status' => 'error',
                'message' => 'ID o accion no encontrado'
    ]);
}
?>