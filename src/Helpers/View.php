<?php
namespace App\Helpers;

use App\Config\Config;
use App\Services\CartService;

/**
 * Helper para renderizar vistas
 * SEPARACIÓN: Toda la lógica de renderizado en un solo lugar
 */
class View {
    
    /**
     * Renderizar vista normal (con header/footer)
     */
    public static function render($view, $data = []) {
        // Extraer variables para que estén disponibles en la vista
        extract($data);
        
        // Variables globales útiles en todas las vistas
        $BASE_URL = Config::BASE_URL;
        $cartService = new CartService();
        $items_en_carrito = $cartService->getItemCount();
        
        // Variables de autenticación para el header
        $loggedin = Session::get('loggedin') ?? false;
        $user_name = Session::get('name') ?? 'Invitado';
        
        // Usar output buffering para capturar todo el HTML
        ob_start();
        
        include __DIR__ . '/../Views/layouts/head.php';
        include __DIR__ . '/../Views/layouts/header.php';
        include __DIR__ . "/../Views/{$view}.php";
        include __DIR__ . '/../Views/layouts/footer.php';
        
        echo ob_get_clean();
    }
    
    /**
     * Renderizar vista de administrador
     */
    public static function renderAdmin($view, $data = []) {
        extract($data);
        $BASE_URL = Config::BASE_URL;
        
        ob_start();
        
        include __DIR__ . '/../Views/layouts/admin_head.php';
        // admin_sidebar.php removed - using topbar with hamburger menu only
        include __DIR__ . "/../Views/admin/{$view}.php";
        include __DIR__ . '/../Views/layouts/admin_footer.php';
        
        echo ob_get_clean();
    }
    
    /**
     * Renderizar vista sin layout (login, register)
     */
    public static function renderSimple($view, $data = []) {
        extract($data);
        $BASE_URL = Config::BASE_URL;
        ob_start();
        include __DIR__ . '/../Views/layouts/head.php';
        include __DIR__ . "/../Views/{$view}.php";
        include __DIR__ . '/../Views/layouts/footer.php';
        echo ob_get_clean();
    }
    
    /**
     * Redireccionar con mensaje flash
     */
    public static function redirect($route, $flashType = null, $flashMessage = null) {
        if ($flashType && $flashMessage) {
            Session::setFlashMessage($flashType, $flashMessage);
        }
        
        header('Location: ' . Config::BASE_URL . 'index.php?route=' . $route);
        exit;
    }
}