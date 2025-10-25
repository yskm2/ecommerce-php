<?php
namespace App\Services;

use App\Models\User;
use App\Helpers\Session;

/**
 * AuthService - Lógica de autenticación y autorización
 * 
 * RESPONSABILIDAD: Todo lo relacionado con login, registro, permisos
 */
class AuthService {
    private $userModel;
    private $cartService;
    
    public function __construct() {
        $this->userModel = new User();
        $this->cartService = new CartService();
    }
    
    /**
     * Intentar iniciar sesión
     * @return array ['success' => bool, 'message' => string, 'redirect' => string]
     */
    public function login($credential, $password, $rememberMe = false) {
        // Buscar usuario
        $user = $this->userModel->findByCredentials($credential);
        
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Credenciales incorrectas'
            ];
        }
        
        // Verificar contraseña
        if (!password_verify($password, $user['password'])) {
            return [
                'success' => false,
                'message' => 'Credenciales incorrectas'
            ];
        }
        
        // Regenerar ID de sesión por seguridad
        session_regenerate_id(true);
        
        // Establecer datos de sesión según el rol
        Session::set('id', $user['id']);
        Session::set('name', !empty($user['nombre']) ? $user['nombre'] : $user['username']);
        
        if ($user['rol'] === 'admin') {
            // Usuario administrador
            Session::set('is_admin', true);
            $redirect = 'dashboard';
        } else {
            // Usuario regular
            Session::set('loggedin', true);
            
            // Sincronizar carrito desde BD
            $this->cartService->syncFromDatabase($user['id']);
            
            $redirect = 'home';
        }
        
        // Manejar "recordarme"
        if ($rememberMe) {
            $this->setRememberMeCookie($user['id']);
        }
        
        return [
            'success' => true,
            'message' => 'Login exitoso',
            'redirect' => $redirect
        ];
    }
    
    /**
     * Registrar nuevo usuario
     */
    public function register($data) {
        // Validar que el email no exista
        if ($this->userModel->emailExists($data['email'])) {
            return [
                'success' => false,
                'message' => 'El email ya está registrado'
            ];
        }
        
        // Crear usuario
        if ($this->userModel->create($data)) {
            return [
                'success' => true,
                'message' => 'Registro exitoso. Puedes iniciar sesión.'
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Error al crear usuario'
        ];
    }
    
    /**
     * Cerrar sesión
     */
    public function logout() {
        // Limpiar cookies de "recordarme"
        if (isset($_COOKIE['remember_me_id'])) {
            setcookie('remember_me_id', '', time() - 3600, '/');
        }
        if (isset($_COOKIE['remember_me_token'])) {
            setcookie('remember_me_token', '', time() - 3600, '/');
        }
        
        // Destruir sesión
        Session::destroy();
    }
    
    /**
     * Verificar autenticación automática con cookies
     */
    public function checkRememberMe() {
        if (!isset($_COOKIE['remember_me_id'], $_COOKIE['remember_me_token'])) {
            return false;
        }
        
        $userId = $_COOKIE['remember_me_id'];
        $token = $_COOKIE['remember_me_token'];
        
        $user = $this->userModel->findById($userId);
        
        if (!$user) {
            return false;
        }
        
        // Verificar token y que no haya expirado
        if (hash_equals($user['remember_me_token'], $token) && 
            strtotime($user['token_expiry']) > time()) {
            
            // Iniciar sesión automáticamente
            session_regenerate_id(true);
            Session::set('id', $user['id']);
            Session::set('name', !empty($user['nombre']) ? $user['nombre'] : $user['username']);
            
            if ($user['rol'] === 'admin') {
                Session::set('is_admin', true);
            } else {
                Session::set('loggedin', true);
                $this->cartService->syncFromDatabase($user['id']);
            }
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Establecer cookie de "recordarme"
     */
    private function setRememberMeCookie($userId) {
        $token = bin2hex(random_bytes(32));
        $expiryTime = time() + (86400 * 30); // 30 días
        $expiryDate = date('Y-m-d H:i:s', $expiryTime);
        
        // Guardar en BD
        $this->userModel->updateRememberToken($userId, $token, $expiryDate);
        
        // Establecer cookies
        setcookie('remember_me_id', $userId, $expiryTime, '/', '', false, true);
        setcookie('remember_me_token', $token, $expiryTime, '/', '', false, true);
    }
    
    /**
     * Verificar si el usuario actual es admin
     */
    public function requireAdmin() {
        if (!Session::isAdmin()) {
            throw new \Exception('Acceso no autorizado');
        }
    }
    
    /**
     * Verificar si el usuario está logueado
     */
    public function requireAuth() {
        if (!Session::isLoggedIn()) {
            throw new \Exception('Debes iniciar sesión');
        }
    }
}