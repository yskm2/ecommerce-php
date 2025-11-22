<?php
/**
 * Partial: Tarjeta de Producto
 * Variables esperadas:
 * - $producto (array): Datos del producto [id, nombre, precio, imagen, descripcion]
 * - $BASE_URL (string): URL base de la aplicación
 * - $featured (bool): Si es producto destacado (muestra overlay diferente)
 */
if (!isset($producto) || !is_array($producto)) {
    return; // No renderizar si no hay datos válidos
}

$featured = $featured ?? false;
?>
<article class="shop-product-card<?= $featured ? ' featured-card' : '' ?>" role="listitem" aria-labelledby="product-<?= $producto['id'] ?>-name">
    <figure class="card-image-container">
        <img src="<?= $BASE_URL . htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
        <?php if ($featured): ?>
            <div class="product-overlay" role="group" aria-label="Acciones rápidas del producto">
                <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>" aria-label="Ver detalles de <?= htmlspecialchars($producto['nombre']) ?>">
                    <i class="far fa-eye" aria-hidden="true"></i>
                </a>
                <form action="<?= $BASE_URL ?>index.php?route=cart-add" method="post" aria-label="Agregar <?= htmlspecialchars($producto['nombre']) ?> al carrito">
                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                    <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                    <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                    <input type="hidden" name="cantidad" value="1">
                    <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                    <button type="submit" class="cart-button" aria-label="Agregar <?= htmlspecialchars($producto['nombre']) ?> al carrito">
                        <i class="fas fa-cart-plus" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </figure>
    <div class="card-body">
        <h3 class="product-title" id="product-<?= $producto['id'] ?>-name">
            <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>" aria-label="Ver detalles de <?= htmlspecialchars($producto['nombre']) ?>">
                <?= htmlspecialchars($producto['nombre']) ?>
            </a>
        </h3>
        <p class="product-price" aria-label="Precio: $<?= number_format($producto['precio'], 2) ?>">$<?= number_format($producto['precio'], 2) ?></p>
        <?php if (!$featured): ?>
            <div class="card-bottom">
                <div class="card-action-buttons" role="group" aria-label="Acciones del producto">
                    <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>" class="btn-view-details-icon" aria-label="Ver detalles de <?= htmlspecialchars($producto['nombre']) ?>">
                        <i class="far fa-eye" aria-hidden="true"></i>
                    </a>
                    <form action="<?= $BASE_URL ?>index.php?route=cart-add" method="post" aria-label="Agregar <?= htmlspecialchars($producto['nombre']) ?> al carrito">
                        <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                        <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                        <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                        <input type="hidden" name="cantidad" value="1">
                        <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                        <button type="submit" class="btn-add-cart-alt" aria-label="Agregar <?= htmlspecialchars($producto['nombre']) ?> al carrito">
                            <i class="fas fa-cart-plus" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</article>