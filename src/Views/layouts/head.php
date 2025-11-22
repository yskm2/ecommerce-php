<?php
use App\Config\Config;
$page_title = $page_title ?? ($pageTitle ?? 'eBrainrot eCommerce');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#0a0a0f">
    <meta name="description" content="Tienda en línea de tecnología eBrainrot">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= Config::BASE_URL ?>css/style.css?v=<?= time() ?>">
    <style>
        /* FORZAR ESTILOS MÓVILES INMEDIATAMENTE */
        @media (max-width: 430px) {
            html { 
                font-size: 14px !important;
                height: auto !important;
            }
            body { 
                font-size: 14px !important; 
                line-height: 1.5 !important;
                padding-bottom: 0 !important;
                height: auto !important;
                min-height: 100vh !important;
            }
            .page-content {
                padding-bottom: 1rem !important;
                flex: 1 !important;
            }
            h1 { font-size: 1.5rem !important; }
            h2 { font-size: 1.3rem !important; }
            .container { padding: 0 0.5rem !important; max-width: 100% !important; }
            .hero-banner { padding: 0.75rem 0 !important; }
            .hero-title { font-size: 1.3rem !important; margin-bottom: 0.3rem !important; }
            .hero-subtitle { font-size: 0.7rem !important; margin-bottom: 0.4rem !important; }
            .hero-text p { font-size: 0.75rem !important; margin-bottom: 0.5rem !important; }
            .btn-primary, .btn-secondary { padding: 0.65rem 1rem !important; font-size: 0.85rem !important; }
            
            /* IMAGEN HERO SIN EFECTOS DE TARJETA */
            .hero-image::before { display: none !important; }
            .hero-image::after { display: none !important; }
            .hero-image { 
                background: transparent !important;
                box-shadow: none !important;
            }
            .hero-image img { 
                border-radius: 0 !important; 
                box-shadow: none !important; 
                border: none !important;
                opacity: 0.95 !important;
                filter: none !important;
                -webkit-border-radius: 0 !important;
                -moz-border-radius: 0 !important;
            }
            
            /* TARJETAS DE PRODUCTOS MÁS PEQUEÑAS */
            .shop-products-grid, .products-grid { 
                grid-template-columns: repeat(2, 1fr) !important; 
                gap: 0.5rem !important; 
            }
            .shop-product-card { 
                margin-bottom: 0 !important;
            }
            .card-image-container img {
                aspect-ratio: 1/1 !important;
                object-fit: cover !important;
            }
            .card-body { 
                padding: 0.5rem !important; 
            }
            .product-title { 
                font-size: 0.75rem !important; 
                line-height: 1.2 !important; 
                min-height: auto !important;
                margin-bottom: 0.25rem !important;
            }
            .product-price { 
                font-size: 0.85rem !important; 
                margin: 0.25rem 0 !important;
            }
            
            /* CATEGORÍAS MÁS PEQUEÑAS */
            .categories-section, .featured-products { padding: 0.5rem 0 !important; }
            .section-header { margin-bottom: 0.5rem !important; }
            .section-header h2 { font-size: 0.9rem !important; }
            .categories-grid { 
                gap: 0.4rem !important; 
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .category-item { 
                padding: 0.5rem !important; 
            }
            .category-img {
                aspect-ratio: 16/9 !important;
                width: 100% !important;
                max-height: 60px !important;
                object-fit: cover !important;
            }
            .category-title { 
                font-size: 0.75rem !important; 
                margin: 0.3rem 0 0.25rem !important; 
            }
            .category-item .btn-primary {
                padding: 0.3rem 0.6rem !important;
                font-size: 0.7rem !important;
            }
            
            /* FOOTER RESPONSIVO - BALANCE ENTRE TAMAÑO Y ESPACIO */
            .main-footer {
                padding: 0.6rem 0 0.4rem 0 !important;
                margin-top: 0.4rem !important;
                margin-bottom: 0 !important;
            }
            .footer-content {
                grid-template-columns: 1fr !important;
                gap: 0.4rem !important;
                padding-bottom: 0.2rem !important;
            }
            .footer-column {
                padding: 0.2rem 0 !important;
            }
            .footer-column h2 {
                font-size: 0.8rem !important;
                margin: 0 0 0.25rem 0 !important;
                font-weight: 600 !important;
            }
            .footer-column ul {
                margin: 0 !important;
                padding: 0 !important;
            }
            .footer-column li {
                font-size: 0.72rem !important;
                margin: 0.15rem 0 !important;
                line-height: 1.3 !important;
            }
            .footer-column li i {
                font-size: 0.68rem !important;
                margin-right: 0.25rem !important;
            }
            .footer-logo {
                font-size: 0.85rem !important;
                margin: 0 0 0.25rem 0 !important;
            }
            .copyright-bar {
                margin-top: 0.4rem !important;
                padding: 0.45rem 0 0.45rem 0 !important;
                font-size: 0.68rem !important;
            }
            .copyright-bar p {
                margin: 0 !important;
                padding: 0 !important;
            }
            
            /* Ocultar scrollbar en móvil */
            html, body {
                overflow-x: hidden !important;
            }
            body::-webkit-scrollbar {
                display: none !important;
            }
            body {
                -ms-overflow-style: none !important;
                scrollbar-width: none !important;
            }
            html::-webkit-scrollbar {
                display: none !important;
            }
            html {
                -ms-overflow-style: none !important;
                scrollbar-width: none !important;
            }
            
            /* AUTH PAGES - LOGIN Y REGISTER */
            .auth-page {
                padding: 0.3rem 0.4rem !important;
                min-height: auto !important;
                overflow-y: hidden !important;
            }
            .check-in-area {
                max-width: 100% !important;
                padding: 0.75rem 0.6rem !important;
                margin: 0 !important;
            }
            .titulo-logo h2 {
                font-size: 0.9rem !important;
                margin-bottom: 0.55rem !important;
            }
            .check-in-form .user,
            .check-in-form .password {
                margin-bottom: 0.45rem !important;
            }
            .check-in-form input {
                padding: 0.48rem 0.65rem 0.48rem 2.1rem !important;
                font-size: 0.78rem !important;
            }
            .check-in-form label {
                width: 2.1rem !important;
            }
            .check-in-form label i {
                font-size: 0.8rem !important;
            }
            .check-in-form button {
                padding: 0.5rem !important;
                font-size: 0.8rem !important;
                margin-top: 0.6rem !important;
            }
            .register-btn,
            .check-in-form a {
                font-size: 0.7rem !important;
                padding: 0.42rem !important;
                margin-top: 0.48rem !important;
            }
            .alert {
                font-size: 0.7rem !important;
                padding: 0.42rem !important;
                margin-bottom: 0.5rem !important;
            }
            .auth-footer {
                padding: 0.4rem 0 0.4rem 0 !important;
                font-size: 0.64rem !important;
            }
            
            .logo { font-size: 1rem !important; }
            input, textarea, select { font-size: 16px !important; padding: 0.65rem 0.85rem !important; }
            .mobile-only { display: none; }
            .desktop-only { display: inline-flex; }
            body, html { overflow-x: hidden !important; max-width: 100vw !important; }
            img { max-width: 100% !important; height: auto !important; }
        }
        
        /* Menú hamburguesa */
        .mobile-menu-toggle {
            display: none !important;
            flex-direction: column;
            justify-content: space-around;
            width: 32px;
            height: 32px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            z-index: 101;
        }
        
        .mobile-menu-toggle span {
            width: 100%;
            height: 3px;
            background: #a78bfa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .mobile-menu-toggle { display: flex !important; }
            .main-nav-wrapper {
                position: fixed;
                top: 0;
                right: -100%;
                width: 75vw;
                max-width: 280px;
                height: 100vh;
                background: rgba(20, 20, 32, 0.98);
                z-index: 99;
                transition: right 0.4s ease;
            }
            body.menu-open .main-nav-wrapper { right: 0; }
            .main-nav { display: flex !important; flex-direction: column; padding: 5rem 0 2rem; }
            .main-nav li { width: 100%; border-bottom: 1px solid rgba(167, 139, 250, 0.08); }
            .main-nav .nav-link { display: block; padding: 1rem 1.5rem; font-size: 1rem; color: #e8e8f2; }
            
            /* Botón cerrar sesión en rojo */
            .nav-link-button {
                background: linear-gradient(135deg, #f87171, #ef4444) !important;
                color: #fff !important;
                border-radius: 8px !important;
                font-weight: 600 !important;
                transition: all 0.3s ease !important;
            }
            .nav-link-button:hover {
                background: linear-gradient(135deg, #ef4444, #dc2626) !important;
                transform: translateX(4px) !important;
            }
            
            .mobile-only { display: block !important; }
            .desktop-only { display: none !important; }
        }
        
        /* Ocultar mobile-only en desktop */
        @media (min-width: 769px) {
            .mobile-only {
                display: none !important;
            }
        }
    </style>
</head>
<body>