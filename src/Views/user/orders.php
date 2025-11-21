<main class="page-content">
    <div class="container">
        <h1 class="page-title">Mis Pedidos</h1>
        <div class="orders-list">
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <article class="order-card">
                        <header class="order-card-header">
                            <h2>Pedido #<?= $order['id'] ?></h2>
                            <span class="badge status-<?= strtolower($order['status'] ?? 'pendiente') ?>">
                                <?= htmlspecialchars($order['status'] ?? 'Pendiente') ?>
                            </span>
                        </header>
                        <div class="order-meta">
                            <p><strong>Fecha:</strong> <?= isset($order['created_at']) ? date('d/m/Y', strtotime($order['created_at'])) : '—' ?></p>
                            <p><strong>Total:</strong> $<?= number_format($order['total'] ?? 0, 2) ?></p>
                        </div>
                        <?php if (!empty($order['items'])): ?>
                        <ul class="order-items">
                            <?php foreach ($order['items'] as $item): ?>
                                <li>
                                    <span class="item-name"><?= htmlspecialchars($item['nombre'] ?? '') ?></span>
                                    <span class="item-qty">x<?= $item['cantidad'] ?? 0 ?></span>
                                    <span class="item-price">$<?= number_format($item['precio'] ?? 0, 2) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                        <footer class="order-card-footer">
                            <a href="#" class="btn-secondary">Detalle</a>
                        </footer>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No tienes pedidos aún.</p>
                <a href="<?= $BASE_URL ?>index.php?route=shop" class="btn-primary">Ir a la tienda</a>
            <?php endif; ?>
        </div>
    </div>
</main>