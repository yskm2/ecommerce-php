<?php 
namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Helpers\View;
use App\Services\AuthService;
use App\Config\Config;

class ProductController {
    private $productModel;
    private $authService;
    
    public function __construct() {
        $this->productModel = new Product();
        $this->authService = new AuthService();
    }
    
    /**
     * Listar productos (tienda)
     */
    public function index() {
        // Obtener filtros de URL
        $filters = [
            'categoria' => $_GET['categoria'] ?? null,
            'orden' => $_GET['orden'] ?? 'newest'
        ];
        
        // Obtener datos
        $products = $this->productModel->getAll($filters);
        $categories = $this->productModel->getCategories();
        
        // Renderizar
        View::render('products/index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $filters['categoria'],
            'currentOrder' => $filters['orden'],
            'pageTitle' => 'Tienda'
        ]);
    }
    
    /**
     * Ver un producto individual
     */
    public function show() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            View::redirect('shop');
            return;
        }
        
        $product = $this->productModel->findById($id);
        
        if (!$product) {
            View::redirect('shop');
            return;
        }
        
        View::render('products/show', [
            'product' => $product,
            'pageTitle' => $product['nombre']
        ]);
    }
    
    /**
     * Mostrar formulario de crear producto (admin)
     */
    public function create() {
        try {
            // Verificar que sea admin
            $this->authService->requireAdmin();
            
            // Obtener categorías para el select
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
     * Guardar nuevo producto (admin)
     */
    public function store() {
        try {
            $this->authService->requireAdmin();
            
            // Validar datos POST
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = floatval($_POST['precio'] ?? 0);
            $stock = intval($_POST['stock'] ?? 0);
            $idCategoria = intval($_POST['id_categoria'] ?? 0);
            
            if (empty($nombre) || $precio <= 0 || $stock < 0 || $idCategoria <= 0) {
                View::redirect('admin_create_product', 'error', 'Datos inválidos');
                return;
            }
            
            // Manejar subida de imagen
            $imagePath = $this->handleImageUpload();
            
            if (!$imagePath) {
                View::redirect('admin_create_product', 'error', 'Error al subir imagen');
                return;
            }
            
            // Obtener nombre de categoría (si tu BD lo necesita)
            $categoryName = $this->getCategoryName($idCategoria);
            
            // Crear producto
            $productId = $this->productModel->create([
                'nombre' => $nombre,
                'categoria_nombre' => $categoryName,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'stock' => $stock,
                'imagen' => $imagePath,
                'id_categoria' => $idCategoria
            ]);
            
            if ($productId) {
                View::redirect('admin_products', 'success', 'Producto creado exitosamente');
            } else {
                View::redirect('admin_create_product', 'error', 'Error al crear producto');
            }
            
        } catch (\Exception $e) {
            View::redirect('admin_create_product', 'error', $e->getMessage());
        }
    }
    
    /**
     * Manejar subida de imagen
     * SEPARACIÓN: Lógica de archivos en método privado
     */
    private function handleImageUpload() {
        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== 0) {
            return false;
        }
        
        $file = $_FILES['imagen'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Validar extensión
        if (!in_array($fileExt, Config::ALLOWED_IMAGE_TYPES)) {
            throw new \Exception('Tipo de archivo no permitido');
        }
        
        // Validar tamaño
        if ($file['size'] > Config::MAX_FILE_SIZE) {
            throw new \Exception('Archivo demasiado grande');
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
     * Helper para obtener nombre de categoría
     */
    private function getCategoryName($categoryId) {
        // Implementar según tu estructura de BD
        return 'Categoría'; // Placeholder
    }
}