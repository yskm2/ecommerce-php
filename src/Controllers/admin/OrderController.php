<?php
namespace App\Controllers\Admin;

use App\Models\Order;
use App\Services\AuthService;
use App\Helpers\View;

class OrderController {
    private $orderModel;
    private $authService;
    
    public function __construct() {
        $this->orderModel = new Order();
        $this->authService = new AuthService();
    }
    
    /**
     * Listar todos los pedidos
     */
    public function index() {
        try {
            $this->authService->requireAdmin();
            
            $orders = $this->orderModel->getAll();
            
            View::renderAdmin('orders/index', [
                'orders' => $orders,
                'pageTitle' => 'Gestionar Pedidos'
            ]);
            
        } catch (\Exception $e) {
            View::redirect('login', 'error', 'Acceso no autorizado');
        }
    }
}
