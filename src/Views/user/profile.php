<main class="page-content">
    <div class="container">
        <h1 class="page-title">Mi Perfil</h1>

        <!-- Mostrar mensaje flash si existe -->
        <?php if ($flash = \App\Helpers\Session::getFlashMessage()): ?>
            <div class="alert alert-<?= $flash['type'] ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de perfil -->
        <form action="<?= $BASE_URL ?>index.php?route=profile-update" method="POST" class="profile-form">
            
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" required>

            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($user['apellido']) ?>">

            <label for="email">Correo</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($user['telefono']) ?>">

            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($user['direccion'] ?? '') ?>">

            <div class="profile-actions mt-lg">
                <button type="submit" class="btn-primary">Guardar Cambios</button>
                <a href="<?= $BASE_URL ?>index.php?route=logout" class="btn-secondary">Cerrar Sesión</a>
            </div>
        </form>

        <!-- Eliminar cuenta -->
        <form action="<?= $BASE_URL ?>index.php?route=profile-delete" method="POST" class="mt-lg">
            <p class="text-muted">¿Deseas eliminar permanentemente tu cuenta?</p>
            <button type="submit" class="btn-danger">
                Eliminar cuenta
            </button>
        </form>
    </div>
</main>
