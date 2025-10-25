<?php 
namespace App\Controllers;

use App\Services\CartService;
use App\Helpers\View;

class CartController {
    private $cartService;
    
    public function __construct() {
        $this->cartService = new CartService();
    }
    
    /**
     * Mostrar carrito
     */
    public function index() {
        View::render('cart/index', [
            'pageTitle' => 'Tu Carrito'
        ]);
    }
    
    /**
     * Agregar producto al carrito
     */
    public function add() {
        try {
            // Validar datos POST
            $productData = [
                'id' => filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT),
                'nombre' => filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING),
                'precio' => filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT),
                'cantidad' => filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT),
                'imagen' => filter_input(INPUT_POST, 'imagen', FILTER_SANITIZE_URL)
            ];
            
            // Validar que todos los campos sean válidos
            if (!$productData['id'] || !$productData['precio'] || !$productData['cantidad']) {
                View::redirect('shop', 'error', 'Datos inválidos');
                return;
            }
            
            // Agregar al carrito
            $this->cartService->addToCart($productData);
            
            View::redirect('shop', 'success', 'Producto agregado al carrito');
            
        } catch (\Exception $e) {
            View::redirect('shop', 'error', $e->getMessage());
        }
    }
    
    /**
     * Actualizar cantidad
     */
    public function update() {
        $productId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $action = $_POST['update_action'] ?? '';
        
        if (!$productId || !in_array($action, ['sumar', 'restar'])) {
            View::redirect('cart', 'error', 'Datos inválidos');
            return;
        }
        
        $this->cartService->updateQuantity($productId, $action);
        View::redirect('cart');
    }
    
    /**
     * Eliminar producto
     */
    public function remove() {
        $productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$productId) {
            View::redirect('cart');
            return;
        }
        
        $this->cartService->removeFromCart($productId);
        View::redirect('cart', 'success', 'Producto eliminado');
    }
}
