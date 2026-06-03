<?php
require_once __DIR__ . '/../models/Tarea.php';

class TareasController {
    private $tareaModel;

    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /DataAuditLabs/mvc_nativo/?url=auth/login');
            exit;
        }
        $this->tareaModel = new Tarea();
    }

    // GET - Listar tareas
    public function index() {
        $usuario_id = $_SESSION['usuario_id'];
        $tareas = $this->tareaModel->obtenerPorUsuario($usuario_id);
        $exito = $_SESSION['exito'] ?? null;
        unset($_SESSION['exito']);
        require_once __DIR__ . '/../views/tareas/index.php';
    }

    // GET - Formulario crear
    public function crear() {
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        require_once __DIR__ . '/../views/tareas/crear.php';
    }

    // POST - Guardar tarea
    public function guardar() {
        $titulo      = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $usuario_id  = $_SESSION['usuario_id'];

        if (empty($titulo)) {
            $_SESSION['error'] = "El título es obligatorio.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/crear');
            exit;
        }

        if ($this->tareaModel->crear($titulo, $descripcion, $usuario_id)) {
            $_SESSION['exito'] = "Tarea creada exitosamente.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/index');
            exit;
        }

        $_SESSION['error'] = "Error al crear la tarea.";
        header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/crear');
        exit;
    }

    // GET - Formulario editar
    public function editar() {
        $id         = $_GET['id'] ?? null;
        $usuario_id = $_SESSION['usuario_id'];

        if (!$id) {
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/index');
            exit;
        }

        $tarea = $this->tareaModel->obtenerPorId($id, $usuario_id);

        if (!$tarea) {
            $_SESSION['error'] = "Tarea no encontrada.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/index');
            exit;
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        require_once __DIR__ . '/../views/tareas/editar.php';
    }

    // POST - Actualizar tarea
    public function actualizar() {
        $id          = $_POST['id'] ?? null;
        $titulo      = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $estado      = $_POST['estado'] ?? 'pendiente';
        $usuario_id  = $_SESSION['usuario_id'];

        if (empty($titulo)) {
            $_SESSION['error'] = "El título es obligatorio.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/editar&id=' . $id);
            exit;
        }

        if ($this->tareaModel->actualizar($id, $titulo, $descripcion, $estado, $usuario_id)) {
            $_SESSION['exito'] = "Tarea actualizada correctamente.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/index');
            exit;
        }

        $_SESSION['error'] = "Error al actualizar la tarea.";
        header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/editar&id=' . $id);
        exit;
    }

    // GET - Eliminar tarea
    public function eliminar() {
        $id         = $_GET['id'] ?? null;
        $usuario_id = $_SESSION['usuario_id'];

        if ($id && $this->tareaModel->eliminar($id, $usuario_id)) {
            $_SESSION['exito'] = "Tarea eliminada correctamente.";
        } else {
            $_SESSION['error'] = "Error al eliminar la tarea.";
        }

        header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/index');
        exit;
    }
}
?>