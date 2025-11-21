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
            
            <?php if ($loggedin): ?>
                <a class="nav-icon" href="<?= $BASE_URL ?>index.php?route=profile"><i class="fa fa-fw fa-user"></i></a>
                <div class="user-info">
                    <span>Usuario: &nbsp;<?= htmlspecialchars($user_name) ?>!</span>
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