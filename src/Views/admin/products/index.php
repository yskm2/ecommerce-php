
<div class="main-content">
    <h1>Gestionar Productos</h1>
    
     <a href="<?=$BASE_URL ?>index.php?route=admin_create_product" 
         class="btn-primary btn-inline-add">
        + Añadir Nuevo Producto
    </a>

    <table class="content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['nombre']) ?></td>
                        <td><?= htmlspecialchars($product['categoria']) ?></td>
                        <td>$<?= number_format($product['precio'], 2) ?></td>
                        <td><?= $product['stock'] ?></td>
                        <td><?= htmlspecialchars(substr($product['descripcion'], 0, 50)) ?>...</td>
                        <td class="actions">
                            <a href="#" class="btn-edit">Editar</a>
                            <form action="#" method="POST" class="inline-form">
                                <button type="submit" class="btn-delete">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No se encontraron productos.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>