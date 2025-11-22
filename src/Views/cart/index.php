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

<main class="page-content" role="main">
    <div class="container">
        <header>
            <h1 class="page-title" id="cart-heading">Tu Carrito</h1>
        </header>

        <?php if (empty($carrito)): ?>
            <section class="cart-empty" aria-label="Carrito vacío">
                <p>Tu carrito está vacío.</p>
                <a href="<?= $BASE_URL ?>index.php?route=shop" class="btn-primary" aria-label="Ir a la tienda para agregar productos">Seguir comprando</a>
            </section>
        <?php else: ?>
            <div class="cart-layout">
                <section class="cart-items" aria-labelledby="cart-heading">
                    <?php foreach ($carrito as $id => $producto):
                        $subtotal = $producto['precio'] * $producto['cantidad'];
                        $total += $subtotal;
                        ?>
                        <article class="cart-item" aria-labelledby="product-<?= $id ?>-name">
                            <figure class="cart-item-img">
                                <img src="<?= $BASE_URL . htmlspecialchars($producto['imagen']) ?>"
                                    alt="<?= htmlspecialchars($producto['nombre']) ?>">
                            </figure>
                            <div class="cart-item-details">
                                <h3 class="product-title" id="product-<?= $id ?>-name"><?= htmlspecialchars($producto['nombre']) ?></h3>
                                <p class="product-price" aria-label="Precio unitario: $<?= number_format($producto['precio'], 2) ?>">$<?= number_format($producto['precio'], 2) ?></p>
                            </div>

                            <div class="cart-item-quantity" role="group" aria-label="Control de cantidad">
                                <form action="<?= $BASE_URL ?>index.php?route=cart-update" method="post" class="quantity-form-inline">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <button type="submit" name="update_action" value="restar" class="quantity-btn" aria-label="Disminuir cantidad de <?= htmlspecialchars($producto['nombre']) ?>">−</button>
                                </form>
                                <span class="quantity-value" aria-label="Cantidad: <?= $producto['cantidad'] ?>"><?= $producto['cantidad'] ?></span>
                                <form action="<?= $BASE_URL ?>index.php?route=cart-update" method="post" class="quantity-form-inline">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <button type="submit" name="update_action" value="sumar" class="quantity-btn" aria-label="Aumentar cantidad de <?= htmlspecialchars($producto['nombre']) ?>">+</button>
                                </form>
                            </div>

                            <div class="cart-item-subtotal" aria-label="Subtotal: $<?= number_format($subtotal, 2) ?>">
                                $<?= number_format($subtotal, 2) ?>
                            </div>

                            <div class="cart-item-remove">
                                <a href="<?= $BASE_URL ?>index.php?route=cart-remove&id=<?= $id ?>" class="btn-remove"
                                    aria-label="Eliminar <?= htmlspecialchars($producto['nombre']) ?> del carrito">×</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </section>

                <aside class="cart-summary" aria-labelledby="summary-heading">
                    <h2 id="summary-heading">Resumen del Pedido</h2>
                    <div class="summary-row" aria-label="Subtotal de productos: $<?= number_format($total, 2) ?>">
                        <span>Subtotal</span>
                        <span>$<?= number_format($total, 2) ?></span>
                    </div>
                    <div class="summary-row" aria-label="Costo de envío: $150.00">
                        <span>Envío</span>
                        <span>$150.00</span>
                    </div>
                    <div class="summary-total" aria-label="Total a pagar: $<?= number_format($total + 150, 2) ?>">
                        <span>Total</span>
                        <span>$<?= number_format($total + 150, 2) ?></span>
                    </div>
                    <a href="<?= $BASE_URL ?>index.php?route=checkout" class="btn-primary btn-checkout" aria-label="Proceder al pago del pedido">
                        Proceder al Pago
                    </a>
                </aside>
            </div>
        <?php endif; ?>
    </div>
</main>