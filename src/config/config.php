<?php
namespace App\Config;

class Config {
    // URL base del proyecto
    const BASE_URL = 'http://localhost/proyectophp/public/';
    
    // Rutas de subida de archivos
    const UPLOAD_DIR = '../public/assets/img/componentes/';
    const DB_IMG_PATH = 'assets/img/componentes/';
    
    // Configuración de archivos
    const ALLOWED_IMAGE_TYPES = ['jpg', 'jpeg', 'png'];
    const MAX_FILE_SIZE = 2097152; // 2MB en bytes
    
    // Configuración de carrito
    const SHIPPING_COST = 150.00;
    
    // Estados de pedidos
    const ORDER_STATUS = [
        'pendiente',
        'procesando',
        'enviado',
        'completado',
        'cancelado'
    ];
}