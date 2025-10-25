<?php
namespace App\Controllers;

use App\Helpers\View;

/**
 * PageController - Para páginas simples sin lógica compleja
 */
class PageController {
    
    public function about() {
        View::render('pages/about', [
            'pageTitle' => 'Acerca de Nosotros'
        ]);
    }
    
    public function contact() {
        View::render('pages/contact', [
            'pageTitle' => 'Contacto'
        ]);
    }
}