<?php
namespace App\Helpers;

/**
 * Helper para manejo de sesiones
 * VENTAJA: Toda la lógica de sesión en un solo lugar
 */
class Session {
    
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }
    
    public static function has($key) {
        return isset($_SESSION[$key]);
    }
    
    public static function remove($key) {
        unset($_SESSION[$key]);
    }
    
    public static function destroy() {
        session_destroy();
        $_SESSION = [];
    }
    
    // Helpers específicos de la app
    public static function isLoggedIn() {
        return self::has('loggedin') && self::get('loggedin') === true;
    }
    
    public static function isAdmin() {
        return self::has('is_admin') && self::get('is_admin') === true;
    }
    
    public static function getUserId() {
        return self::get('id');
    }
    
    public static function setFlashMessage($type, $message) {
        self::set('flash_message', [
            'type' => $type,
            'message' => $message
        ]);
    }
    
    public static function getFlashMessage() {
        $flash = self::get('flash_message');
        self::remove('flash_message');
        return $flash;
    }
}