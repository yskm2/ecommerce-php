<?php 
namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Helpers\Session;
use App\Config\Config;

/**
 * OrderService - Procesar pedidos
 * 
 * SEPARACIÓN: Toda la lógica compleja de crear pedidos está aquí
 */
class OrderService {
    private $orderModel;
    private $userModel;
    private $cartService;
    
    public function __construct() {
        $this->orderModel = new Order();
        $this->userModel = new User();
        $this->cartService = new CartService();
    }
    
    /**
     * Procesar un nuevo pedido
     */
    public function processOrder($formData) {
        // Verificar que haya items en el carrito
        $cart = $this->cartService->getCart();
        
        if (empty($cart)) {
            throw new \Exception('El carrito está vacío');
        }
        
        // Calcular totales (NUNCA confiar en el cliente)
        $subtotal = $this->cartService->getSubtotal();
        $total = $subtotal + Config::SHIPPING_COST;
        
        // Preparar datos del pedido
        $orderData = [
            'usuario_id' => Session::getUserId(),
            'nombre_completo' => trim($formData['nombre']) . ' ' . trim($formData['apellido']),
            'email' => filter_var($formData['email'], FILTER_VALIDATE_EMAIL),
            'telefono' => trim($formData['telefono']),
            'calle' => trim($formData['calle']),
            'numero' => trim($formData['numero']),
            'colonia' => trim($formData['colonia']),
            'ciudad' => trim($formData['ciudad']),
            'estado' => trim($formData['estado']),
            'codigo_postal' => trim($formData['codigo_postal']),
            'referencias' => trim($formData['referencias'] ?? ''),
            'total' => $total,
            'metodo_pago' => $formData['metodo_pago'] ?? 'no especificado',
            'notas' => trim($formData['notas'] ?? '')
        ];
        
        // Validar datos críticos
        if (!$orderData['email']) {
            throw new \Exception('Email inválido');
        }
        
        // Crear el pedido (con transacción incluida en el modelo)
        try {
            $orderId = $this->orderModel->create($orderData, $cart);
            
            // Limpiar carrito después de crear el pedido
            $this->cartService->clearCart();
            
            return [
                'success' => true,
                'order_id' => $orderId,
                'message' => '¡Tu pedido #' . $orderId . ' ha sido realizado con éxito!'
            ];
            
        } catch (\Exception $e) {
            throw new \Exception('Error al procesar el pedido: ' . $e->getMessage());
        }
    }
    
    /**
     * Obtener datos para la página de checkout
     */
    public function getCheckoutData() {
        $userId = Session::getUserId();
        
        return [
            'usuario' => $this->userModel->findById($userId),
            'direccion' => $this->orderModel->getLastShippingAddress($userId),
            'subtotal' => $this->cartService->getSubtotal(),
            'costo_envio' => Config::SHIPPING_COST,
            'total' => $this->cartService->getTotal()
        ];
    }
}