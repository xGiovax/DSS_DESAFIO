<?php
session_start();
require_once __DIR__ . '/../mvc_nativo/config/database.php';
require_once __DIR__ . '/../mvc_nativo/models/Tarea.php';

header('Content-Type: application/json');

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit;
}

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener el ID de la tarea
$data = json_decode(file_get_contents('php://input'), true);
$id   = $data['id'] ?? null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
    exit;
}

$tareaModel  = new Tarea();
$nuevoEstado = $tareaModel->cambiarEstado($id, $_SESSION['usuario_id']);

if ($nuevoEstado) {
    echo json_encode([
        'success'      => true,
        'nuevoEstado'  => $nuevoEstado,
        'mensaje'      => 'Estado actualizado a: ' . $nuevoEstado
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al cambiar estado']);
}
?>