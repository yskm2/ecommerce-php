<?php
/**
 * Partial: product-card
 * Variables esperadas:
 * - $producto (array con keys id, nombre, precio, imagen)
 * - $BASE_URL
 * - $featured (bool) para mostrar overlay especial
 */
$featured = $featured ?? false;
?>
<div class="shop-product-card<?= $featured ? ' featured-card' : '' ?>">
    <div class="card-image-container">
        <img src="<?= $BASE_URL . htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
        <?php if ($featured): ?>
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
        <?php endif; ?>
    </div>
    <div class="card-body">
        <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>" class="product-title">
            <?= htmlspecialchars($producto['nombre']) ?>
        </a>
        <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>
        <?php if (!$featured): ?>
            <div class="card-bottom">
                <div class="card-action-buttons">
                    <a href="<?= $BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>" class="btn-view-details-icon" title="Ver Detalles">
                        <i class="far fa-eye"></i>
                    </a>
                    <form action="<?= $BASE_URL ?>index.php?route=cart-add" method="post">
                        <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                        <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                        <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                        <input type="hidden" name="cantidad" value="1">
                        <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                        <button type="submit" class="btn-add-cart-alt" title="Agregar al Carrito">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>