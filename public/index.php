<?php
/**
 * Front Controller
 * 
 * IMPORTANTE: Este archivo debe ser LIMPIO
 * - Solo configuración básica
 * - Registro de rutas
 * - Despacho del router
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Autoloader (si usas Composer, solo require del autoload.php)
require_once __DIR__ . '/../src/autoload.php';

use App\Router;
use App\Services\AuthService;
use App\Helpers\Session;
use App\Config\Config;

// Iniciar sesión
Session::start();

// Verificar autenticación automática (cookies "recordarme")
if (!Session::isLoggedIn() && !Session::isAdmin()) {
    $authService = new AuthService();
    $authService->checkRememberMe();
}

// Crear router
$router = new Router();

// ============================================
// REGISTRO DE RUTAS
// ============================================

// --- Rutas Públicas (GET) ---
$router->get('home', 'App\Controllers\HomeController', 'index');
$router->get('shop', 'App\Controllers\ProductController', 'index');
$router->get('shop-single', 'App\Controllers\ProductController', 'show');
$router->get('contact', 'App\Controllers\PageController', 'contact');
$router->get('about', 'App\Controllers\PageController', 'about');

// --- Rutas de Autenticación ---
$router->get('login', 'App\Controllers\AuthController', 'showLogin');
$router->post('login', 'App\Controllers\AuthController', 'login');
$router->get('register', 'App\Controllers\AuthController', 'showRegister');
$router->post('register', 'App\Controllers\AuthController', 'register');
$router->post('logout', 'App\Controllers\AuthController', 'logout');

// --- Rutas del Carrito ---
$router->get('cart', 'App\Controllers\CartController', 'index');
$router->post('cart-add', 'App\Controllers\CartController', 'add');
$router->post('cart-update', 'App\Controllers\CartController', 'update');
$router->get('cart-remove', 'App\Controllers\CartController', 'remove');

// --- Rutas de Checkout ---
$router->get('checkout', 'App\Controllers\CheckoutController', 'index');
$router->post('checkout-process', 'App\Controllers\CheckoutController', 'process');

// --- Rutas de Usuario ---
$router->get('profile', 'App\Controllers\UserController', 'show');
$router->post('profile-update', 'App\Controllers\UserController', 'update');
$router->post('profile-delete', 'App\Controllers\UserController', 'delete');

// --- Rutas de Administrador ---
$router->get('dashboard', 'App\Controllers\Admin\DashboardController', 'index');
$router->get('admin_products', 'App\Controllers\Admin\ProductController', 'index');
$router->get('admin_create_product', 'App\Controllers\Admin\ProductController', 'create');
$router->post('admin_store_product', 'App\Controllers\Admin\ProductController', 'store');
$router->get('admin_users', 'App\Controllers\Admin\UserController', 'index');
$router->get('admin_orders', 'App\Controllers\Admin\OrderController', 'index');

// Despachar la ruta
$router->dispatch();