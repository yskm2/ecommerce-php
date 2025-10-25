<div class="main-content">
    <h1>Dashboard</h1>
    <p>Bienvenido, <?= htmlspecialchars(\App\Helpers\Session::get('name')) ?>.</p>
    
    <div class="stat-cards">
        <div class="card">
            <h3>Usuarios Totales</h3>
            <p class="stat-number"><?= $stats['total_users'] ?></p>
        </div>
        <div class="card">
            <h3>Productos Totales</h3>
            <p class="stat-number"><?= $stats['total_products'] ?></p>
        </div>
        <div class="card">
            <h3>Pedidos Totales</h3>
            <p class="stat-number"><?= $stats['total_orders'] ?></p>
        </div>
        <div class="card">
            <h3>Pedidos Pendientes</h3>
            <p class="stat-number"><?= $stats['pending_orders'] ?></p>
        </div>
    </div>
</div>