<div class="main-content">
    <h1>Gestionar Pedidos</h1>
    <table class="content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['user_name'] ?? 'N/D') ?></td>
                    <td>$<?= number_format($order['total'] ?? 0, 2) ?></td>
                    <td><span class="badge status-<?= strtolower($order['status'] ?? 'pendiente') ?>"><?= htmlspecialchars($order['status'] ?? 'Pendiente') ?></span></td>
                    <td><?= isset($order['created_at']) ? date('d/m/Y', strtotime($order['created_at'])) : '—' ?></td>
                    <td class="actions">
                        <a href="#" class="btn-edit">Ver</a>
                        <form action="#" method="POST" class="inline-form">
                            <button type="submit" class="btn-delete">Cancelar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No hay pedidos registrados.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>