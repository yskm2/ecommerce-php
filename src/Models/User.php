<?php 
namespace App\Models;

use App\Config\Database;

class User {
    private $db;
    private $table = 'usuarios';
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Buscar usuario por email o username
     */
    public function findByCredentials($credential) {
        $stmt = $this->db->prepare(
            "SELECT id, password, username, nombre, rol, remember_me_token, token_expiry 
             FROM {$this->table} 
             WHERE email = ? OR username = ?"
        );
        $stmt->bind_param('ss', $credential, $credential);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_assoc();
    }
    
    /**
     * Buscar por ID
     */
    public function findById($id) {
        $stmt = $this->db->prepare(
            "SELECT id, username, nombre, apellido, email, telefono, direccion, creado_en 
             FROM {$this->table} 
             WHERE id = ?"
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_assoc();
    }
    
    /**
     * Crear nuevo usuario
     */
    public function create($data) {
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (username, password, email, telefono) 
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param(
            'ssss',
            $data['username'],
            $passwordHash,
            $data['email'],
            $data['telefono']
        );
        
        return $stmt->execute();
    }
    
    /**
     * Actualizar datos de usuario
     */
    public function update($id, $data) {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} 
             SET nombre=?, apellido=?, email=?, telefono=?, direccion=? 
             WHERE id=?"
        );
        $stmt->bind_param(
            'sssssi',
            $data['nombre'],
            $data['apellido'],
            $data['email'],
            $data['telefono'],
            $data['direccion'],
            $id
        );
        
        return $stmt->execute();
    }
    
    /**
     * Actualizar token de "recordarme"
     */
    public function updateRememberToken($id, $token, $expiry) {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} 
             SET remember_me_token = ?, token_expiry = ? 
             WHERE id = ?"
        );
        $stmt->bind_param('ssi', $token, $expiry, $id);
        
        return $stmt->execute();
    }
    
    /**
     * Eliminar usuario
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        
        return $stmt->execute();
    }
    
    /**
     * Obtener todos los usuarios (para admin)
     */
    public function getAll() {
        $result = $this->db->query(
            "SELECT id, username, nombre, apellido, email, telefono, rol, creado_en 
             FROM {$this->table} 
             ORDER BY id ASC"
        );
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Verificar si email existe
     */
    public function emailExists($email, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare(
                "SELECT id FROM {$this->table} WHERE email = ? AND id != ?"
            );
            $stmt->bind_param('si', $email, $excludeId);
        } else {
            $stmt = $this->db->prepare(
                "SELECT id FROM {$this->table} WHERE email = ?"
            );
            $stmt->bind_param('s', $email);
        }
        
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
}