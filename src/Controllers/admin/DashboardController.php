<?php 
namespace App\Controllers\Admin;

use App\Config\Database;
use App\Services\AuthService;
use App\Helpers\View;

class DashboardController {
    private $db;
    private $authService;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->authService = new AuthService();
    }
    
    /**
     * Mostrar dashboard con estadísticas
     */
    public function index() {
        try {
            // Verificar que sea admin
            $this->authService->requireAdmin();
            
            // Obtener estadísticas
            $stats = $this->getStats();
            
            View::renderAdmin('dashboard', [
                'stats' => $stats,
                'pageTitle' => 'Dashboard'
            ]);
            
        } catch (\Exception $e) {
            View::redirect('login', 'error', 'Acceso no autorizado');
        }
    }
    
    /**
     * Obtener estadísticas del sistema
     */
    private function getStats() {
        $stats = [];
        
        $stats['total_users'] = $this->db->query(
            "SELECT COUNT(*) as total FROM usuarios"
        )->fetch_assoc()['total'];
        
        $stats['total_products'] = $this->db->query(
            "SELECT COUNT(*) as total FROM productos"
        )->fetch_assoc()['total'];
        
        $stats['total_orders'] = $this->db->query(
            "SELECT COUNT(*) as total FROM pedidos"
        )->fetch_assoc()['total'];
        
        $stats['pending_orders'] = $this->db->query(
            "SELECT COUNT(*) as total FROM pedidos WHERE state = 'pendiente'"
        )->fetch_assoc()['total'];
        
        return $stats;
    }
}