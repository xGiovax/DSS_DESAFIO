<?php
require_once __DIR__ . '/../config/database.php';

class Tarea {
    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    // Obtener todas las tareas del usuario
    public function obtenerPorUsuario($usuario_id) {
        $stmt = $this->db->prepare(
            "SELECT * FROM tareas WHERE usuario_id = :usuario_id ORDER BY created_at DESC"
        );
        $stmt->execute([':usuario_id' => $usuario_id]);
        return $stmt->fetchAll();
    }

    // Obtener una tarea por ID (verificando que sea del usuario)
    public function obtenerPorId($id, $usuario_id) {
        $stmt = $this->db->prepare(
            "SELECT * FROM tareas WHERE id = :id AND usuario_id = :usuario_id LIMIT 1"
        );
        $stmt->execute([':id' => $id, ':usuario_id' => $usuario_id]);
        return $stmt->fetch();
    }

    // Crear tarea
    public function crear($titulo, $descripcion, $usuario_id) {
        $stmt = $this->db->prepare(
            "INSERT INTO tareas (titulo, descripcion, usuario_id) VALUES (:titulo, :descripcion, :usuario_id)"
        );
        return $stmt->execute([
            ':titulo'      => $titulo,
            ':descripcion' => $descripcion,
            ':usuario_id'  => $usuario_id
        ]);
    }

    // Actualizar tarea
    public function actualizar($id, $titulo, $descripcion, $estado, $usuario_id) {
        $stmt = $this->db->prepare(
            "UPDATE tareas SET titulo = :titulo, descripcion = :descripcion, estado = :estado
             WHERE id = :id AND usuario_id = :usuario_id"
        );
        return $stmt->execute([
            ':titulo'      => $titulo,
            ':descripcion' => $descripcion,
            ':estado'      => $estado,
            ':id'          => $id,
            ':usuario_id'  => $usuario_id
        ]);
    }

    // Eliminar tarea
    public function eliminar($id, $usuario_id) {
        $stmt = $this->db->prepare(
            "DELETE FROM tareas WHERE id = :id AND usuario_id = :usuario_id"
        );
        return $stmt->execute([':id' => $id, ':usuario_id' => $usuario_id]);
    }

    // Cambiar estado (para AJAX después)
    public function cambiarEstado($id, $usuario_id) {
        $tarea = $this->obtenerPorId($id, $usuario_id);
        if (!$tarea) return false;

        $nuevoEstado = $tarea['estado'] === 'pendiente' ? 'completada' : 'pendiente';

        $stmt = $this->db->prepare(
            "UPDATE tareas SET estado = :estado WHERE id = :id AND usuario_id = :usuario_id"
        );
        $stmt->execute([
            ':estado'     => $nuevoEstado,
            ':id'         => $id,
            ':usuario_id' => $usuario_id
        ]);

        return $nuevoEstado;
    }
}
?>