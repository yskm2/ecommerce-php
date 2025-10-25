<?php
namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\AuthService;
use App\Helpers\View;

class UserController {
    private $userModel;
    private $authService;
    
    public function __construct() {
        $this->userModel = new User();
        $this->authService = new AuthService();
    }
    
    /**
     * Listar todos los usuarios
     */
    public function index() {
        try {
            $this->authService->requireAdmin();
            
            $users = $this->userModel->getAll();
            
            View::renderAdmin('users/index', [
                'users' => $users,
                'pageTitle' => 'Gestionar Usuarios'
            ]);
            
        } catch (\Exception $e) {
            View::redirect('login', 'error', 'Acceso no autorizado');
        }
    }
}