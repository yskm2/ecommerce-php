<?php 
namespace App\Controllers;

use App\Services\OrderService;
use App\Services\AuthService;
use App\Helpers\View;

class CheckoutController {
    private $orderService;
    private $authService;
    
    public function __construct() {
        $this->orderService = new OrderService();
        $this->authService = new AuthService();
    }
    
    /**
     * Mostrar página de checkout
     */
    public function index() {
        try {
            // Verificar autenticación
            $this->authService->requireAuth();
            
            // Obtener datos para el checkout
            $data = $this->orderService->getCheckoutData();
            $data['pageTitle'] = 'Finalizar Compra';
            
            View::render('checkout/index', $data);
            
        } catch (\Exception $e) {
            View::redirect('login', 'error', $e->getMessage());
        }
    }
    
    /**
     * Procesar pedido
     */
    public function process() {
        try {
            $this->authService->requireAuth();
            
            // Procesar el pedido
            $result = $this->orderService->processOrder($_POST);
            
            View::redirect('cart', 'success', $result['message']);
            
        } catch (\Exception $e) {
            View::redirect('checkout', 'error', $e->getMessage());
        }
    }
}