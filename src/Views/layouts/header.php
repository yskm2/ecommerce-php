<?php
/**
 * Layout: Header
 * Variables esperadas:
 * - $BASE_URL (string): URL base de la aplicación
 * - $items_en_carrito (int): Cantidad total de items en el carrito
 * - $loggedin (bool): Si el usuario está autenticado
 * - $user_name (string): Nombre del usuario autenticado
 */
use App\Config\Config;

$items_en_carrito = $items_en_carrito ?? 0;
$loggedin = $loggedin ?? false;
$user_name = $user_name ?? 'Invitado';
?>
<header class="main-header">
    <div class="container header-content">
        <a class="logo" href="<?= $BASE_URL ?>index.php?route=home">eBrainrot</a>
        
        <!-- Menú hamburguesa para móviles -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <nav class="main-nav-wrapper">
            <ul class="main-nav" id="mainNav">
                <li><a class="nav-link" href="<?= $BASE_URL ?>index.php?route=home">Inicio</a></li>
                <li><a class="nav-link" href="<?= $BASE_URL ?>index.php?route=shop">Productos</a></li>
                <li><a class="nav-link" href="<?= $BASE_URL ?>index.php?route=contact">Contacto</a></li>
                <li><a class="nav-link" href="<?= $BASE_URL ?>index.php?route=about">Acerca de</a></li>
                
                <!-- Opciones móviles adicionales - SOLO PERFIL Y LOGOUT -->
                <?php if ($loggedin): ?>
                <li class="mobile-only">
                    <a class="nav-link" href="<?= $BASE_URL ?>index.php?route=profile">
                        <i class="fa fa-user"></i> Mi Perfil
                    </a>
                </li>
                <li class="mobile-only">
                    <form action="<?= $BASE_URL ?>index.php?route=logout" method="post" style="margin: 0;">
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="nav-link nav-link-button">
                            <i class="fa fa-sign-out"></i> Cerrar Sesión
                        </button>
                    </form>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <div class="header-icons">
            <a class="nav-icon cart-icon" href="<?= $BASE_URL ?>index.php?route=cart">
                <i class="fa fa-fw fa-cart-arrow-down"></i>
                <?php if ($items_en_carrito > 0): ?>
                    <span class="cart-count"><?= $items_en_carrito ?></span>
                <?php endif; ?>
            </a>
            
            <?php if ($loggedin): ?>
                <a class="nav-icon desktop-only" href="<?= $BASE_URL ?>index.php?route=profile"><i class="fa fa-fw fa-user"></i></a>
                <div class="user-info desktop-only">
                    <span>Usuario: &nbsp;<?= htmlspecialchars($user_name) ?>!</span>
                    <form action="<?= $BASE_URL ?>index.php?route=logout" method="post" class="inline-form">
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="btn-danger">Cerrar Sesión</button>
                    </form>
                </div>
            <?php else: ?>
                <a class="nav-icon" href="<?= $BASE_URL ?>index.php?route=login"><i class="fa fa-fw fa-user"></i></a>
            <?php endif; ?>
        </div>
    </div>
</header>

<script>
// Script para el menú hamburguesa
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mainNav = document.getElementById('mainNav');
    const navWrapper = document.querySelector('.main-nav-wrapper');
    
    if (mobileMenuToggle) {
        // Toggle menú al hacer clic en el botón
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            mainNav.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
        
        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!navWrapper.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                mobileMenuToggle.classList.remove('active');
                mainNav.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
        
        // Cerrar menú al hacer clic en un enlace
        const navLinks = mainNav.querySelectorAll('.nav-link, .nav-link-button');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenuToggle.classList.remove('active');
                mainNav.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });
    }
});
</script>