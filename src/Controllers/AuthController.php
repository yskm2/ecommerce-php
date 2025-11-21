<?php 
namespace App\Controllers;

use App\Services\AuthService;
use App\Helpers\View;

class AuthController {
    private $authService;
    
    public function __construct() {
        $this->authService = new AuthService();
    }
    
    /**
     * Mostrar formulario de login
     */
    public function showLogin() {
        View::renderSimple('auth/login', [
            'pageTitle' => 'Iniciar Sesión'
        ]);
    }
    
    /**
     * Procesar login
     */
    public function login() {
        $credential = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $rememberMe = isset($_POST['rememberme']);
        
        if (empty($credential) || empty($password)) {
            View::redirect('login', 'error', 'Faltan datos');
            return;
        }
        
        $result = $this->authService->login($credential, $password, $rememberMe);
        
        if ($result['success']) {
            View::redirect($result['redirect'], 'success', $result['message']);
        } else {
            View::redirect('login', 'error', $result['message']);
        }
    }
    
    /**
     * Mostrar formulario de registro
     */
    public function showRegister() {
        View::renderSimple('auth/register', [
            'pageTitle' => 'Registro'
        ]);
    }
    
    /**
     * Procesar registro
     */
    public function register() {
        // Validar método POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            View::redirect('register');
            return;
        }
        
        $data = [
            'username' => trim($_POST['username'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'email' => trim($_POST['email'] ?? ''),
            'telefono' => trim($_POST['phone'] ?? '')
        ];
        
        // Validar datos básicos
        if (empty($data['username']) || empty($data['password']) || empty($data['email'])) {
            View::redirect('register', 'error', 'Todos los campos son requeridos');
            return;
        }
        
        // Validar longitud de contraseña
        if (strlen($data['password']) < 6) {
            View::redirect('register', 'error', 'La contraseña debe tener al menos 6 caracteres');
            return;
        }
        
        // Validar formato de email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            View::redirect('register', 'error', 'El email no es válido');
            return;
        }
        
        $result = $this->authService->register($data);
        
        if ($result['success']) {
            View::redirect('login', 'success', '¡Registro exitoso! Ahora puedes iniciar sesión.');
        } else {
            View::redirect('register', 'error', $result['message']);
        }
    }
    
    /**
     * Cerrar sesión
     */
    public function logout() {
        $this->authService->logout();
        View::redirect('home', 'success', 'Sesión cerrada correctamente');
    }
}