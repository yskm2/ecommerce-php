<main class="shop-page-content">
    <div class="container">
        <div class="shop-layout">

            <!-- Sidebar de categorías -->
            <aside class="sidebar">
                <h2 class="sidebar-title">Categorías</h2>
                <ul class="category-list">
                    <li>
                        <a href="<?= $BASE_URL ?>index.php?route=shop"
                            class="<?= empty($currentCategory) ? 'active' : '' ?>">
                            Todas
                        </a>
                    </li>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <li>
                                <a href="<?= $BASE_URL ?>index.php?route=shop&categoria=<?= urlencode($cat) ?>"
                                    class="<?= ($currentCategory === $cat) ? 'active' : '' ?>">
                                    <?= htmlspecialchars($cat) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </aside>

            <!-- Área de productos -->
            <section class="product-area">
                <!-- Barra de ordenamiento -->
                <div class="shop-top-bar">
                    <form action="<?= $BASE_URL ?>index.php" method="get" class="sort-form">
                        <input type="hidden" name="route" value="shop">
                        <?php if ($currentCategory): ?>
                            <input type="hidden" name="categoria" value="<?= htmlspecialchars($currentCategory) ?>">
                        <?php endif; ?>

                        <select name="orden" class="sort-dropdown" onchange="this.form.submit()">
                            <option value="newest" <?= $currentOrder === 'newest' ? 'selected' : '' ?>>
                                Más nuevos
                            </option>
                            <option value="price_asc" <?= $currentOrder === 'price_asc' ? 'selected' : '' ?>>
                                Precio: Menor a Mayor
                            </option>
                            <option value="price_desc" <?= $currentOrder === 'price_desc' ? 'selected' : '' ?>>
                                Precio: Mayor a Menor
                            </option>
                            <option value="name_asc" <?= $currentOrder === 'name_asc' ? 'selected' : '' ?>>
                                Nombre: A-Z
                            </option>
                        </select>
                    </form>
                </div>

                <!-- Grid de productos -->
                <div class="shop-products-grid">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $producto): ?>
                            <div class="shop-product-card">
                                <div class="card-image-container">
                                    <img src="<?= $BASE_URL . htmlspecialchars($producto['imagen']) ?>"
                                        alt="<?= htmlspecialchars($producto['nombre']) ?>">
                                </div>
                                <div class="card-body">
                                    <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>"
                                        class="product-title">
                                        <?= htmlspecialchars($producto['nombre']) ?>
                                    </a>
                                    <div class="card-bottom">
                                        <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>
                                        <div class="card-action-buttons">
                                            <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>"
                                                class="btn-view-details-icon" title="Ver Detalles">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <form action="<?= $BASE_URL ?>index.php?route=cart-add" method="post">
                                                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                                <input type="hidden" name="nombre"
                                                    value="<?= htmlspecialchars($producto['nombre']) ?>">
                                                <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                                                <input type="hidden" name="cantidad" value="1">
                                                <input type="hidden" name="imagen"
                                                    value="<?= htmlspecialchars($producto['imagen']) ?>">
                                                <button type="submit" class="btn-add-cart-alt" title="Agregar al Carrito">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No se encontraron productos que coincidan con tu búsqueda.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</main>