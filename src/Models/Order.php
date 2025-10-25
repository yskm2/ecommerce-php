<?php
namespace App\Models;

use App\Config\Database;

class Order {
    private $db;
    private $table = 'pedidos';
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Crear un nuevo pedido
     * IMPORTANTE: Usa transacción para asegurar integridad
     */
    public function create($orderData, $items) {
        // Iniciar transacción
        $this->db->begin_transaction();
        
        try {
            // 1. Insertar pedido principal
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table} 
                (usuario_id, nombre_completo, email, telefono, 
                 calle, numero, colonia, ciudad, estado, codigo_postal, referencias,
                 total, metodo_pago, notas)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            
            $stmt->bind_param(
                'issssssssssdss',
                $orderData['usuario_id'],
                $orderData['nombre_completo'],
                $orderData['email'],
                $orderData['telefono'],
                $orderData['calle'],
                $orderData['numero'],
                $orderData['colonia'],
                $orderData['ciudad'],
                $orderData['estado'],
                $orderData['codigo_postal'],
                $orderData['referencias'],
                $orderData['total'],
                $orderData['metodo_pago'],
                $orderData['notas']
            );
            
            $stmt->execute();
            $orderId = $this->db->insert_id;
            
            // 2. Insertar detalles del pedido
            $stmtDetail = $this->db->prepare(
                "INSERT INTO pedido_detalles 
                (pedido_id, producto_id, nombre_producto, cantidad, precio_unitario)
                VALUES (?, ?, ?, ?, ?)"
            );
            
            foreach ($items as $productId => $item) {
                $stmtDetail->bind_param(
                    'iisid',
                    $orderId,
                    $productId,
                    $item['nombre'],
                    $item['cantidad'],
                    $item['precio']
                );
                $stmtDetail->execute();
            }
            
            // 3. Confirmar transacción
            $this->db->commit();
            
            return $orderId;
            
        } catch (\Exception $e) {
            // Si algo falla, revertir todo
            $this->db->rollback();
            throw $e;
        }
    }
    
    /**
     * Obtener pedidos de un usuario
     */
    public function getByUser($userId) {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} 
             WHERE usuario_id = ? 
             ORDER BY fecha_pedido DESC"
        );
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Obtener todos los pedidos (admin)
     */
    public function getAll() {
        $result = $this->db->query(
            "SELECT id, usuario_id, nombre_completo, email, total, 
                    fecha_pedido, state 
             FROM {$this->table} 
             ORDER BY fecha_pedido DESC"
        );
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Obtener última dirección de envío del usuario
     */
    public function getLastShippingAddress($userId) {
        $stmt = $this->db->prepare(
            "SELECT calle, numero, colonia, ciudad, estado, 
                    codigo_postal, referencias
             FROM {$this->table}
             WHERE usuario_id = ?
             ORDER BY fecha_pedido DESC
             LIMIT 1"
        );
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_assoc() ?? [];
    }
    
    /**
     * Actualizar estado del pedido
     */
    public function updateStatus($orderId, $status) {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET state = ? WHERE id = ?"
        );
        $stmt->bind_param('si', $status, $orderId);
        
        return $stmt->execute();
    }
}