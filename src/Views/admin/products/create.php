<div class="main-content">
    <h1>Crear Nuevo Producto</h1>

    <form action="<?= $BASE_URL ?>index.php?route=admin_store_product" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="nombre">Nombre del Producto</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" required>
        </div>

        <div class="form-group">
            <label for="id_categoria">Categoría</label>
            <select id="id_categoria" name="id_categoria" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>">
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen del Producto</label>
            <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg, image/jpg" required>
            <small>Formatos permitidos: JPG, JPEG, PNG. Tamaño máximo: 2MB</small>
        </div>

        <button type="submit" class="btn-primary">Guardar Producto</button>
    </form>
</div>
