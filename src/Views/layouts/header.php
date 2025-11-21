<?php
// src/views/layouts/header.php
use App\Config\Config;
// La lógica de cookies y session_start() ya no vive aquí.
// El router (public/index.php) se encarga de eso.

// Calculamos la cantidad de items en el carrito.
// Esto es lógica de PRESENTACIÓN, por lo que está bien que esté aquí.
$items_en_carrito = 0;
if (!empty($_SESSION['carrito'])) {
    $items_en_carrito = array_sum(array_column($_SESSION['carrito'], 'cantidad'));
}
?>
<header class="main-header">
    <div class="container header-content">
        <a class="logo" href="<?= $BASE_URL ?>index.php?route=home">eBrainrot</a>
        <ul class="main-nav">
            <li><a class="nav-link" href="<?= $BASE_URL ?>index.php?route=home">Inicio</a></li>
            <li><a class="nav-link" href="<?= $BASE_URL ?>index.php?route=shop">Productos</a></li>
            <li><a class="nav-link" href="<?= $BASE_URL ?>index.php?route=contact">Contacto</a></li>
            <li><a class="nav-link" href="<?= $BASE_URL ?>index.php?route=about">Acerca de</a></li>
        </ul>
        <div class="header-icons">
            <a class="nav-icon" href="#"><i class="fa fa-fw fa-search"></i></a>
            
            <a class="nav-icon cart-icon" href="<?= $BASE_URL ?>index.php?route=cart">
                <i class="fa fa-fw fa-cart-arrow-down"></i>
                <?php if ($items_en_carrito > 0): ?>
                    <span class="cart-count"><?= $items_en_carrito ?></span>
                <?php endif; ?>
            </a>
            
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a class="nav-icon" href="<?= $BASE_URL ?>index.php?route=profile"><i class="fa fa-fw fa-user"></i></a>
                <div class="user-info">
                    <span>Usuario: &nbsp;<?= htmlspecialchars($_SESSION['name'] ?? 'Invitado') ?>!</span>
                    <form action="<?= $BASE_URL ?>index.php?route=logout" method="post" class="inline-form">
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="btn-danger">Cerrar Sesión</button>
                    </form>
                </div>
            <?php else: ?>
                <a class="nav-icon" href="<?= $BASE_URL ?>index.php?route=login"><i class="fa fa-fw fa-user"></i> Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </div>
</header>