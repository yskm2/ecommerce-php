<?php
namespace App\Models;

use App\Config\Database;

/**
 * Modelo Cart - Gestión del carrito en BD
 * NOTA: La lógica de negocio del carrito está en CartService
 */
class Cart
{
    private $db;
    private $table = 'carrito';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Guardar item en el carrito de BD
     */
    public function addItem($userId, $productId, $quantity)
    {
        // Verificar si ya existe
        $existing = $this->getItem($userId, $productId);

        if ($existing) {
            // Actualizar cantidad
            return $this->updateQuantity(
                $existing['id'],
                $existing['cantidad'] + $quantity
            );
        } else {
            // Insertar nuevo
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table} (usuario_id, producto_id, cantidad) 
                 VALUES (?, ?, ?)"
            );
            $stmt->bind_param('iii', $userId, $productId, $quantity);

            return $stmt->execute();
        }
    }

    /**
     * Obtener item específico
     */
    public function getItem($userId, $productId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} 
             WHERE usuario_id = ? AND producto_id = ?"
        );
        $stmt->bind_param('ii', $userId, $productId);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Actualizar cantidad
     */
    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity <= 0) {
            return $this->removeItem($itemId);
        }

        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET cantidad = ? WHERE id = ?"
        );
        $stmt->bind_param('ii', $quantity, $itemId);

        return $stmt->execute();
    }

    /**
     * Eliminar item
     */
    public function removeItem($itemId)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $itemId);

        return $stmt->execute();
    }

    /**
     * Obtener todo el carrito de un usuario con datos de productos
     */
    public function getUserCart($userId)
    {
        $stmt = $this->db->prepare(
            "SELECT p.id, p.nombre, p.precio, p.imagen, c.cantidad 
             FROM {$this->table} c 
             JOIN productos p ON c.producto_id = p.id 
             WHERE c.usuario_id = ?"
        );
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        // Convertir a formato del carrito de sesión
        $cart = [];
        foreach ($result as $item) {
            $cart[$item['id']] = [
                'nombre' => $item['nombre'],
                'precio' => $item['precio'],
                'cantidad' => $item['cantidad'],
                'imagen' => $item['imagen']
            ];
        }

        return $cart;
    }

    /**
     * Limpiar carrito del usuario
     */
    public function clearUserCart($userId)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE usuario_id = ?"
        );
        $stmt->bind_param('i', $userId);

        return $stmt->execute();
    }
}