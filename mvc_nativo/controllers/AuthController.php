<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // GET /auth/login
    public function login() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/index');
            exit;
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // POST /auth/login
    public function loginPost() {
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=auth/login');
            exit;
        }

        $usuario = $this->usuarioModel->buscarPorEmail($email);

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id']     = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/index');
            exit;
        }

        $_SESSION['error'] = "Email o contraseña incorrectos.";
        header('Location: /DataAuditLabs/mvc_nativo/?url=auth/login');
        exit;
    }

    // GET /auth/registro
    public function registro() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /DataAuditLabs/mvc_nativo/?url=tareas/index');
            exit;
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        require_once __DIR__ . '/../views/auth/registro.php';
    }

    // POST /auth/registro
    public function registroPost() {
        $nombre   = trim($_POST['nombre'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirmar = trim($_POST['confirmar'] ?? '');

        if (empty($nombre) || empty($email) || empty($password) || empty($confirmar)) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=auth/registro');
            exit;
        }

        if ($password !== $confirmar) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=auth/registro');
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = "La contraseña debe tener al menos 6 caracteres.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=auth/registro');
            exit;
        }

        if ($this->usuarioModel->emailExiste($email)) {
            $_SESSION['error'] = "Este email ya está registrado.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=auth/registro');
            exit;
        }

        if ($this->usuarioModel->crear($nombre, $email, $password)) {
            $_SESSION['exito'] = "Cuenta creada exitosamente. Inicia sesión.";
            header('Location: /DataAuditLabs/mvc_nativo/?url=auth/login');
            exit;
        }

        $_SESSION['error'] = "Error al crear la cuenta. Intenta de nuevo.";
        header('Location: /DataAuditLabs/mvc_nativo/?url=auth/registro');
        exit;
    }

    // GET /auth/logout
    public function logout() {
        session_destroy();
        header('Location: /DataAuditLabs/mvc_nativo/?url=auth/login');
        exit;
    }
}
?>