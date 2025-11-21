<?php
/**
 * Vista: Carrito de Compras
 * Variables esperadas:
 * - $BASE_URL (string): URL base de la aplicación
 * - $carrito (array): Items del carrito con estructura [id => [nombre, precio, cantidad, imagen]]
 */
$carrito = $carrito ?? [];
$total = 0;
?>

<main class="page-content">
    <div class="container">
        <h1 class="page-title">Tu Carrito</h1>

        <?php if (empty($carrito)): ?>
            <div class="cart-empty">
                <p>Tu carrito está vacío.</p>
                <a href="<?= $BASE_URL ?>index.php?route=shop" class="btn-primary">Seguir comprando</a>
            </div>
        <?php else: ?>
            <div class="cart-layout">
                <div class="cart-items">
                    <?php foreach ($carrito as $id => $producto):
                        $subtotal = $producto['precio'] * $producto['cantidad'];
                        $total += $subtotal;
                        ?>
                        <div class="cart-item">
                            <div class="cart-item-img">
                                <img src="<?= $BASE_URL . htmlspecialchars($producto['imagen']) ?>"
                                    alt="<?= htmlspecialchars($producto['nombre']) ?>">
                            </div>
                            <div class="cart-item-details">
                                <h3 class="product-title"><?= htmlspecialchars($producto['nombre']) ?></h3>
                                <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>
                            </div>

                            <div class="cart-item-quantity">
                                <form action="<?= $BASE_URL ?>index.php?route=cart-update" method="post" class="quantity-form-inline">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <button type="submit" name="update_action" value="restar" class="quantity-btn">−</button>
                                </form>
                                <span class="quantity-value"><?= $producto['cantidad'] ?></span>
                                <form action="<?= $BASE_URL ?>index.php?route=cart-update" method="post" class="quantity-form-inline">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <button type="submit" name="update_action" value="sumar" class="quantity-btn">+</button>
                                </form>
                            </div>

                            <div class="cart-item-subtotal">
                                $<?= number_format($subtotal, 2) ?>
                            </div>

                            <div class="cart-item-remove">
                                <a href="<?= $BASE_URL ?>index.php?route=cart-remove&id=<?= $id ?>" class="btn-remove"
                                    title="Eliminar Producto">×</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="cart-summary">
                    <h2>Resumen del Pedido</h2>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>$<?= number_format($total, 2) ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Envío</span>
                        <span>$150.00</span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span>$<?= number_format($total + 150, 2) ?></span>
                    </div>
                    <a href="<?= $BASE_URL ?>index.php?route=checkout" class="btn-primary btn-checkout">
                        Proceder al Pago
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>