<?php    
namespace App\Controllers\Admin;

use App\Models\Product;
use App\Services\AuthService;
use App\Helpers\View;
use App\Config\Config;

class ProductController {
    private $productModel;
    private $authService;
    
    public function __construct() {
        $this->productModel = new Product();
        $this->authService = new AuthService();
    }
    
    /**
     * Listar todos los productos (admin)
     */
    public function index() {
        try {
            $this->authService->requireAdmin();
            
            $products = $this->productModel->getAll();
            
            View::renderAdmin('products/index', [
                'products' => $products,
                'pageTitle' => 'Gestionar Productos'
            ]);
            
        } catch (\Exception $e) {
            View::redirect('login', 'error', 'Acceso no autorizado');
        }
    }
    
    /**
     * Mostrar formulario de crear producto
     */
    public function create() {
        try {
            $this->authService->requireAdmin();
            
            $categories = $this->productModel->getCategories2();
            
            View::renderAdmin('products/create', [
                'categories' => $categories,
                'pageTitle' => 'Crear Producto'
            ]);
            
        } catch (\Exception $e) {
            View::redirect('login', 'error', 'Acceso no autorizado');
        }
    }
    
    /**
     * Guardar nuevo producto
     */
    public function store() {
        try {
            $this->authService->requireAdmin();
            
            // Validar y procesar datos
            $data = $this->validateProductData();
            
            // Manejar subida de imagen
            $imagePath = $this->handleImageUpload();
            
            if (!$imagePath) {
                View::redirect('admin_create_product', 'error', 'Error al subir imagen');
                return;
            }
            
            $data['imagen'] = $imagePath;
            
            // Crear producto
            if ($this->productModel->create($data)) {
                View::redirect('admin_products', 'success', 'Producto creado exitosamente');
            } else {
                View::redirect('admin_create_product', 'error', 'Error al crear producto');
            }
            
        } catch (\Exception $e) {
            View::redirect('admin_create_product', 'error', $e->getMessage());
        }
    }
    
    /**
     * Validar datos del producto
     */
    private function validateProductData() {
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = floatval($_POST['precio'] ?? 0);
        $stock = intval($_POST['stock'] ?? 0);
        $idCategoria = intval($_POST['id_categoria'] ?? 0);
        
        if (empty($nombre) || $precio <= 0 || $stock < 0 || $idCategoria <= 0) {
            throw new \Exception('Datos inválidos');
        }
        
        return [
            'nombre' => $nombre,
            'categoria_nombre' => $this->getCategoryName($idCategoria),
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'id_categoria' => $idCategoria
        ];
    }
    
    /**
     * Manejar subida de imagen
     */
    private function handleImageUpload() {
        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== 0) {
            throw new \Exception('No se recibió imagen válida');
        }
        
        $file = $_FILES['imagen'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Validar extensión
        if (!in_array($fileExt, Config::ALLOWED_IMAGE_TYPES)) {
            throw new \Exception('Tipo de archivo no permitido. Solo: jpg, jpeg, png');
        }
        
        // Validar tamaño
        if ($file['size'] > Config::MAX_FILE_SIZE) {
            throw new \Exception('Archivo demasiado grande (máx 2MB)');
        }
        
        // Generar nombre único
        $fileName = uniqid('prod_', true) . '.' . $fileExt;
        $targetPath = Config::UPLOAD_DIR . $fileName;
        
        // Mover archivo
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return Config::DB_IMG_PATH . $fileName;
        }
        
        return false;
    }
    
    /**
     * Obtener nombre de categoría por ID
     */
    private function getCategoryName($categoryId) {
        $db = \App\Config\Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT nombre FROM categorias WHERE id_categoria = ?");
        $stmt->bind_param('i', $categoryId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return $result['nombre'] ?? 'Sin categoría';
    }
}