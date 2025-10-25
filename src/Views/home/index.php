<section class="hero-banner">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title"><b>eBrainrot</b> eCommerce</h1>
                <h2 class="hero-subtitle">Tu tienda confiable</h2>
                <p>
                    eBrainrot es una tienda en línea dirigida hacia la tecnología.
                </p>
            </div>
            <div class="hero-image">
                <img src="<?= $BASE_URL ?>assets/img/setup.jpg" alt="Banner Image">
            </div>
        </div>
    </div>
</section>

<section class="categories-section">
    <div class="container">
        <div class="section-header">
            <h1>Categorías más relevantes</h1>
        </div>
        <div class="categories-grid">
            <div class="category-item">
                <a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Procesador">
                    <img src="<?= $BASE_URL ?>assets/img/componente.jpg" class="category-img">
                </a>
                <h5 class="category-title">Procesadores</h5>
                <p><a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Procesador" class="btn-primary">Comprar</a>
                </p>
            </div>
            <div class="category-item">
                <a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Tarjeta de Video">
                    <img src="<?= $BASE_URL ?>assets/img/accesorios.jpg" class="category-img">
                </a>
                <h5 class="category-title">Tarjetas de Video</h5>
                <p><a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Tarjeta de Video"
                        class="btn-primary">Comprar</a></p>
            </div>
            <div class="category-item">
                <a href="<?= $BASE_URL ?>index.php?route=shop&categoria=Memoria RAM">
                    <img src="<?= $BASE_URL ?>assets/img/monitor.jpg" class="category-img">
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
            <h1>Productos Destacados</h1>
            <p>Descubre nuestras últimas novedades y los productos más populares.</p>
        </div>
        <div class="products-grid">
            <?php if (!empty($productos_destacados)): ?>
                <?php foreach ($productos_destacados as $producto): ?>
                    <div class="shop-product-card">
                        <div class="card-image-container">
                            <img src="<?= $BASE_URL . htmlspecialchars($producto['imagen']) ?>"
                                alt="<?= htmlspecialchars($producto['nombre']) ?>">
                            <div class="product-overlay">
                                <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>">
                                    <i class="far fa-eye"></i>
                                </a>
                                <form action="<?= $BASE_URL ?>index.php?route=cart-add" method="post">
                                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                    <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                                    <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                                    <input type="hidden" name="cantidad" value="1">
                                    <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                                    <button type="submit" class="cart-button">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>"
                                class="product-title">
                                <?= htmlspecialchars($producto['nombre']) ?>
                            </a>
                            <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos destacados disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</section>