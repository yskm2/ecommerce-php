<?php
$current_page = $_GET['route'] ?? 'dashboard';
?>
<aside class="sidebar">
    <h2>Admin Panel</h2>
    <nav>
        <ul>
            <li>
                <a href="index.php?route=dashboard"
                    class="<?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="index.php?route=admin_products"
                    class="<?php echo ($current_page == 'admin_products') ? 'active' : ''; ?>">
                    Productos
                </a>
            </li>
            <li>
                <a href="index.php?route=admin_orders"
                    class="<?php echo ($current_page == 'admin_orders') ? 'active' : ''; ?>">
                    Pedidos
                </a>
            <li>
                <a href="index.php?route=admin_users"
                    class="<?php echo ($current_page == 'admin_users') ? 'active' : ''; ?>">
                    Usuarios
                </a>
            <li>
                <form action="index.php?route=logout" method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit" class="logout-button">Cerrar Sesión</button>
                </form>

            </li>
        </ul>
    </nav>
</aside>