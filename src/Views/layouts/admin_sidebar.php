<?php
$current_page = $_GET['route'] ?? 'dashboard';
?>
<aside class="sidebar">
    <h2>Admin Panel</h2>
    <nav>
        <ul>
            <li>
                <a href="<?= $BASE_URL ?>index.php?route=dashboard"
                    class="<?= ($current_page == 'dashboard') ? 'active' : '' ?>">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?= $BASE_URL ?>index.php?route=admin_products"
                    class="<?= ($current_page == 'admin_products') ? 'active' : '' ?>">
                    Productos
                </a>
            </li>
            <li>
                <a href="<?= $BASE_URL ?>index.php?route=admin_orders"
                    class="<?= ($current_page == 'admin_orders') ? 'active' : '' ?>">
                    Pedidos
                </a>
            </li>
            <li>
                <a href="<?= $BASE_URL ?>index.php?route=admin_users"
                    class="<?= ($current_page == 'admin_users') ? 'active' : '' ?>">
                    Usuarios
                </a>
            </li>
            <li>
                <form action="<?= $BASE_URL ?>index.php?route=logout" method="POST" class="inline-form">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit" class="logout-button">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>
</aside>