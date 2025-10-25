<?php
// ============================================
// ARCHIVO: src/Config/Database.php
// PROPÓSITO: Gestión de conexión a BD (Singleton)
// ============================================
namespace App\Config;

/**
 * Clase Database - Patrón Singleton
 * 
 * RAZÓN: Solo necesitamos UNA conexión a la BD en toda la app.
 * Evita crear múltiples conexiones y pasar $conn por todos lados.
 */
class Database {
    private static $instance = null;
    private $connection;
    
    // Constructor privado - Nadie puede hacer "new Database()"
    private function __construct() {
        try {
            $this->connection = new \mysqli(
                'localhost',
                'root',
                '',
                'ecommerce_php'
            );
            
            if ($this->connection->connect_error) {
                throw new \Exception("Error de conexión: " . $this->connection->connect_error);
            }
            
            $this->connection->set_charset('utf8mb4');
            
        } catch (\Exception $e) {
            die("Error de base de datos: " . $e->getMessage());
        }
    }
    
    /**
     * Obtener la única instancia de Database
     * IMPORTANTE: Este es el único punto de acceso a la BD
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    // Prevenir clonación y serialización
    private function __clone() {}
    public function __wakeup() {}
}