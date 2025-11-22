<?php
// src/views/layouts/head.php
use App\Config\Config;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Admin Panel' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= Config::BASE_URL ?>css/style.css">
</head>
<body>
    <?php $current_page = $_GET['route'] ?? 'dashboard'; ?>
    <!-- Topbar móvil solo para Admin -->
    <header class="admin-topbar" role="banner">
        <button id="adminHamburger" class="admin-hamburger" aria-label="Abrir menú de administración" aria-controls="adminMobileMenu" aria-expanded="false">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <div class="admin-topbar-title">Admin Panel</div>
    </header>

    <!-- Menú móvil (overlay) solo Admin -->
    <nav id="adminMobileMenu" class="admin-mobile-menu" aria-hidden="true">
        <ul>
            <li>
                <a href="<?= $BASE_URL ?>index.php?route=dashboard" class="<?= ($current_page == 'dashboard') ? 'active' : '' ?>">
                    <i class="fa fa-gauge"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="<?= $BASE_URL ?>index.php?route=admin_products" class="<?= ($current_page == 'admin_products') ? 'active' : '' ?>">
                    <i class="fa fa-box"></i> Productos
                </a>
            </li>
            <li>
                <a href="<?= $BASE_URL ?>index.php?route=admin_orders" class="<?= ($current_page == 'admin_orders') ? 'active' : '' ?>">
                    <i class="fa fa-receipt"></i> Pedidos
                </a>
            </li>
            <li>
                <a href="<?= $BASE_URL ?>index.php?route=admin_users" class="<?= ($current_page == 'admin_users') ? 'active' : '' ?>">
                    <i class="fa fa-users"></i> Usuarios
                </a>
            </li>
            <li class="menu-logout">
                <form action="<?= $BASE_URL ?>index.php?route=logout" method="POST" class="inline-form">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit" class="logout-button">
                        <i class="fa fa-right-from-bracket"></i> Cerrar Sesión
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="admin-container">