<?php
/**
 * Vista: Dashboard de Administración
 * Variables esperadas:
 * - $stats (array): Estadísticas del sistema [total_users, total_products, total_orders, pending_orders]
 * - $user_name (string): Nombre del usuario administrador
 */
$stats = $stats ?? [];
$user_name = $user_name ?? \App\Helpers\Session::get('name');
?>
<div class="main-content">
    <h1>Dashboard</h1>
    <p>Bienvenido, <?= htmlspecialchars($user_name) ?>.</p>
    
    <div class="stat-cards">
        <div class="card">
            <h3>Usuarios Totales</h3>
            <p class="stat-number"><?= $stats['total_users'] ?? 0 ?></p>
        </div>
        <div class="card">
            <h3>Productos Totales</h3>
            <p class="stat-number"><?= $stats['total_products'] ?? 0 ?></p>
        </div>
        <div class="card">
            <h3>Pedidos Totales</h3>
            <p class="stat-number"><?= $stats['total_orders'] ?? 0 ?></p>
        </div>
        <div class="card">
            <h3>Pedidos Pendientes</h3>
            <p class="stat-number"><?= $stats['pending_orders'] ?? 0 ?></p>
        </div>
    </div>
</div>