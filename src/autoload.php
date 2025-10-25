<?php
/**
 * Autoloader PSR-4 simplificado
 * 
 * MEJOR OPCIÓN: Usar Composer con autoload PSR-4
 * Pero si no quieres Composer, este autoloader funciona
 */

spl_autoload_register(function ($class) {
    // Convertir namespace a ruta de archivo
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/';
    
    // Verificar si la clase usa nuestro namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // Obtener el nombre relativo de la clase
    $relativeClass = substr($class, $len);
    
    // Convertir namespace separators a directory separators
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    
    // Cargar el archivo si existe
    if (file_exists($file)) {
        require $file;
    }
});