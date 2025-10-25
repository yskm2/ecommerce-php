<?php
namespace App\Controllers;

use App\Models\User;
use App\Services\AuthService;
use App\Helpers\View;
use App\Helpers\Session;

class UserController {
    private $userModel;
    private $authService;
    
    public function __construct() {
        $this->userModel = new User();
        $this->authService = new AuthService();
    }
    
    /**
     * Mostrar perfil del usuario
     */
    public function show() {
        try {
            $this->authService->requireAuth();
            
            $user = $this->userModel->findById(Session::getUserId());
            
            View::render('user/profile', [
                'user' => $user,
                'pageTitle' => 'Mi Perfil'
            ]);
            
        } catch (\Exception $e) {
            View::redirect('login', 'error', 'Debes iniciar sesión');
        }
    }
    
    /**
     * Actualizar datos del usuario
     */
    public function update() {
        try {
            $this->authService->requireAuth();
            
            $userId = Session::getUserId();
            
            // Validar datos
            $data = [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'apellido' => trim($_POST['apellido'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'telefono' => trim($_POST['telefono'] ?? ''),
                'direccion' => trim($_POST['direccion'] ?? '')
            ];
            
            if (empty($data['nombre']) || empty($data['email'])) {
                View::redirect('profile', 'error', 'Nombre y email son obligatorios');
                return;
            }
            
            // Verificar que el email no esté en uso por otro usuario
            if ($this->userModel->emailExists($data['email'], $userId)) {
                View::redirect('profile', 'error', 'El email ya está en uso');
                return;
            }
            
            // Actualizar usuario
            if ($this->userModel->update($userId, $data)) {
                View::redirect('profile', 'success', 'Perfil actualizado correctamente');
            } else {
                View::redirect('profile', 'error', 'Error al actualizar perfil');
            }
            
        } catch (\Exception $e) {
            View::redirect('profile', 'error', $e->getMessage());
        }
    }
    
    /**
     * Eliminar cuenta de usuario
     */
    public function delete() {
        try {
            $this->authService->requireAuth();
            
            $userId = Session::getUserId();
            
            if ($this->userModel->delete($userId)) {
                $this->authService->logout();
                View::redirect('home', 'success', 'Cuenta eliminada correctamente');
            } else {
                View::redirect('profile', 'error', 'Error al eliminar cuenta');
            }
            
        } catch (\Exception $e) {
            View::redirect('profile', 'error', $e->getMessage());
        }
    }
}