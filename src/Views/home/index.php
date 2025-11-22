<?php
/**
 * Vista: Página de Inicio
 * Variables esperadas:
 * - $BASE_URL (string): URL base de la aplicación
 * - $productos_destacados (array): Lista de productos destacados
 */
$productos_destacados = $productos_destacados ?? [];
?>
<main class="page-content">
<section class="hero-banner" style="background-image: linear-gradient(to right, rgba(10, 10, 15, 0.85) 0%, rgba(10, 10, 15, 0.6) 35%, rgba(10, 10, 15, 0.15) 100%), url('<?= $BASE_URL ?>assets/img/setup.jpg'); background-size: 60% auto; background-position: right center; background-repeat: no-repeat;">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title"><b>eBrainrot</b> eCommerce</h1>
                <h2 class="hero-subtitle">Tu tienda confiable</h2>
                <p>
                    eBrainrot es una tienda en línea dirigida hacia la tecnología.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="categories-section">
    <div class="container">
        <div class="section-header">
            <h2>Categorías más relevantes</h2>
        </div>
        <div class="categories-grid">
            <div class="category-item">
                <a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Procesador">
                    <img src="<?= $BASE_URL ?>assets/img/amdintel.jpg" class="category-img">
                </a>
                <h5 class="category-title">Procesadores</h5>
                <p><a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Procesador" class="btn-primary">Comprar</a>
                </p>
            </div>
            <div class="category-item">
                <a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Tarjeta de Video">
                    <img src="<?= $BASE_URL ?>assets/img/amdnvidia.jpg" class="category-img">
                </a>
                <h5 class="category-title">Tarjetas de Video</h5>
                <p><a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Tarjeta de Video"
                        class="btn-primary">Comprar</a></p>
            </div>
            <div class="category-item">
                <a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Memoria RAM">
                    <img src="<?= $BASE_URL ?>assets/img/ram.png" class="category-img">
                </a>
                <h5 class="category-title">Memoria RAM</h5>
                <p><a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Memoria RAM" class="btn-primary">Comprar</a>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="featured-products">
    <div class="container">
        <div class="section-header">
            <h2>Productos Destacados</h2>
            <p>Descubre nuestras últimas novedades y los productos más populares.</p>
        </div>
        <div class="products-grid">
            <?php if (!empty($productos_destacados)): ?>
                <?php foreach ($productos_destacados as $producto): ?>
                    <?php $featured = true; include __DIR__ . '/../partials/product-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos destacados disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</section>