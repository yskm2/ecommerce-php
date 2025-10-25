<?php
namespace App\Models;

use App\Config\Database;

/**
 * Modelo Product
 * RESPONSABILIDAD: TODO lo relacionado con productos en la BD
 * - No tiene lógica de negocio compleja
 * - Solo queries y retorno de datos
 */
class Product
{
    private $db;
    private $table = 'productos';

    public function __construct()
    {
        // Obtenemos la conexión del Singleton
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Obtener todos los productos con filtros opcionales
     * 
     * @param array $filters ['categoria' => 'X', 'orden' => 'Y']
     * @return array Array de productos
     */
    public function getAll($filters = [])
    {
        $sql = "SELECT id, nombre, categoria, descripcion, precio, stock, imagen 
                FROM {$this->table}";

        $params = [];
        $types = '';

        // Aplicar filtro de categoría si existe
        if (!empty($filters['categoria'])) {
            $sql .= " WHERE categoria = ?";
            $params[] = $filters['categoria'];
            $types .= 's';
        }

        // Aplicar ordenamiento
        $order = $filters['orden'] ?? 'newest';
        switch ($order) {
            case 'price_asc':
                $sql .= " ORDER BY precio ASC";
                break;
            case 'price_desc':
                $sql .= " ORDER BY precio DESC";
                break;
            case 'name_asc':
                $sql .= " ORDER BY nombre ASC";
                break;
            default:
                $sql .= " ORDER BY id DESC";
        }

        $stmt = $this->db->prepare($sql);

        // Bind params si existen
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Buscar producto por ID
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE id = ?"
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Obtener productos destacados (últimos 6)
     */
    public function getFeatured($limit = 6)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} 
             ORDER BY id DESC 
             LIMIT ?"
        );
        $stmt->bind_param('i', $limit);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Obtener todas las categorías únicas
     */
    public function getCategories()
    {
        $result = $this->db->query(
            "SELECT DISTINCT categoria FROM {$this->table} 
            ORDER BY categoria ASC"
        );

        return array_column($result->fetch_all(MYSQLI_ASSOC), 'categoria');
    }
    public function getCategories2()
    {
        // 1. Apuntar a la tabla 'categorias'
        $sql = "SELECT id_categoria, nombre FROM categorias ORDER BY nombre ASC";
        
        $result = $this->db->query($sql);
        
        if ($result) {
            // 2. Devolver el array asociativo completo que la vista espera
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return []; // Devolver un array vacío si falla
    }

    /**
     * Crear nuevo producto
     */
    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} 
                (nombre, categoria, descripcion, precio, stock, imagen, id_categoria) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            'sssdisi',
            $data['nombre'],
            $data['categoria_nombre'],
            $data['descripcion'],
            $data['precio'],
            $data['stock'],
            $data['imagen'],
            $data['id_categoria']
        );

        if ($stmt->execute()) {
            return $this->db->insert_id;
        }

        return false;
    }

    /**
     * Verificar si hay stock suficiente
     */
    public function hasStock($id, $quantity)
    {
        $product = $this->findById($id);
        return $product && $product['stock'] >= $quantity;
    }
}
