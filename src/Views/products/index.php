<main class="page-content shop-page">
    <div class="container">
        <h1 class="page-title">Tienda</h1>
        <div class="shop-layout">

            <!-- Sidebar de categorías -->
            <aside class="sidebar">
                <h3 class="sidebar-title">Categorías</h3>
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

                        <label for="orden">Ordenar por:</label>
                        <select name="orden" id="orden" class="sort-dropdown" onchange="this.form.submit()">
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
                        <button type="submit" class="btn-secondary btn-sort" style="display: none;">Aplicar</button>
                    </form>
                </div>

                <!-- Grid de productos -->
                <div class="shop-products-grid">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $producto): ?>
                            <?php $featured = false; include __DIR__ . '/../partials/product-card.php'; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No se encontraron productos que coincidan con tu búsqueda.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</main>