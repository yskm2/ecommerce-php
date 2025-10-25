<?php 
namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Helpers\Session;
use App\Config\Config;


/**
 * CartService - Lógica de negocio del carrito
 * 
 * IMPORTANTE: Los Services contienen lógica compleja que involucra
 * múltiples modelos o cálculos. No acceden directamente a la BD.
 */
class CartService {
    private $cartModel;
    private $productModel;
    
    public function __construct() {
        $this->cartModel = new Cart();
        $this->productModel = new Product();
    }
    
    /**
     * Agregar producto al carrito
     * Sincroniza sesión y BD si hay usuario logueado
     */
    public function addToCart($productData) {
        // Validar que el producto exista y tenga stock
        if (!$this->productModel->hasStock($productData['id'], $productData['cantidad'])) {
            throw new \Exception('Producto sin stock suficiente');
        }
        
        // Obtener carrito de sesión
        $cart = Session::get('carrito', []);
        $id = $productData['id'];
        
        // Agregar o actualizar en sesión
        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] += $productData['cantidad'];
        } else {
            $cart[$id] = [
                'nombre' => $productData['nombre'],
                'precio' => $productData['precio'],
                'cantidad' => $productData['cantidad'],
                'imagen' => $productData['imagen']
            ];
        }
        
        Session::set('carrito', $cart);
        
        // Si hay usuario logueado, sincronizar con BD
        if (Session::isLoggedIn()) {
            $this->cartModel->addItem(
                Session::getUserId(),
                $id,
                $productData['cantidad']
            );
        }
        
        return true;
    }
    
    /**
     * Actualizar cantidad de un producto
     */
    public function updateQuantity($productId, $action) {
        $cart = Session::get('carrito', []);
        
        if (!isset($cart[$productId])) {
            return false;
        }
        
        // Actualizar cantidad según la acción
        if ($action === 'sumar') {
            $cart[$productId]['cantidad']++;
        } elseif ($action === 'restar') {
            $cart[$productId]['cantidad']--;
        }
        
        // Si cantidad llega a 0, eliminar del carrito
        if ($cart[$productId]['cantidad'] <= 0) {
            unset($cart[$productId]);
        }
        
        Session::set('carrito', $cart);
        
        // Sincronizar con BD si hay usuario
        if (Session::isLoggedIn()) {
            if (isset($cart[$productId])) {
                // Actualizar cantidad en BD
                $item = $this->cartModel->getItem(Session::getUserId(), $productId);
                if ($item) {
                    $this->cartModel->updateQuantity($item['id'], $cart[$productId]['cantidad']);
                }
            } else {
                // Eliminar de BD
                $item = $this->cartModel->getItem(Session::getUserId(), $productId);
                if ($item) {
                    $this->cartModel->removeItem($item['id']);
                }
            }
        }
        
        return true;
    }
    
    /**
     * Eliminar producto del carrito
     */
    public function removeFromCart($productId) {
        $cart = Session::get('carrito', []);
        unset($cart[$productId]);
        Session::set('carrito', $cart);
        
        // Eliminar de BD si hay usuario
        if (Session::isLoggedIn()) {
            $item = $this->cartModel->getItem(Session::getUserId(), $productId);
            if ($item) {
                $this->cartModel->removeItem($item['id']);
            }
        }
        
        return true;
    }
    
    /**
     * Obtener carrito actual
     */
    public function getCart() {
        return Session::get('carrito', []);
    }
    
    /**
     * Calcular subtotal del carrito
     */
    public function getSubtotal() {
        $cart = $this->getCart();
        $subtotal = 0;
        
        foreach ($cart as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }
        
        return $subtotal;
    }
    
    /**
     * Calcular total incluyendo envío
     */
    public function getTotal() {
        return $this->getSubtotal() + Config::SHIPPING_COST;
    }
    
    /**
     * Obtener cantidad total de items
     */
    public function getItemCount() {
        $cart = $this->getCart();
        
        if (empty($cart)) {
            return 0;
        }
        
        return array_sum(array_column($cart, 'cantidad'));
    }
    
    /**
     * Sincronizar carrito desde BD al iniciar sesión
     */
    public function syncFromDatabase($userId) {
        $dbCart = $this->cartModel->getUserCart($userId);
        Session::set('carrito', $dbCart);
    }
    
    /**
     * Limpiar carrito completamente
     */
    public function clearCart() {
        Session::set('carrito', []);
        
        if (Session::isLoggedIn()) {
            $this->cartModel->clearUserCart(Session::getUserId());
        }
    }
}