<?php 
namespace App\Controllers;

use App\Models\Product;
use App\Helpers\View;

/**
 * HomeController
 * 
 * PRINCIPIO: Los controladores son DELGADOS
 * - No tienen lógica compleja
 * - Solo coordinan entre Modelos/Services y Vistas
 */
class HomeController {
    private $productModel;
    
    public function __construct() {
        $this->productModel = new Product();
    }
    
    /**
     * Mostrar página de inicio
     */
    public function index() {
        // Obtener productos destacados
        $featuredProducts = $this->productModel->getFeatured(6);
        
        // Renderizar vista
        View::render('home/index', [
            'productos_destacados' => $featuredProducts,
            'pageTitle' => 'Inicio - eBrainrot'
        ]);
    }
}