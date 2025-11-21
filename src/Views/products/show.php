<main class="page-content">
    <div class="container">
        <article class="product-detail">
            <div class="product-gallery">
                <img src="<?= $BASE_URL . htmlspecialchars($product['imagen']) ?>" alt="<?= htmlspecialchars($product['nombre']) ?>" class="product-main-image">
            </div>
            <div class="product-info">
                <h1 class="product-title"><?= htmlspecialchars($product['nombre']) ?></h1>
                <p class="product-price">$<?= number_format($product['precio'], 2) ?></p>
                <div class="product-description">
                    <p><?= nl2br(htmlspecialchars($product['descripcion'])) ?></p>
                </div>
                <form action="<?= $BASE_URL ?>index.php?route=cart-add" method="post" class="add-to-cart-form">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="nombre" value="<?= htmlspecialchars($product['nombre']) ?>">
                    <input type="hidden" name="precio" value="<?= $product['precio'] ?>">
                    <input type="hidden" name="imagen" value="<?= htmlspecialchars($product['imagen']) ?>">
                    <label for="cantidad">Cantidad</label>
                    <div class="quantity-wrapper">
                        <button type="button" class="quantity-btn" onclick="decrementQuantity()">−</button>
                        <input id="cantidad" type="number" name="cantidad" value="1" min="1" class="quantity-input" readonly>
                        <button type="button" class="quantity-btn" onclick="incrementQuantity()">+</button>
                    </div>
                    <button type="submit" class="btn-primary btn-add-cart">
                        <i class="fas fa-cart-plus"></i> Agregar al carrito
                    </button>
                </form>
                <script>
                function incrementQuantity() {
                    const input = document.getElementById('cantidad');
                    input.value = parseInt(input.value) + 1;
                }
                function decrementQuantity() {
                    const input = document.getElementById('cantidad');
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                    }
                }
                </script>
                <a href="<?= $BASE_URL ?>index.php?route=shop" class="btn-secondary back-link">&larr; Volver a la tienda</a>
            </div>
        </article>
    </div>
</main>