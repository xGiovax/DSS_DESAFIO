<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function crear($nombre, $email, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare(
            "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)"
        );
        return $stmt->execute([
            ':nombre'   => $nombre,
            ':email'    => $email,
            ':password' => $hash
        ]);
    }

    public function buscarPorEmail($email) {
        $stmt = $this->db->prepare(
            "SELECT * FROM usuarios WHERE email = :email LIMIT 1"
        );
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function emailExiste($email) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM usuarios WHERE email = :email"
        );
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
}
?>